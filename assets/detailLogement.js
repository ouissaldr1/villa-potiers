// any CSS you import will output into a single css file (app.css in this case)
import "./styles/detailLogement.css";

// start the Stimulus application
import "./bootstrap";
//animation
document.querySelector(".icone-list").addEventListener("click", function (e) {
  document.querySelector(".icone-list .one").classList.toggle("one-animation");
  document.querySelector(".icone-list .two").classList.toggle("two-animation");
  document.querySelector(".nav-menu").classList.toggle("show");
});
