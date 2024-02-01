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

const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

// get current date
const date = new Date();

// get current month
let currentMonth = date.getMonth();

// get current year
let currentYear = date.getFullYear();

// function to render days
function renderCalendar() {
  // Fetch status data asynchronously
  fetch(`fetch_status.php?month=${currentMonth + 1}&year=${currentYear}`)
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
        days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
      }

      // current month days
      for (let i = 1; i <= lastDayDate; i++) {
        // calculate the background color based on the status from PHP
        const dayStatusData = statusData[i] || { month: currentMonth, year: currentYear, status: 0 };
        const bgColor = dayStatusData.status === 1 ? 'green' : 'red';

        // check if its today then add today class
        if (
          i === new Date().getDate() &&
          currentMonth === new Date().getMonth() &&
          currentYear === new Date().getFullYear()
        ) {
          days += `<div class="day today" style="background-color: ${bgColor}">${i}</div>`;
        } else {
          days += `<div class="day" style="background-color: ${bgColor}">${i}</div>`;
        }
      }

      // next MOnth days
      for (let j = 1; j <= nextDays; j++) {
        days += `<div class="day next">${j}</div>`;
      }

      // run this function with every calendar render
      hideTodayBtn();
      daysContainer.innerHTML = days;
    })
    .catch(error => {
      console.error('Error fetching status data:', error);
      hideTodayBtn();
      daysContainer.innerHTML = "";
    });
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

// function to update the calendar when the month and year change
// function updateCalendar() {
//   fetch(`fetch_status.php?month=${currentMonth + 1}&year=${currentYear}`)
//     .then(response => response.json())
//     .then(data => {
//       console.log('Received status data:', data);
//       statusData = data;
//       renderCalendar(); 
//     })
//     .catch(error => {
//       console.error('Error fetching status data:', error);
//       hideTodayBtn();
//       daysContainer.innerHTML = "";
//     });
// }

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
