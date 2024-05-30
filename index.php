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
            <form method="get" action="create_task.php" id="taskForm">
                <input type="text" id="taskInput" name="task_name" placeholder="What are you working on right now?"
                    required>
                <input type="hidden" id="timeSpent" name="time_spent" value="">
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
        <div class="entries">
            <div>
                <h3>October 24, 2020</h3>
                <h3>20:24:40</h3>
            </div>
            <table>
                <tr>
                    <th>Task</th>
                    <th>Project</th>
                    <th>Entry</th>
                </tr>
                <tr>
                    <td>Deleted templates</td>
                    <td>Tymewise</td>
                    <td>01:23:17</td>

                </tr>
                <tr>
                    <td>Deleted templates</td>
                    <td>Process place</td>
                    <td>01:23:17</td>
                </tr>
                <tr>
                    <td>Employee onboarding for the main office</td>
                    <td>LittleDate</td>
                    <td>01:23:17</td>
                </tr>
                <tr>
                    <td>Sick leave request</td>
                    <td>LittleDate</td>
                    <td>01:23:17</td>
                </tr>
                <tr>
                    <td>Request new hire</td>
                    <td>Process place</td>
                    <td>01:23:17</td>
                </tr>
                <tr>
                    <td>New client onboarding</td>
                    <td>Tymewise</td>
                    <td>01:23:17</td>
                </tr>
            </table>
        </div>
    </div>
    <script src="script.js"></script>
</body>

</html>