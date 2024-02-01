const daysContainer = document.querySelector(".days"),
  nextBtn = document.querySelector(".next-btn"),
  prevBtn = document.querySelector(".prev-btn"),
  month = document.querySelector(".month"),
  todayBtn = document.querySelector(".today-btn");

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

let statusData = {};

// const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

// get current date
const date = new Date();

const days = document.querySelectorAll(".days .day");

daysContainer.addEventListener("click", (event) => {
  const target = event.target;

  if (target.classList.contains("day") && target.classList.contains("clickable")) {
    // The day is clickable, handle the click event
    const dayNumber = target.getAttribute("data-day");

    // Calculate the clicked date using the original date and the clicked day
    const clickedDate = calculateClickedDate(dayNumber, target);

    console.log(`Clicked date: ${months[clickedDate.getMonth()]} ${clickedDate.getDate()}, ${clickedDate.getFullYear()}`);

    // Calculate the harvest date, which is the 105th day after the clicked date
    const harvestDate = new Date(clickedDate);
    harvestDate.setDate(clickedDate.getDate() + 105);

    const modalBody = `Predicted date of harvest: ${formatDateDisplay(harvestDate)}.`;

    // Show Bootstrap modal with "Predicted Date" as the title
    $("#exampleModal2").modal("show");
    $("#exampleModalLabel2").text(`${months[clickedDate.getMonth()]} ${clickedDate.getDate()}, ${clickedDate.getFullYear()}`);
    $("#modalBody").text(modalBody);

    console.log(`Predicted date of harvest: ${formatDateDisplay(harvestDate)}`);
  }
});

function calculateClickedDate(dayNumber, target) {
  // Create a new Date object with the current year and month
  const clickedDate = new Date(currentYear, target.getAttribute("data-month"), dayNumber);
  // Set the date to the clicked day
  clickedDate.setDate(dayNumber);

  return clickedDate;
}


function formatDateDisplay(date) {
  const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
  return `${months[date.getMonth()]} ${date.getDate()}, ${date.getFullYear()}`;
}


// get current month
let currentMonth = date.getMonth();

// get current year
let currentYear = date.getFullYear();

function renderCalendar() {
  // Fetch status data asynchronously
  fetch(`fetch_status2.php?month=${currentMonth + 1}&year=${currentYear}`)
    .then(response => response.json())
    .then(data => {
      console.log('Received status data:', data);
      statusData = data;

      // get prev month current month and next month days
      date.setDate(1);
      const firstDay = new Date(currentYear, currentMonth, 1);
      const lastDay = new Date(currentYear, currentMonth + 1, 0);
      const lastDayIndex = lastDay.getDay();
      const lastDayDate = lastDay.getDate();
      const prevLastDay = new Date(currentYear, currentMonth, 0);
      const prevLastDayDate = prevLastDay.getDate();
      const nextDays = 7 - lastDayIndex - 1;

      // update current year and month in header
      month.innerHTML = `${months[currentMonth]} ${currentYear}`;

      // update days html
      let days = "";

      // prev days html
      for (let x = firstDay.getDay(); x > 0; x--) {
        days += `<div class="day prev"></div>`;
      }

      // current month days
      for (let i = 1; i <= lastDayDate; i++) {
        // calculate the background color based on the status from PHP
        const dayStatusData = statusData[i] || { month: currentMonth + 1, year: currentYear, status: 0 };
        const bgColor = dayStatusData.status === 1 ? 'green' : 'red';

        // check if its today then add today class
        if (
          i === new Date().getDate() &&
          currentMonth === new Date().getMonth() &&
          currentYear === new Date().getFullYear()
        ) {
          // Make the day clickable if the status is 1
          const clickableClass = dayStatusData.status === 1 ? 'clickable' : '';
          days += `<div class="day today ${clickableClass}" style="background-color: ${bgColor}" data-day="${i}" data-month="${currentMonth}">${i}</div>`;
        } else {
          // Make the day clickable if the status is 1
          const clickableClass = dayStatusData.status === 1 ? 'clickable' : '';
          days += `<div class="day ${clickableClass}" style="background-color: ${bgColor}" data-day="${i}" data-month="${currentMonth}">${i}</div>`;
        }
      }

      // next MOnth days
      for (let j = 1; j <= nextDays; j++) {
        days += `<div class="day next"></div>`;
      }

      // run this function with every calendar render
      hideTodayBtn();
      daysContainer.innerHTML = days;

      // Add event listeners to the clickable days
      const clickableDays = document.querySelectorAll('.day.clickable');
      clickableDays.forEach(clickableDay => {
        clickableDay.addEventListener('click', handleDayClick);
      });
    })
    .catch(error => {
      console.error('Error fetching status data:', error);
      hideTodayBtn();
      daysContainer.innerHTML = "";
    });
}

// Function to handle the click event on a clickable day
function handleDayClick(event) {
  const target = event.target;
  const dayNumber = target.getAttribute("data-day");

  // Calculate the clicked date using the original date and the clicked day
  const clickedDate = calculateClickedDate(dayNumber, target);

  console.log(`Clicked date: ${months[clickedDate.getMonth()]} ${clickedDate.getDate()}, ${clickedDate.getFullYear()}`);

  // Calculate the harvest date, which is the 105th day after the clicked date
  const harvestDate = new Date(clickedDate);
  harvestDate.setDate(clickedDate.getDate() + 105);

  const modalBody = `Predicted date of harvest: ${formatDateDisplay(harvestDate)}.`;

  // Show Bootstrap modal with "Predicted Date" as the title
  $("#exampleModal2").modal("show");
  $("#exampleModalLabel2").text(`${months[clickedDate.getMonth()]} ${clickedDate.getDate()}, ${clickedDate.getFullYear()}`);
  $("#modalBody").text(modalBody);

  console.log(`Predicted date of harvest: ${formatDateDisplay(harvestDate)}`);
}


// Initial rendering of the calendar
renderCalendar();

// Event listener for the nextBtn
nextBtn.addEventListener("click", () => {
  // increase current month by one
  currentMonth++;
  if (currentMonth > 11) {
    // if month gets greater than 11 make it 0 and increase year by one
    currentMonth = 0;
    currentYear++;
  }
  // rerender calendar
  renderCalendar();
});


// prev monyh btn
prevBtn.addEventListener("click", () => {
  // increase by one
  currentMonth--;
  // check if less than 0 then make it 11 and decrease year
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar();
});

// go to today
todayBtn.addEventListener("click", () => {
  // set month and year to current
  currentMonth = date.getMonth();
  currentYear = date.getFullYear();
  // rerender calendar
  renderCalendar();
});

// Initial rendering of the calendar
renderCalendar();
// lets hide today btn if its already current month and vice versa

function hideTodayBtn() {
  if (
    currentMonth === new Date().getMonth() &&
    currentYear === new Date().getFullYear()
  ) {
    todayBtn.style.display = "none";
  } else {
    todayBtn.style.display = "flex";
  }
}
