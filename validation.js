const REGEX = /^[A-Z][a-z]*$/;

function validateEmployeeForm() {
    var errorItemElement;
    var errorListElement = document.getElementById("errorMessages");
    var firstNameElement = document.getElementById("firstName");
    var lastNameElement = document.getElementById("lastName");
    var birthDateElement = document.getElementById("birthDate");
    var hireDateElement = document.getElementById("hireDate");
    errorListElement.innerHTML = '';
    if (firstNameElement.value.match(REGEX) == null) {
        errorItemElement = document.createElement("li");
        errorItemElement.innerText = "You must enter a valid first name.";
        errorListElement.appendChild(errorItemElement);
    }
    if (lastNameElement.value.match(REGEX) == null) {
        errorItemElement = document.createElement("li");
        errorItemElement.innerText = "You must enter a valid last name.";
        errorListElement.appendChild(errorItemElement);
    }
    if (birthDateElement.value === '') {
        errorItemElement = document.createElement("li");
        errorItemElement.innerText = "You must enter a valid birth date.";
        errorListElement.appendChild(errorItemElement);
    }
    if (hireDateElement.value === '') {
        errorItemElement = document.createElement("li");
        errorItemElement.innerText = "You must enter a valid hire date.";
        errorListElement.appendChild(errorItemElement);
    }
    return errorListElement.innerHTML === '';
}
