<?php
class Task {
    private $taskId;
    private $userId;
    private $taskName;

    public function __construct($taskId, $userId, $taskName) {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->taskName = $taskName;
    }

    // Getters for Task properties
    public function getTaskId() {
        return $this->taskId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function getTaskName() {
        return $this->taskName;
    }

    // CRUD operations for Task
    public function createTask($conn) {
        $sql = "INSERT INTO Tasks (userId, taskName) VALUES ($this->userId, '$this->taskName')";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function readTask($conn, $taskId) {
        $sql = "SELECT * FROM Tasks WHERE taskId = $taskId";
        try {
            $result = $conn->query($sql);
            return $result->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function updateTask($conn) {
        $sql = "UPDATE Tasks SET taskName='$this->taskName' WHERE taskId=$this->taskId";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function deleteTask($conn, $taskId) {
        $sql = "DELETE FROM Tasks WHERE taskId=$taskId";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}