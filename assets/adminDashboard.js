import "./styles/adminDashboard.css";

import "./bootstrap";

// --------------------------------------adminDashboard-----------------------------------

// variableGlobale

//convertir le premier caractere en Maj
function strUcFirst(a) {
  return (a + "").charAt(0).toUpperCase() + a.substr(1);
}

//Modifier un logement
const enregistrerEdit = document.querySelector(".btn.fermer.enregistrer");
const jardinCheck = document.querySelector(
  ".form-group.col-md-3.jardin .form-check input"
);

const jardinCheckEdit = document.querySelector(
  ".form-group.col-md-3.jardin .form-check .jardin-edit"
);

window.editLogement = editLogement;
function editLogement(id) {
  event.stopPropagation();
  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");
  for (let i = 0; i < divEditDelete.length; i++) {
    if (!divEditDelete[i].classList.contains("none")) {
      divEditDelete[i].classList.add("none");
    }
  }
  const popUpEditLog = document.querySelector("#edit-popup_" + id);
  popUpEditLog.click();

  const editLogementButton = document.querySelector("#enregistrer_" + id);
  editLogementButton.addEventListener("click", function () {
    console.log("enregistrer");
    // type
    const typeInput = document.querySelector("#typeEdit_" + id);
    const typeValue = typeInput.value;

    // prix
    const prixInput = document.querySelector("#prixEdit_" + id);
    const prixValue = prixInput.value;

    // adresse
    const adresseInput = document.querySelector("#adresseEdit_" + id);
    const adresseValue = adresseInput.value;

    // chambre
    const chambreInput = document.querySelector("#chambreEdit_" + id);
    const chambreValue = chambreInput.value;

    // chambre
    const capaciteInput = document.querySelector("#capaciteEdit_" + id);
    const capaciteValue = capaciteInput.value;

    // chambre
    const salleBainInput = document.querySelector("#salleBainEdit_" + id);
    const salleBainValue = salleBainInput.value;

    // jardin
    const jardinInput = document.querySelector("#gridCheck_" + id);
    const jardinValue = jardinInput.checked ? 1 : 0;

    console.log(jardinValue);

    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.response) {
          console.log("done");
          typeInput.value = this.response.type;
          prixInput.value = this.response.prix;
          adresseInput.value = this.response.adresse;
          chambreInput.value = this.response.chambre;
          capaciteInput.value = this.response.capacite;
          salleBainInput.value = this.response.salleBain;
          jardinInput.checked = this.response.jardin;
          console.log(this.response.jardin);
          alertify.set("notifier", "position", "top-center");
          alertify.success("Vos modification ont été bien enregistré !", 0);
          window.timeout = setTimeout(function () {
            alertify.dismissAll();
          }, 2000);
        }
      }
    };
    xhr.open(
      "POST",
      "editLogement/" +
        id +
        "/" +
        strUcFirst(typeValue) +
        "/" +
        prixValue +
        "/" +
        adresseValue +
        "/" +
        chambreValue +
        "/" +
        capaciteValue +
        "/" +
        salleBainValue +
        "/" +
        jardinValue,
      true
    );
    console.log(jardinValue);
    xhr.responseType = "json";
    xhr.send(id);
  });
}

//----------------------------
// delete logement
window.deleteLog = deleteLog;
function deleteLog(id, element) {
  console.log(element);
  if (element != "fermer") {
    event.stopPropagation();
  }

  console.log("delete logement");
  for (let i = 0; i < divEditDelete.length; i++) {
    if (!divEditDelete[i].classList.contains("none")) {
      divEditDelete[i].classList.add("none");
    }
  }
  const popUpDelete = document.querySelector("#delete-logement-popup_" + id);
  popUpDelete.click();
  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");

  const deleteButton = document.querySelector("#delete_" + id);
  deleteButton.addEventListener("click", function () {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.response) {
          console.log(this.response.essai);
          alertify.set("notifier", "position", "top-center");
          alertify.success("Le logement a été bien supprimé !", 0);
          window.timeout = setTimeout(function () {
            window.location.reload(true);
          }, 3000);
        }
      }
    };
    xhr.open("POST", "deleteLogement/" + id, true);
    xhr.responseType = "json";
    xhr.send(id);
  });
}
//select logement
window.select = select;
function select(
  type,
  titre,
  prix,
  adresse,
  chambre,
  capacite,
  salleBain,
  jardin
) {
  event.stopPropagation();
  const divEditDelete = document.querySelectorAll(".edit_delete");
  const jardinElt = document.querySelector(".form-group.col-md-3.jardin");
  let titreInput = document.querySelector("#exampleModalLongTitle");
  const typeInput = document.querySelector(
    ".modal-body .form-group #typeInput"
  );
  const prixInput = document.querySelector(
    ".modal-body .form-group #prixInput"
  );
  const adresseInput = document.querySelector(
    ".modal-body .form-group #adresseInput"
  );
  const chambreInput = document.querySelector(
    ".modal-body .form-group #chambreInput"
  );

  const capaciteInput = document.querySelector(
    ".modal-body .form-group #capaciteInput"
  );
  const salleBainInput = document.querySelector(
    ".modal-body .form-group #salleBainInput"
  );

  if (!typeInput.value) {
    typeInput.value = strUcFirst(type);
  }

  prixInput.value = prix + "$";

  adresseInput.value = strUcFirst(adresse);

  chambreInput.value = chambre;

  capaciteInput.value = capacite;

  salleBainInput.value = salleBain;

  titreInput.innerHTML = strUcFirst(titre);

  if (jardin) {
    jardinElt.style.display = "block";
    jardinCheck.checked = true;
  } else {
    jardinElt.style.display = "none";
  }
  document.querySelector("#select-popup").click();

  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");
  for (let i = 0; i < divEditDelete.length; i++) {
    if (!divEditDelete[i].classList.contains("none")) {
      divEditDelete[i].classList.add("none");
    }
  }
}

// -----------------------------------------------------------------------------------
function checkMediaQuery() {
  // If the inner width of the window is greater then 768px
  if (window.innerWidth < 768 || window.screen.width < 768) {
    sidebar.classList.add("hide");
    navAdmin.classList.add("toggle");

    searchButtonIcon.classList.replace("bx-x", "bx-search");
    searchForm.classList.remove("show");
  }
}
// Add a listener for when the window resizes
window.addEventListener("resize", checkMediaQuery);

// EDIT_delete
const divEditDelete = document.querySelectorAll(".edit_delete");

const troisPoint = document.querySelectorAll(
  "#admin_content .table-data .logement .logement-list li #self .icon-ajouter i"
);

const admin_logement_lien = document.querySelectorAll(
  "#admin_content .table-data .logement .logement-list li a "
);
troisPoint.forEach(function (element) {
  element.addEventListener("click", (event) => {
    event.stopPropagation();
    // element.style.top = ` ${element.parentElement.previousElementSibling.id}0`;
    // element.parentElement.style.top =
    //   String(element.parentElement.previousElementSibling.id) + "0px";

    divEditDelete.forEach(function (div) {
      if (div.id == element.parentElement.parentElement.parentElement.id) {
        div.classList.toggle("none");
      } else {
        div.classList.add("none");
      }
    });
  });
});

// ____________________________________________________________________________

const allSlideMenu = document.querySelectorAll("#sidebar .side-menu.top li a");
allSlideMenu.forEach((item) => {
  const li = item.parentElement;

  item.addEventListener("click", () => {
    allSlideMenu.forEach((i) => {
      i.parentElement.classList.remove("active");
    });
    li.classList.add("active");
  });
});

// Toggle  Sidebar

const menuBar = document.querySelector("#admin_content nav .bx.bx-menu");
const sidebar = document.getElementById("sidebar");
const brand = document.querySelector("#sidebar .brand");
const adminContent = document.getElementById("admin_content");
const navAdmin = document.querySelector("#admin_content nav");
const searchButton = document.querySelector(
  "#admin_content nav form .form-input button "
);
const searchButtonIcon = document.querySelector(
  "#admin_content nav form .form-input button .bx"
);
const searchForm = document.querySelector("#admin_content nav form");
const divOrder = document.querySelector(
  "#admin_content .table-data .order.utilisateur"
);
const afficherTout = document.querySelector(".afficher_tout");

afficherTout.addEventListener("mouseover", () => {
  afficherTout.style.fontWeight = "600";
  afficherTout.style.fontSize = "17px";
  divOrder.style.boxShadow = "rgba(0, 0, 0, 0.15) 0px 3px 3px 0px";

  afficherTout.addEventListener("mouseleave", () => {
    divOrder.style.boxShadow = "";
    afficherTout.style.fontSize = "15px";
    afficherTout.style.fontWeight = "500";
  });
});

menuBar.addEventListener("click", () => {
  sidebar.classList.toggle("hide");
  navAdmin.classList.toggle("toggle");
  adminContent.classList.toggle("_width_60");
});

searchButton.addEventListener("click", function (e) {
  if (window.innerWidth < 576) {
    e.preventDefault();
    searchForm.classList.toggle("show");
    console.log(searchForm.classList);
    if (searchForm.classList.contains("show")) {
      searchButtonIcon.classList.replace("bx-search", "bx-x");
    }
    if (!searchForm.classList.contains("show")) {
      searchButtonIcon.classList.replace("bx-x", "bx-search");
    }
  }
});

// ajouter un logement ================== :
const ajouterLogement = document.querySelector(
  "#admin_content .table-data .logement .head .bx.bx-plus"
);

const divAddLog = document.querySelector(".addLog");
const overlay = document.querySelector(".overlay-addLog");
const closeAddLog = document.querySelector(".close-addLog");

ajouterLogement.addEventListener("click", () => {
  divAddLog.classList.remove("none");
  overlay.classList.remove("none");
  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");

  closeAddLog.addEventListener("click", () => {
    divAddLog.classList.add("none");
    overlay.classList.add("none");
  });

  overlay.addEventListener("click", () => {
    divAddLog.classList.add("none");
    overlay.classList.add("none");
  });
});

// Partie user ============================== :
// Modification du role
const btnAsk = document.querySelectorAll(".btn.fermer.ask");
const enregistrerUser = document.querySelectorAll(
  ".btn.fermer.enregistrer.user"
);

window.editUser = editUser;
function editUser(id, name) {
  const collapse = document.querySelector("#collapseExample_" + id);
  const ask = document.querySelector("#ask_" + id);
  const selectRole = document.querySelector(".form-edit-user #select_" + id);
  console.log(selectRole.value);
  const editModalButton = document.querySelector("#edit-user-popup_" + id);
  const editRole = document.querySelector(".form-edit-user .label_" + id);

  if (collapse.classList.contains("show")) {
    collapse.classList.remove("show");
  }
  ask.style.display = "block";
  editModalButton.click();
  editRole.innerHTML = strUcFirst(name) + " :";

  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");

  enregistrerUser.forEach(function (button) {
    button.addEventListener("click", () => {
      const selectRole = document.querySelector(
        ".form-edit-user #select_" + id
      );

      console.log("submited");
      console.log(selectRole.value);
      const xhr = new XMLHttpRequest();
      const role = selectRole.value;

      xhr.onload = function () {
        if (this.readyState == 4 && this.status == 200) {
          console.log("done");
          if (this.response) {
            console.log(this.response.role);
            alertify.set("notifier", "position", "top-center");
            alertify.success("Vos modification ont été bien enregistré !", 0);
            window.timeout = setTimeout(function () {
              window.location.reload(true);
            }, 2000);
          }
        }
      };
      xhr.open("POST", "editUser/" + id, true);
      xhr.responseType = "json";
      xhr.send(role);
      // media query changes
      sidebar.classList.toggle("hide");
      navAdmin.classList.toggle("toggle");
      adminContent.classList.toggle("_width_60");
    });
  });
}

btnAsk.forEach(function (btn) {
  btn.addEventListener("click", () => {
    btn.style.display = "none";
  });
});

// ----------------------------
// Delete user :

window.deleteUser = deleteUser;

function deleteUser(id) {
  console.log(id);
  const popUpDelete = document.querySelector("#delete-user-popup_" + id);
  popUpDelete.click();
  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");

  const deleteButton = document.querySelector("#delete_" + id);
  deleteButton.addEventListener("click", function () {
    const xhr = new XMLHttpRequest();
    xhr.onload = function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.response) {
          console.log(this.response.essai);
          alertify.set("notifier", "position", "top-center");
          alertify.success("L'utilisateur a été bien supprimé !", 0);
          window.timeout = setTimeout(function () {
            window.location.reload(true);
          }, 2000);
          window.location.reload(true);
        }
      }
    };
    xhr.open("POST", "deleteUser/" + id, true);
    xhr.responseType = "json";
    xhr.send(id);
  });
}

// Partie News ============================== :
// Modification
window.editNews = editNews;
function editNews(id) {
  console.log(id);
  const editModalButton = document.querySelector("#edit-news-popup_" + id);

  editModalButton.click();
  // media query changes
  sidebar.classList.add("hide");
  navAdmin.classList.add("toggle");
  adminContent.classList.add("_width_60");
}
