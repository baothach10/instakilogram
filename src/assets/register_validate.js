function validateEmail() {
    let email = document.querySelector("#email").value;
    const validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    const emailedit = document.querySelector("#email");


    let emailValid = email.match(validRegex);
    if (emailValid) {
        emailedit.style.border = "2px solid #EBECEC";
        return emailValid;
    } else {
        emailedit.style.border = "2px solid rgb(255, 23, 0)";
        return emailValid;
    }
}

function validatePassword() {
  let pass = document.querySelector("#password");
  let repass = document.querySelector("#retype_password");
  var pattern = /^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])(.{8,20})$/;
  if (pattern.test(pass.value) === true) {
    pass.style.border = "2px solid #EBECEC";
    pass.setCustomValidity("");
    if (pass.value == repass.value){
        repass.style.border = "2px solid #EBECEC";
        repass.setCustomValidity("");
    }
    else{
        repass.style.border = "2px solid rgb(255, 23, 0)";
        repass.setCustomValidity("Must match password!");
    }
    return true;
  } else {
    pass.style.border = "2px solid rgb(255, 23, 0)";
    pass.setCustomValidity("Wrong format!");
    if (pass.value == repass.value) {
        repass.style.border = "2px solid #EBECEC";

    } else {
        repass.style.border = "2px solid rgb(255, 23, 0)";
    }
    return false;
  }
}
function validateFirstName() {
    let fname = document.querySelector("#f_name").value;
    const firstNameedit = document.querySelector("#f_name");
    const firstnameValid = (fname.length >= 2 && fname.length <= 20);
    if (firstnameValid) {
        firstNameedit.style.border = "2px solid #EBECEC";
        firstNameedit.setCustomValidity("");

    } else {
        firstNameedit.style.border = "2px solid rgb(255, 23, 0)";
        firstNameedit.setCustomValidity("Must contain 2 to 20 characters")
    }
}

function validateLastName() {
    let lname = document.querySelector("#l_name").value;
    const lastNameedit = document.querySelector("#l_name");
    const lastnameValid = (lname.length >= 2 && lname.length <= 20);
    if (lastnameValid) {
        lastNameedit.style.border = "2px solid #EBECEC";
        lastNameedit.setCustomValidity("");
    } else {
        lastNameedit.style.border = "2px solid rgb(255, 23, 0)";
        lastNameedit.setCustomValidity("Must contain 2 to 20 characters");
    }
}

function continuousValidateEmail() {
    validateEmail();
}

function continuousValidatePassword() {
    validatePassword();
}

function continuousValidateFirstName() {
    validateFirstName();
}

function continuousValidateLastName() {
    validateLastName();
}

function resetValidate() {
    document.getElementById("email").removeAttribute("style");
    document.getElementById("password").removeAttribute("style");
    document.getElementById("retype_password").removeAttribute("style");
    document.getElementById("f_name").removeAttribute("style");
    document.getElementById("l_name").removeAttribute("style");
}
function showContent() {
    var popup = document.getElementById("myPopup");
    popup.classList.toggle("show");
  }
