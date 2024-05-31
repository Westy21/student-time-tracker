<?php

// Debugging
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
class Task {
    private $taskId;
    private $userId;
    private $taskName;
    private $taskDuration;
    private $taskGroup;

    public function __construct($taskId, $userId, $taskName, $taskDuration, $taskGroup) {
        $this->taskId = $taskId;
        $this->userId = $userId;
        $this->taskName = $taskName;
        $this->taskDuration = $taskDuration;
        $this->taskGroup = $taskGroup;
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

    public function getTaskDuration(){
        return $this->taskDuration;
    }

    public function getTaskGroup(){
        return $this->taskGroup;
    }

    // CRUD operations for Task
    public function createTask($conn) {
        $sql = "INSERT INTO Tasks (userId, taskName,taskDuration,taskGroup) VALUES ($this->userId, '$this->taskName', '$this->taskDuration','default')";
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
        $sql = "UPDATE Tasks SET taskName='$this->taskName', taskDuration='$this->taskDuration', taskGroup='$this->taskGroup' WHERE taskId=$this->taskId";
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