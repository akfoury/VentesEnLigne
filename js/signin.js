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