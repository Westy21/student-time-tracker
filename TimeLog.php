<?php
class TimeLog {
    private $logId;
    private $taskId;
    private $startTime;
    private $endTime;

    public function __construct($logId, $taskId, $startTime, $endTime) {
        $this->logId = $logId;
        $this->taskId = $taskId;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
    }

    // Methods to manage time logs
    public function startLog($conn) {
        $this->startTime = date('Y-m-d H:i:s');
        $sql = "INSERT INTO TimeLogs (taskId, startTime) VALUES ($this->taskId, '$this->startTime')";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function stopLog($conn) {
        $this->endTime = date('Y-m-d H:i:s');
        $sql = "UPDATE TimeLogs SET endTime='$this->endTime' WHERE logId=$this->logId";
        try {
            $conn->exec($sql);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function viewLogs($conn, $taskId) {
        $sql = "SELECT * FROM TimeLogs WHERE taskId = $taskId";
        try {
            $result = $conn->query($sql);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}