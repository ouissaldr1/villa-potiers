import "./styles/etapeReservation.css";
import "./bootstrap";

// ============================ Page etape reservation =============================
var next_click = document.querySelectorAll(".next_button");
var main_form = document.querySelectorAll(".main-reserver");
var step_list = document.querySelectorAll(".progress-bar li");
var num = document.querySelector(".step-number");
let formnumber = 0;

next_click.forEach(function (next_click_form) {
  next_click_form.addEventListener("click", function () {
    if (!validateform()) {
      return false;
    }
    formnumber++;
    updateform();
    progress_forward();
    contentchange();
  });
});

var back_click = document.querySelectorAll(".back_button");
back_click.forEach(function (back_click_form) {
  back_click_form.addEventListener("click", function () {
    formnumber--;
    updateform();
    progress_backward();
    contentchange();
  });
});

var username = document.querySelector("#user_name");
var shownname = document.querySelector(".shown_name");

var submit_click = document.querySelectorAll(".submit_button");
submit_click.forEach(function (submit_click_form) {
  submit_click_form.addEventListener("click", function () {
    shownname.innerHTML = username.value;
    formnumber++;
    updateform();
  });
});

var heart = document.querySelector(".fa-heart");
heart.addEventListener("click", function () {
  heart.classList.toggle("heart");
});

var share = document.querySelector(".fa-share-alt");
share.addEventListener("click", function () {
  share.classList.toggle("share");
});

function updateform() {
  main_form.forEach(function (mainform_number) {
    mainform_number.classList.remove("active");
  });
  main_form[formnumber].classList.add("active");
}

function progress_forward() {
  // step_list.forEach(list => {

  //     list.classList.remove('active');

  // });

  num.innerHTML = formnumber + 1;
  step_list[formnumber].classList.add("active");
}

function progress_backward() {
  var form_num = formnumber + 1;
  step_list[form_num].classList.remove("active");
  num.innerHTML = form_num;
}

var step_num_content = document.querySelectorAll(".step-number-content");

function contentchange() {
  step_num_content.forEach(function (content) {
    content.classList.remove("active");
    content.classList.add("d-none");
  });
  step_num_content[formnumber].classList.add("active");
}

function validateform() {
  var validate = true;
  var validate_inputs = document.querySelectorAll(".main.active input");
  validate_inputs.forEach(function (vaildate_input) {
    vaildate_input.classList.remove("warning");
    if (vaildate_input.hasAttribute("require")) {
      if (vaildate_input.value.length == 0) {
        validate = false;
        vaildate_input.classList.add("warning");
      }
    }
  });
  return validate;
}

// --------------------------------------calender-----------------------------------
const arrive = document.querySelector(".arrive");
const modalCalendarbtn = document.querySelector("#calendar-button");
const depart = document.querySelector(".depart");
var calendarEl = document.querySelector(".calendar");

const inputsDate = [arrive, depart];

inputsDate.forEach(function (element) {
  element.addEventListener("click", () => {
    modalCalendarbtn.click();
    // calendarEl.classList.toggle("none");
    var calendar = new FullCalendar.Calendar(calendarEl, {
      initialView: "dayGridMonth",
      selectable: true,
      unselectAuto: false,
      dateClick: function (info) {
        element.value = info.dateStr;
        // change the day's background color just for fun
        info.dayEl.style.backgroundColor = "#ccffcc";
        info.dayEl.style.borderRadius = "50%";
      },
      // selectMirror: true,
      locale: "fr",
      timeZone: "Europe",
      headerToolbar: {
        start: "prev",
        center: "title",
        end: "next",
      },
    });
    calendar.render();
  });
});

window.saveStepOne = saveStepOne;
function saveStepOne() {
  const xhttp = new XMLHttpRequest();
  const dateDebut = document.querySelector("#reservation_dateDebut").value;
  const dateFin = document.querySelector("#reservation_dateFin").value;
  console.log(dateDebut);
  console.log(dateFin);
}
