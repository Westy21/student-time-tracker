// Timer
let timer;
let isRunning = false;
let elapsedSeconds = 0;

const showDiv = document.querySelector(".show");
const startPauseBtn = document.getElementById("startPauseBtn");
const saveBtn = document.getElementById("saveBtn");
const timeSpentInput = document.getElementById("timeSpent");
const durationInput = document.getElementById("taskDuration");

function formatTime(seconds) {
	const hrs = String(Math.floor(seconds / 3600)).padStart(2, "0");
	const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
	const secs = String(seconds % 60).padStart(2, "0");
	return `${hrs}:${mins}:${secs}`;
}

function updateDisplay() {
	showDiv.textContent = formatTime(elapsedSeconds);
	durationInput.value = elapsedSeconds;
}

function toggleTimer() {
	if (isRunning) {
		clearInterval(timer);
		startPauseBtn.textContent = "Start timer";
	} else {
		timer = setInterval(() => {
			elapsedSeconds++;
			updateDisplay();
		}, 1000);
		startPauseBtn.textContent = "Pause timer";
	}
	isRunning = !isRunning;
}

function saveTime() {
	timeSpentInput.value = formatTime(elapsedSeconds);
	elapsedSeconds = 0;
	updateDisplay();
	if (isRunning) {
		toggleTimer();
	}
}

startPauseBtn.addEventListener("click", toggleTimer);
saveBtn.addEventListener("click", saveTime);
updateDisplay();

// form popup
const popupOverlay = document.getElementById("popupOverlay");
const popup = document.getElementById("popup");
const closePopup = document.getElementById("closePopup");
const emailInput = document.getElementById("emailInput");

// Function to open the popup
function openPopup() {
	popupOverlay.style.display = "block";
}

// Function to close the popup
function closePopupFunc() {
	popupOverlay.style.display = "none";
}

// Function to submit the signup form
function submitForm() {
	const email = emailInput.value;

	// Add your form submission logic here
	console.log(`Email submitted: ${email}`);
	closePopupFunc(); // Close the popup after form submission
}

// Event listeners

// Close the popup when the close button is clicked
closePopup.addEventListener("click", closePopupFunc);

// Close the popup when clicking outside the popup content
popupOverlay.addEventListener("click", function (event) {
	if (event.target === popupOverlay) {
		closePopupFunc();
	}
});

// JavaScript function to populate the form fields
function populateForm(taskId, taskName, taskGroup) {
	// Populate form fields with the retrieved data
	document.getElementById("taskId").value = taskId;
	document.getElementById("taskName").value = taskName;
	document.getElementById("taskGroup").value = taskGroup;
}

// Table event
document
	.getElementById("tasksTable")
	.addEventListener("click", function (event) {
		// Check if the clicked element is a table row
		if (event.target.tagName === "TD") {
			// Retrieve the ID stored in the data-id attribute
			const id = event.target.getAttribute("data-id");
			const taskName = event.target.getAttribute("data-taskName");
			const taskGroup = event.target.getAttribute("data-taskGroup");
			// Perform actions using the retrieved ID
			populateForm(id, taskName, taskGroup);
			// Trigger the popup to open (you can call this function on a button click or any other event)
			openPopup();
		}
	});

// Function to set the action before form submission
function setAction(action) {
	document.getElementById("action").value = action;
}
