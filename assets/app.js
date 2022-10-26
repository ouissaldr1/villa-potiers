/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import "./styles/app.css";

// start the Stimulus application
import "./bootstrap";

import "./styles/adminDashboard.css";

import "./bootstrap";

// ============================ swiper =============================
var swiper = new Swiper(".card_swiper", {
  // slidesPerView: 3,
  loop: true,
  speed: 1000,
  spaceBetween: 30,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    575: {
      slidesPerView: 1,
    },
    768: {
      slidesPerView: 2,
    },
    1200: {
      slidesPerView: 3,
    },
  },
});

//==========================Scroll animation =================================
//--- default page ---

const sr = ScrollReveal({
  distance: "30px",
  duration: 1800,
  reset: true,
});

sr.reveal(`.swiper-button-prev`, {
  origin: "left",
});

sr.reveal(`.section-bg-img-content .text-content h1, .content .title h2`, {
  origin: "top",
  interval: 200,
});

sr.reveal(`.grid1 .img1,.grid1 .img2`, {
  origin: "top",
  interval: 190,
});
sr.reveal(`.grid1 .img3,.grid1 .img4`, {
  origin: "bottom",
  interval: 190,
});
sr.reveal(`#item1,#item2,#item3,#item4,#item5,#item6`, {
  origin: "left",
  interval: 200,
});

sr.reveal(`#btnRevealLeft`, {
  origin: "left",
});

sr.reveal(`.red-div `, {
  origin: "bottom",
  duration: 2000,
});
sr.reveal(`section-bg-img-content .text-content p.list-log`, {
  origin: "bottom",
});
sr.reveal(
  `.back-img-qui,.two-buttons .btn-secondary.scroll,.swiper-button-next`,
  {
    origin: "right",
  }
);

// ---- end page default ---
// ---- page list logement ---
sr.reveal(`.main .grid-3c.list-log .slider-annonce`, {
  origin: "left",
  interval: 250,
});

// --- end list logement ----
// --- page details logement ---
sr.reveal(`.annonce.price-detail.scroll-bottom`, {
  origin: "bottom",
  delay: 0.5,
});

sr.reveal(`.scroll-top`, {
  origin: "top",
});

// footer

sr.reveal(
  `.footer .footer-grid #grid1,.footer .footer-grid #grid2,.footer .footer-grid #grid3,.footer .footer-grid #grid4`,
  {
    origin: "bottom",
    interval: 150,
  }
);

// --- end page details logement ---

// ============================ Page default   =============================
const signRegister = document.querySelector(".sign-register");
const footer = document.querySelector(".footer-wrapper");
const sliderannonce = document.querySelector(".slider-annonce");

const close = document.querySelector(".close");
const btnToggle = document.querySelector(".btn-toggler");
const headerNav = document.querySelector(".header-media");

btnToggle.addEventListener("click", () => {
  close.classList.toggle("none");
  btnToggle.classList.toggle("none");
  headerNav.classList.toggle("none");
});

close.addEventListener("click", () => {
  close.classList.toggle("none");
  btnToggle.classList.toggle("none");
  headerNav.classList.toggle("none");
});

sliderannonce.addEventListener("mouseover", () => {
  sliderannonce.style.color = "red";
});

// window.addEventListener("DOMContentLoaded", function () {
//   var calendarEl = document.querySelector(".calendar");
//   arrive.addEventListener("click", () => {
//     calendarEl.classList.toggle("none");
//     calendarEl.fullCalendar("render");
//   });
//   var calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: "dayGridMonth",
//     selectable: true,
//     unselectAuto: false,

//     dateClick: function (info) {
//       arrive.value = info.dateStr;
//       console.log(info.dateStr);
//       alert("Coordinates: " + info.jsEvent.pageX + "," + info.jsEvent.pageY);
//       alert("Current view: " + info.view.type);
//       // change the day's background color just for fun
//       info.dayEl.style.backgroundColor = "red";
//     },
//     // selectMirror: true,
//     locale: "fr",
//     timeZone: "Europe",
//     headerToolbar: {
//       start: "prev",
//       center: "title",
//       end: "next",
//     },
//   });
//   calendar.render();
// });

// --------------------------------------slider mulit items -----------------------------
$(document).ready(function () {
  var itemsMainDiv = ".MultiCarousel";
  var itemsDiv = ".MultiCarousel-inner";
  var itemWidth = "";

  $(".leftLst, .rightLst").click(function () {
    var condition = $(this).hasClass("leftLst");
    if (condition) click(0, this);
    else click(1, this);
  });

  ResCarouselSize();

  $(window).resize(function () {
    ResCarouselSize();
  });

  //this function define the size of the items
  function ResCarouselSize() {
    var incno = 0;
    var dataItems = "data-items";
    var itemClass = ".item";
    var id = 0;
    var btnParentSb = "";
    var itemsSplit = "";
    var sampwidth = $(itemsMainDiv).width();
    var bodyWidth = $("body").width();
    $(itemsDiv).each(function () {
      id = id + 1;
      var itemNumbers = $(this).find(itemClass).length;
      btnParentSb = $(this).parent().attr(dataItems);
      itemsSplit = btnParentSb.split(",");
      $(this)
        .parent()
        .attr("id", "MultiCarousel" + id);

      if (bodyWidth >= 1200) {
        incno = itemsSplit[3];
        itemWidth = sampwidth / incno;
      } else if (bodyWidth >= 992) {
        incno = itemsSplit[2];
        itemWidth = sampwidth / incno;
      } else if (bodyWidth >= 768) {
        incno = itemsSplit[1];
        itemWidth = sampwidth / incno;
      } else {
        incno = itemsSplit[0];
        itemWidth = sampwidth / incno;
      }
      $(this).css({
        transform: "translateX(0px)",
        width: itemWidth * itemNumbers,
      });
      $(this)
        .find(itemClass)
        .each(function () {
          $(this).outerWidth(itemWidth);
        });

      $(".leftLst").addClass("over");
      $(".rightLst").removeClass("over");
    });
  }

  //this function used to move the items
  function ResCarousel(e, el, s) {
    var leftBtn = ".leftLst";
    var rightBtn = ".rightLst";
    var translateXval = "";
    var divStyle = $(el + " " + itemsDiv).css("transform");
    var values = divStyle.match(/-?[\d\.]+/g);
    var xds = Math.abs(values[4]);
    if (e == 0) {
      translateXval = parseInt(xds) - parseInt(itemWidth * s);
      $(el + " " + rightBtn).removeClass("over");

      if (translateXval <= itemWidth / 2) {
        translateXval = 0;
        $(el + " " + leftBtn).addClass("over");
      }
    } else if (e == 1) {
      var itemsCondition = $(el).find(itemsDiv).width() - $(el).width();
      translateXval = parseInt(xds) + parseInt(itemWidth * s);
      $(el + " " + leftBtn).removeClass("over");

      if (translateXval >= itemsCondition - itemWidth / 2) {
        translateXval = itemsCondition;
        $(el + " " + rightBtn).addClass("over");
      }
    }
    $(el + " " + itemsDiv).css(
      "transform",
      "translateX(" + -translateXval + "px)"
    );
  }

  //It is used to get some elements from btn
  function click(ell, ee) {
    var Parent = "#" + $(ee).parent().attr("id");
    var slide = $(Parent).attr("data-slide");
    ResCarousel(ell, Parent, slide);
  }
});
