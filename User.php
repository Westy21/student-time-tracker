<?php
class User {
    private $id;
    private $name;
    private $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getDetails() {
        return "ID: $this->id, Name: $this->name, Email: $this->email";
    }

    // CRUD operations for User
    public function createUser($conn) {
        $sql = "INSERT INTO Users (name, email) VALUES ('$this->name', '$this->email')";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function readUser($conn, $id) {
        $sql = "SELECT * FROM Users WHERE id = $id";
        try {
            $result = $conn->query($sql);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateUser($conn) {
        $sql = "UPDATE Users SET name='$this->name', email='$this->email' WHERE id=$this->id";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteUser($conn, $id) {
        $sql = "DELETE FROM Users WHERE id=$id";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}