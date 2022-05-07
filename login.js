window.onload = main;

function main() {
    initialState();
    document.querySelectorAll("#account-info .c-field__wrapper")[1].addEventListener("focusin", onPasswdInputFocusIn);
    document.querySelectorAll("#account-info .c-field__wrapper")[1].addEventListener("focusout", onPasswdInputFocusOut);
}

function initialState() {
    document.querySelector("#account-info input:nth-child(1)").focus();
    document.querySelector("#account-info").classList.add("c-accordion__item--active-leftborder");
    document.querySelector("#account-info .c-accordion__summary").classList.add("c-accordion__summary--hidden");
    document.querySelector("#account-info .c-accordion__circle").classList.add("c-accordion__circle--active-circle");
    document.querySelectorAll("#account-info .c-field")[1].classList.add("c-field--disabled");
}

function checkEmail(event) {
    let email = event.target.value;
    let re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    if(email.length == 0) {
        return false;
    } else {
        return String(email).toLowerCase().match(re);
    }
}

function onEmailInputChangeHandler(event) {
    if(!checkEmail(event)) {
        document.querySelectorAll("#account-info .c-field__outer-wrapper")[0].setAttribute("data-invalid", true);
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[0].classList.remove("fa-solid", "fa-check");
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[0].classList.add("fa-solid", "fa-arrow-right-long");
        document.querySelectorAll("#account-info .c-accordion__content .c-btn")[0].disabled = false;
        document.querySelectorAll("#account-info .c-field")[1].classList.add("c-field--disabled");
    } else {
        document.querySelectorAll("#account-info .c-field__outer-wrapper")[0].setAttribute("data-invalid", false);
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[0].classList.remove("fa-solid", "fa-arrow-right-long");
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[0].classList.add("fa-solid", "fa-check");
        document.querySelectorAll("#account-info .c-accordion__content .c-btn")[0].disabled = true;
        document.querySelectorAll("#account-info .c-field")[1].classList.remove("c-field--disabled");
        document.querySelectorAll("#account-info .c-accordion__content .c-field__input")[1].focus();
    }
}

function onPasswordButtonClick(e) {
    console.log(document.querySelectorAll("#account-info .c-accordion__content .c-field__input")[1].type);
    document.querySelectorAll("#account-info .c-accordion__content .c-field__input")[1].type === "password" ? (
        document.querySelectorAll("#account-info .c-accordion__content .c-field__input")[1].type = "text"
    ) : (
        document.querySelectorAll("#account-info .c-accordion__content .c-field__input")[1].type = "password"
    )
    
    document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[1].classList.contains("fa-eye") ? (
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[1].classList.remove("fa-solid", "fa-eye"),
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[1].classList.add("fa-solid", "fa-eye-slash")
    ) : (
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[1].classList.remove("fa-solid", "fa-eye-slash"),
        document.querySelectorAll("#account-info .c-accordion__content .c-btn i")[1].classList.add("fa-solid", "fa-eye")
    )
}

function onPasswdInputFocusIn() {
    document.querySelector(".c-password-helper__outer-wrapper").style.display = "block";
}

function onPasswdInputFocusOut() {
    document.querySelector(".c-password-helper__outer-wrapper").style.display = "none";
}

function onPasswdInputValidation(event) {
    const mdp = event.target.value;
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    mdp.length >= 8 && mdp.length <= 32 ? document.getElementById("rule1").classList.add("validate") : document.getElementById("rule1").classList.remove("validate");
    mdp.toLowerCase() != mdp ? document.getElementById("rule2").classList.add("validate") : document.getElementById("rule2").classList.remove("validate");
    mdp.toUpperCase() != mdp ? document.getElementById("rule3").classList.add("validate") : document.getElementById("rule3").classList.remove("validate");
    specialChars.test(mdp) ? document.getElementById("rule4").classList.add("validate") : document.getElementById("rule4").classList.remove("validate");
    updateNodes(mdp);
}
function isPasswdValid(mdp) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    return (mdp.length >= 8 && mdp.length <= 32) && mdp.toLowerCase() != mdp && mdp.toUpperCase() != mdp && specialChars.test(mdp);
}

function countValidPasswdConditions(mdp) {
    const specialChars = /[`!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?~]/;
    count = 0;
    (mdp.length >= 8 && mdp.length <= 32) ? count++ : null;
    mdp.toLowerCase() != mdp ? count++ : null;
    mdp.toUpperCase() != mdp ? count++ : null;
    specialChars.test(mdp) ? count++ : null;
    return count;
}

function updateNodes(mdp) {
    nbValidateNodes = document.getElementsByClassName("c-line-progress__node--valid-node").length;
    nbValidateConditions = countValidPasswdConditions(mdp);

    validNodes = document.getElementsByClassName("c-line-progress__node--valid-node");
    nodes = document.getElementsByClassName("c-line-progress__node");

    if(nbValidateConditions==1 && nbValidateNodes==0) nodes.item(0).classList.add("c-line-progress__node--valid-node");
    if(nbValidateNodes > 0) {
        if(nbValidateConditions > nbValidateNodes) validNodes.item(validNodes.length-1).nextElementSibling.classList.add("c-line-progress__node--valid-node");
        if(nbValidateConditions < nbValidateNodes) validNodes.item(validNodes.length-1).classList.remove("c-line-progress__node--valid-node");
    }
}

function setEmailVerificationStep() {
    const mdp = document.getElementById("mdp-input").value;
    if(isPasswdValid(mdp)) {
        createSummarySection();
        sendEmail("alex17tri@gmail.com");
        document.getElementById("account-email-verification").style.display = "block";
        document.getElementById("btn-verif").style.display = "block";
        document.getElementById("verif-input").focus();
    }
}

function showSummarySection() {
    document.querySelector("#account-info .c-accordion__summary").classList.remove("c-accordion__summary--hidden");
    document.querySelector("#account-info .c-accordion__content").classList.add("c-accordion__content--hidden");
    document.querySelector("#account-info .c-accordion__submit").classList.add("c-accordion__submit--hidden");
    document.querySelectorAll("#account-info .c-accordion__summary p")[0].textContent = document.querySelectorAll("#account-info .c-accordion__content .c-field input")[0].value;
    document.querySelectorAll("#account-info .c-accordion__summary p")[1].textContent = "*".repeat(document.querySelectorAll("#account-info .c-accordion__content .c-field input")[1].value.length);
}

function editInfoAccount() {
    document.querySelector("#account-info .c-accordion__summary").classList.add("c-accordion__summary--hidden");
    document.querySelector("#account-info .c-accordion__content").classList.remove("c-accordion__content--hidden");
    document.querySelector("#account-info .c-accordion__submit").classList.remove("c-accordion__submit--hidden");
}

function goNextFormularSection() {
    showSummarySection();
}

function setPersonalInfosStep() {
    document.getElementById("account-email-verification").style.display = "none";
    document.getElementById("account-personal-informations").style.display = "block";
    document.getElementById("verify-section__circle").classList.remove("--active");
    document.getElementById("verify-section__circle").classList.remove("accordion-item__circle");
    document.getElementById("verify-section__circle").classList.add("--step-validate");
    document.getElementById("personal-section__circle").classList.add("--active");
    document.getElementById("personal-info-step").style.display = "none";
}

function createSummarySection() {
    document.getElementById("email-verif-step").style.display = "none";
    document.getElementById("account-info__summary").style.display = "block";
    document.getElementById("account-info__edit").style.display = "block";
    document.getElementById("account-info__content_section").style.display = "none";
    document.getElementById("email-recap").children[0].textContent = document.getElementById("email-input").value;
    document.getElementById("mdp-recap").children[0].textContent = "*".repeat(document.getElementById("mdp-input").value.length);

    document.getElementById("account-info__circle").classList.remove("--active");
    document.getElementById("account-info__circle").classList.remove("accordion-item__circle");
    document.getElementById("account-info__circle").classList.add("--step-validate");
    document.getElementById("verify-section__circle").classList.add("--active");
}

function editAccountInfo(e) {
    e.stopImmediatePropagation();
    document.getElementById("email-verif-step").style.display = "block";
    document.getElementById("account-info__content_section").style.display = "block";
    document.getElementById("account-info__edit").style.display = "none";
    document.getElementById("account-info__summary").style.display = "none";
    document.getElementById("account-info__circle").classList.add("accordion-item__circle");
    document.getElementById("account-info__circle").classList.remove("--step-validate");
    document.getElementById("account-info__circle").classList.add("--active");
    document.getElementById("btn-verif").style.display = "none";
}

function sendEmail(email) {
	Email.send({
	Host: "smtp.gmail.com",
	Username : "alexandre88.kfoury@gmail.com",
	Password : "Rf17bpe7",
	To : "alex17tri@gmail.com",
	From : "alexandre88.kfoury@gmail.com",
	Subject : "Code",
	Body : "12345678",
	}).then(
		message => alert("mail sent successfully")
	);
}