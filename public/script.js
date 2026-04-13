// Form validation
const registerForm = document.querySelector("#register-form");

function addRegisterFormValidation() {
  const validation = new JustValidate("#register-form");

  validation
    .addField("#name", [
      {
        rule: "required",
      },
    ])
    .addField("#email", [
      {
        rule: "required",
      },
      {
        rule: "email",
      },
      {
        validator: (value) => async () => {
          return await fetch(
            `../src/validate-email.php?email=${encodeURIComponent(value)}`,
          )
            .then((res) => {
              return res.json();
            })
            .then((json) => {
              return json.isAvailable;
            });
        },
        errorMessage: "Email already taken.",
      },
    ])
    .addField("#password", [
      {
        rule: "required",
      },
      {
        rule: "password",
      },
    ])
    .addField("#password-confirm", [
      {
        validator: (value, fields) => {
          return value === fields["#password"].elem.value;
        },
        errorMessage: "Passwords do not match.",
      },
    ])
    .onSuccess((event) => {
      const registerForm = document.getElementById("register-form");
      registerForm.submit();
    });
}

if (registerForm) {
  addRegisterFormValidation();
}

// bookings data
const bookingsTable = document.querySelector("#bookings-table");
const bookingsTableInfoText = document.querySelector(
  "#bookings-table-info-text",
);

async function getBookingsData() {
  try {
    const response = await fetch("../src/get-bookings-data.php", {
      method: "GET",
      "Content-Type": "application/json",
    });

    if (!response.status === 200) {
      bookingsTableInfoText.innerHTML = `
        <em style="color: red;">
          An error occurred while trying to display bookings data...
        </em>
      `;

      throw new Error(response.status);
    }

    const data = await response.json();
    console.log(data);
    return data;
  } catch (error) {
    console.log(error);
  }
}

const bookingSlots = document.getElementsByClassName("booking-slot");
let amtOfSlots;

async function displayBookingsTableData() {
  const userId = parseInt(localStorage.getItem("userId"));
  const weekNumber = getWeek();
  const payload = await getBookingsData();

  for (let i = 0; i < payload.length; i++) {
    if (payload[i].user_id == userId && payload[i].week_number == weekNumber) {
      bookingSlots[i].classList.add("booking-slot-user");
    }
  }

  for (let i = 0; i < bookingSlots.length; i++) {
    bookingSlots[i].innerHTML = bookingSlots[i].id;
  }
}

if (bookingsTable) {
  displayBookingsTableData();
}

async function createBooking(userId, slotNumber, weekNumber, date, time) {
  try {
    const data = {
      user_id: userId,
      slot_number: slotNumber,
      week_number: weekNumber,
      date: date,
      time: time,
    };

    const response = await fetch("../src/create-booking.php", {
      method: "POST",
      "Content-Type": "application/json",
      body: data,
    });
  } catch (e) {
    console.log(e);
  }
}

if (bookingSlots) {
  const userId = parseInt(localStorage.getItem("userId"));
  const weekNumber = getWeek();
  let slotSelected;
  let timeSelected;

  for (let i = 0; i < bookingSlots.length; i++) {
    bookingSlots[i].addEventListener("click", async () => {
      if (bookingSlots[i].classList.contains("booking-available")) {
        return;
      }

      slotSelected = bookingSlots[i].id.slice(4);

      if (slotSelected <= 7) {
        timeSelected = "8:00-9:00";
      } else if (slotSelected > 7 && slotSelected <= 14) {
        timeSelected = "9:00-10:00";
      } else if (slotSelected > 14 && slotSelected <= 21) {
        timeSelected = "10:00-11:00";
      } else if (slotSelected > 21 && slotSelected <= 28) {
        timeSelected = "11:00-12:00";
      } else if (slotSelected > 28 && slotSelected <= 35) {
        timeSelected = "12:00-13:00";
      } else if (slotSelected > 35 && slotSelected <= 42) {
        timeSelected = "13:00-14:00";
      } else if (slotSelected > 42 && slotSelected <= 49) {
        timeSelected = "14:00-15:00";
      } else if (slotSelected > 49 && slotSelected <= 56) {
        timeSelected = "15:00-16:00";
      } else if (slotSelected > 56 && slotSelected <= 63) {
        timeSelected = "16:00-17:00";
      } else if (slotSelected > 63 && slotSelected <= 70) {
        timeSelected = "17:00-18:00";
      } else if (slotSelected > 70 && slotSelected <= 77) {
        timeSelected = "18:00-19:00";
      } else if (slotSelected > 77 && slotSelected <= 84) {
        timeSelected = "19:00-20:00";
      } else {
        timeSelected = "20:00-21:00";
      }

      console.log(slotSelected);
      // await createBooking(userId, slotSelected, weekNumber, "", timeSelected);
    });
  }
}

// Returns the ISO week of the date.
// Source: https://weeknumber.com/how-to/javascript
function getWeek() {
  var date = new Date();
  date.setHours(0, 0, 0, 0);
  // Thursday in current week decides the year.
  date.setDate(date.getDate() + 3 - ((date.getDay() + 6) % 7));
  // January 4 is always in week 1.
  var week1 = new Date(date.getFullYear(), 0, 4);
  // Adjust to Thursday in week 1 and count number of weeks from date to week1.
  return (
    1 +
    Math.round(
      ((date.getTime() - week1.getTime()) / 86400000 -
        3 +
        ((week1.getDay() + 6) % 7)) /
        7,
    )
  );
}

const currWeek = document.querySelector("#week-number");

if (currWeek) {
  const week = getWeek();
  currWeek.innerHTML = `Week ${week.toString()}`;
}

const currWeekFirstDate = document.querySelector("#week-first-date");
const currWeekLastDate = document.querySelector("#week-last-date");

function displayCurrentWeekFirstAndLastDate() {
  const start = new Date();
  start.setDate(start.getDate() - start.getDay() + 1);

  const end = new Date(start);
  end.setDate(end.getDate() + 6);

  currWeekFirstDate.innerHTML = start.toLocaleDateString();
  currWeekLastDate.innerHTML = end.toLocaleDateString();
}

if (currWeekFirstDate && currWeekLastDate) {
  displayCurrentWeekFirstAndLastDate();
}
