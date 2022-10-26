import "./styles/login.css";

// start the Stimulus application
import "./bootstrap";
// ============================ Page login and register =============================
const signUpButton = document.getElementById("signUp");
const signInButton = document.getElementById("signIn");

const container = document.getElementById("Container");
signUpButton.addEventListener("click", () => {
  container.classList.add("right-panel-active");
  const con = document.querySelector(".sign-in-container");
});

signInButton.addEventListener("click", () => {
  container.classList.remove("right-panel-active");
});

// ============================ En cas d'erreur d'authentification =============================
const option = document.getElementById("option");
const label_sign = document.querySelectorAll(".label_sign");
if (option.classList.contains("erreurs")) {
  container.classList.add("right-panel-active");
}

// ============================ Click clavier =============================
const input = document.querySelectorAll(".form-container .form-group input");
input.forEach(function (input) {
  input.addEventListener("keypress", function (event) {
    if (event.key === "Enter") {
      event.preventDefault();
      document.getElementById("register").click();
    }
  });
});
// ============================ Forget password =============================

// const forgetPassword = document.querySelector(".forget_password span");
// console.log(forgetPassword);
// forgetPassword.addEventListener("click", function () {
//   const loginForm = document.querySelector(
//     ".form-container.sign-in-container form"
//   );
//   loginForm.classList.add("none");
//   const forgetForm = document.querySelector(".forget_div");
//   console.log(forgetForm);
//   forgetForm.classList.remove("none");
// });
