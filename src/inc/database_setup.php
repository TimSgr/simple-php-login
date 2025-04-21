<?php

final class DatabaseConnection {
    private mysqli $conn;

    public function __construct()
    {
        $serverName = getenv('SERVERNAME');
        $username = 'root';
        $password = getenv('DB_ROOT_PASSWORD');
        $databaseName = getenv('DB_NAME');

        error_log('Connecting to DB Server: ' . $serverName);

        $this->conn = new mysqli($serverName, $username, $password, $databaseName);
        $this->conn->set_charset("utf8mb4");

        if ($this->conn->connect_error) {
            die('Datenbankverbindung fehlgeschlagen: ' . $this->conn->connect_error);
        }

        $this->initializeTables();
    }

    private function initializeTables(): void
    {
        $this->createUserTable();
        $this->createOrdersTable();
        $this->createProductsTable();
    }

    private function createUserTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            emailAdress NVARCHAR(255) NOT NULL,
            firstname VARCHAR(30) NOT NULL,
            lastname VARCHAR(30) NOT NULL,
            password VARCHAR(255) NOT NULL
        )";
        $this->conn->query($sql);
    }

    private function createOrdersTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS orders (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            price FLOAT(12,2) NOT NULL
        )";
        $this->conn->query($sql);
    }

    private function createProductsTable(): void
    {
        $sql = "CREATE TABLE IF NOT EXISTS products (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            price FLOAT(7,2) NOT NULL
        )";
        $this->conn->query($sql);
    }

    public function createUser(string $emailAdress, string $firstName, string $lastName, string $password): string
    {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare("INSERT INTO users (emailAdress, firstname, lastname, password) VALUES (?, ?, ?, ?)");

        if (!$stmt) {
            return "Error: " . $this->conn->error;
        }

        $stmt->bind_param("ssss", $emailAdress, $firstName, $lastName, $passwordHash);

        if ($stmt->execute()) {
            return "Success";
        } else {
            return "Error: " . $stmt->error;
        }
    }

    public function getConnection(): mysqli
    {
        return $this->conn;
    }
}
