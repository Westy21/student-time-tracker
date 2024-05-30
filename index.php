<?php
// Debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require('db.php');
require ('Task.php');
include("auth_session.php");



# generate table rows using database data
$dataArray = getAllTasks($conn,$_SESSION['userId']);
$tasks = array();
foreach ($dataArray as $data) {
    $task = new Task($data['taskId'], $data['userId'], $data['taskName']);
    $tasks[] = $task;
}


// handle action
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = trim($_POST['action']);
    $taskName = trim($_POST['taskName']);
    $taskId = $_POST['taskId'];
    print_r($taskId);

    // Basic validation
    if (!empty($action)) {
        foreach ($tasks as $task) {
            if ($task->getTaskId() == $taskId){
                if($action == 'update'){
                    $task = new Task($task->getTaskId(),$_SESSION['userId'],$taskName);
                    $task->updateTask($conn);
                }
    
                if($action == 'delete'){
                    $task->deleteTask($conn, $task->getTaskId());
                }
            }
        }
    }
    header("Location: index.php");
}

// Display the list of tasks
// foreach ($tasks as $task) {
//     echo "Task ID: " . $task->getTaskId() . "\n";
//     echo "User ID: " . $task->getUserId() . "\n";
//     echo "Task Name: " . $task->getTaskName() . "\n\n";
// }

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css" class="css">
    <title>timetracker</title>
</head>

<body>
    <div class="sidebar">
        <h2>TimeTracker</h2>
        <div class="profile">
            <img src="profile-pic.png" alt="Profile Picture">
            <span>Julia Nakone</span>
        </div>
    </div>
    <div class="content">
        <div class="timer">
            <form method="post" action="create_task.php" id="taskForm">
                <input type="text" id="taskInput" name="taskName" placeholder="What are you working on right now?"
                    required>
                <input type="hidden" id="timeSpent" name="timeSpent" value="">
                <div>
                    <div class="show" id="timeDisplay">00:00:00</div>
                    <button type="button" id="startPauseBtn">Start timer</button>
                    <button type="submit" id="saveBtn">Save</button>
                </div>
            </form>
        </div>
        <!-- <div class="summary">
            <div>
                <h3>Total Hours</h3>
                <p>23.5</p>
            </div>
            <div>
                <h3>Avg Hours Per Task</h3>
                <p>3.7</p>
            </div>
            <div>
                <h3>LittleDate</h3>
                <p>23%</p>
            </div>
        </div> -->

        <div class="popup-overlay" id="popupOverlay">
            <div class="popup" id="popup">
                <span class="close" id="closePopup">&times;</span>
                <div class="popup-content">
                    <div class="form-container">
                        <div class="logo-container">
                            Edit Task
                        </div>

                        <form class="form" method="post" action="index.php">
                            <!-- Hidden input field to store the action -->
                            <input type="hidden" name="action" id="action" value="update">
                            <!-- Other form fields -->
                            <div class="form-group">
                                <input type="hidden" id="taskId" name="taskId" value="">
                                <label for="taskName">Name</label>
                                <input type="text" id="taskName" name="taskName" placeholder="Enter task name"
                                    required="">
                                <br>
                                <label for="taskGroup">Group</label>
                                <input type="text" id="taskGroup" name="taskGroup" placeholder="Enter task group">
                                <br>
                                <label for="taskDuration">Duration</label>
                                <input type="text" id="taskDuration" name="taskDuration" placeholder="">
                            </div>

                            <!-- Button to submit the form for updating -->
                            <button class="form-submit-btn" type="submit" onclick="setAction('update')">Update</button>

                            <!-- Button to submit the form for deleting -->
                            <button class="form-submit-btn" type="submit" onclick="setAction('delete')">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="entries">
            <div>
                <h3>October 24, 2020</h3>
                <h3>20:24:40</h3>
            </div>
            <table id="tasksTable">
                <tr>
                    <th>Task</th>
                    <th>Group</th>
                    <th>Duration</th>
                </tr>
                <?php foreach ($tasks as $task): ?>
                <tr>
                    <td data-id="<?php echo $task->getTaskId(); ?>" data-taskName="<?php echo $task->getTaskName()?>">
                        <?php echo $task->getTaskName(); ?></td>
                    <td data-id="<?php echo $task->getTaskId(); ?>" data-taskName="<?php echo $task->getTaskName()?>">
                        <?php echo 'project'; ?></td>
                    <td data-id="<?php echo $task->getTaskId(); ?>" data-taskName="<?php echo $task->getTaskName()?>">
                        <?php echo '00:43:00'; ?></td>
                </tr>
                <?php endforeach; ?>

            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>