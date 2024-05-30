let timer;
let isRunning = false;
let elapsedSeconds = 0;

const showDiv = document.querySelector(".show");
const startPauseBtn = document.getElementById("startPauseBtn");
const saveBtn = document.getElementById("saveBtn");
const timeSpentInput = document.getElementById("timeSpent");

function formatTime(seconds) {
	const hrs = String(Math.floor(seconds / 3600)).padStart(2, "0");
	const mins = String(Math.floor((seconds % 3600) / 60)).padStart(2, "0");
	const secs = String(seconds % 60).padStart(2, "0");
	return `${hrs}:${mins}:${secs}`;
}

function updateDisplay() {
	showDiv.textContent = formatTime(elapsedSeconds);
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
	// set value to hidden input
	timeSpentInput.value = formatTime(elapsedSeconds);

	console.log(showDiv.textContent);
	elapsedSeconds = 0;
	updateDisplay();
	if (isRunning) {
		toggleTimer();
	}
}

startPauseBtn.addEventListener("click", toggleTimer);
saveBtn.addEventListener("click", saveTime);

updateDisplay();
