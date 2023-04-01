let mainGuest = {
    name: "",
    surname: "",
    church_confirm: "",
    castle_confirm: "",
    diet: "",
    allergies: "",
    extraGuests: [],
};

import { RichForm } from "./classes/richForm.js";
import { RichSection } from "./classes/richSection.js";
import { RichLabel } from "./classes/richLabel.js";

let richForms = [];
let forms = document.querySelectorAll('[data-form-sel]');
let sideLabels = document.querySelectorAll('[data-side-sel]');

for(let i = 0; i < forms.length; i++) {
    let richSideLabel = new RichLabel(sideLabels[i]);
    let richForm = new RichForm(forms[i], richSideLabel);

    richForm.element.addEventListener('submit', inputControl);
    richForms.push(richForm);
}

let richSections = [];
let sections = document.querySelectorAll('[data-section-sel]');
for(let i = 0; i < sections.length; i++) {
    let richSection = new RichSection(sections[i]);
    richSections.push(richSection);
}

function sectionSwipeUp() {
    let currentSection = richSections.find(section => section.selected);
    let currentIndex = richSections.indexOf(currentSection);

    if(currentIndex < (richSections.length - 1)) {
        if(currentIndex == 0) {
            navArrows.classList.remove('hidden');
        }

        let newSection = richSections[currentIndex + 1];

        currentSection.selected = false;
        newSection.selected = true;

        document.documentElement.style.setProperty('--section-index', ++currentIndex);
    }
}

function sectionSwipeDown() {
    let currentSection = richSections.find(section => section.selected);
    let currentIndex = richSections.indexOf(currentSection);

    if(currentIndex > 0) {
        if(currentIndex == 1) {
            navArrows.classList.add('hidden');
        }
        if(currentIndex == (richSections.length - 1)) {
            prevAction.removeEventListener('click', sectionSwipeDown);
            prevAction.addEventListener('click', formSwipeDown);
        }

        let newSection = richSections[currentIndex - 1];

        currentSection.selected = false;
        newSection.selected = true;

        document.documentElement.style.setProperty('--section-index', --currentIndex);
    }
}

function formSwipeUp() {
    let enabledForms = richForms.filter(form => form.enabled);
    let currentForm = enabledForms.find(form => form.selected);

    let currentIndex = enabledForms.indexOf(currentForm);

    if(currentIndex < (enabledForms.length - 1)) {
        let newForm = enabledForms[currentIndex + 1];

        currentForm.selected = false;
        newForm.selected = true;

        document.documentElement.style.setProperty('--form-index', ++currentIndex);
    } else {
        sectionSwipeUp();
        prevAction.removeEventListener('click', formSwipeDown);
        prevAction.addEventListener('click', sectionSwipeDown);
    }
}

function formSwipeDown() {
    let enabledForms = richForms.filter(form => form.enabled);
    let currentForm = enabledForms.find(form => form.selected);

    let currentIndex = enabledForms.indexOf(currentForm);

    if(currentIndex > 0) {
        let newForm = enabledForms[currentIndex - 1];

        currentForm.selected = false;
        newForm.selected = true;

        document.documentElement.style.setProperty('--form-index', --currentIndex);
    } else {
        sectionSwipeDown();
    }
}

let readyButton = document.querySelector('.ready-button');
readyButton.addEventListener('click', sectionSwipeUp);

let navArrows = document.querySelector('nav');
let nextAction = navArrows.querySelector('[data-action="next"]');
let prevAction = navArrows.querySelector('[data-action="prev"]');
nextAction.addEventListener('click', inputControl);
prevAction.addEventListener('click', formSwipeDown);

function inputControl(event) {
    event.preventDefault();

    let currentForm = richForms.find(form => form.selected);
    let currentContent = currentForm.content;
    currentForm.inputValidation().then(currentValue => 
        {
            if(currentValue !== false) {
                switch(currentValue) {
                    case "1":
                        mainGuest[currentContent] = currentValue;
                        currentValue = "Sì"
                        break;
                    case "0":
                        mainGuest[currentContent] = currentValue;
                        currentValue = "No"
                        break;
                    default:
                        mainGuest[currentContent] = currentValue;
                        break;
                }
                
                if(currentContent == "castle_confirm") {

                    let dietForm = richForms.find(form => form.content == "diet");
                    let allergiesForm = richForms.find(form => form.content == "allergies");
                    let extraConfirmForm = richForms.find(form => form.content == "extra_confirm");

                    if(currentValue == 'Sì') {
                        dietForm.enabled = true;
                        allergiesForm.enabled = true;
                        extraConfirmForm.enabled = true;
                    } else {
                        dietForm.enabled = false;
                        allergiesForm.enabled = false;
                        extraConfirmForm.enabled = false;

                        mainGuest["diet"] = "";
                        mainGuest["allergies"] = "";
                        mainGuest["extra_confirm"] = "";
                    }
                }
            
                if(currentContent == "extra_confirm") {
                    let extraGuestsForm = richForms.find(form => form.content == "extra_guests");

                    if(currentValue == 'Sì') {
                        extraGuestsForm.enabled = true;
                    } else {
                        mainGuest.extraGuests.splice(0, Infinity);
                        extraGuestsForm.enabled = false;
                    }
                }

                formSwipeUp();
            }
        }
    );
}

let addExtraButton = document.querySelector('.add-guest');
addExtraButton.addEventListener('click', addExtraGuest);

function addExtraGuest(event) {
    event.preventDefault();

    let currentForm = richForms.find(form => form.content == "extra_guests");
    let extraToken = currentForm.elements['_token'];
    let extraInputs = Array.prototype.filter.call(currentForm.elements, (input => input.type == "text"));

    if(mainGuest.extraGuests.length >= 10) {
        let textError = "Non puoi aggiungere più di 10 ospiti.";
        let errorList = {"guestsLength": [textError]};
        currentForm.showError(errorList);
    } else {
        let extraGuestData = new FormData();
        extraGuestData.append('_token', extraToken.value);
        extraInputs.forEach(input => extraGuestData.append(input.name, input.value));

        fetch('/guest/validate', {
            method: 'post',
            body: extraGuestData,
        })
            .then((servResponse) => servResponse.json())
            .then((jsonData) => onExtraGuestValidation(jsonData))
            .catch((servError) => console.log(servError));
    }
}

function onExtraGuestValidation(jsonData) {
    let currentForm = richForms.find(form => form.content == "extra_guests");

    if(jsonData.error) {
        currentForm.showError(jsonData.error);
    } else {
        let extraGuest = {};
        for(let property in jsonData.success) {
            extraGuest[property] = jsonData.success[property]
        }
        mainGuest.extraGuests.push(extraGuest);
        currentForm.sideLabel.value = mainGuest.extraGuests.length;
        currentForm.element.querySelector('.error-box').innerHTML = "";
        currentForm.element.querySelector('.error-box').classList.add('hidden');
        currentForm.element.reset();

        createGuestLabel(extraGuest);
    }
}

function createGuestLabel(extraGuest) {
    let guestLabel = document.createElement('label');
    guestLabel.classList.add("extra-guest-label");
    guestLabel.dataset.guestIndex = mainGuest.extraGuests.indexOf(extraGuest);
    guestLabel.addEventListener('click', toggleGuestDetails);

    let fullName = document.createElement('p');
    fullName.textContent = extraGuest.name + " " + extraGuest.surname;

    let deleteGuestButton = document.createElement('img');
    deleteGuestButton.src = "../storage/images/no.svg";
    deleteGuestButton.addEventListener('click', deleteExtraGuest);

    let hiddenInput = document.createElement('input');
    hiddenInput.type = "radio";
    hiddenInput.name = "extra_guest";
    hiddenInput.value = extraGuest.name + " " + extraGuest.surname;

    guestLabel.appendChild(fullName);
    guestLabel.appendChild(deleteGuestButton);
    guestLabel.appendChild(hiddenInput);

    let extraGuestsContainer = document.querySelector('.extra-guests-container');
    extraGuestsContainer.appendChild(guestLabel);
}

function toggleGuestDetails(event) {
    event.preventDefault();

    let currentLabel = event.currentTarget;
    let currentRadio = currentLabel.querySelector('input');
    let currentForm = richForms.find(form => form.content == "extra_guests");

    if(currentRadio.checked) {
        currentRadio.checked = false;
        currentForm.element.reset();

        addExtraButton.firstElementChild.textContent = "Aggiungi Ospite";
        addExtraButton.lastElementChild.textContent = "+";
        addExtraButton.removeEventListener('click', editExtraGuest);
        addExtraButton.addEventListener('click', addExtraGuest);
    }
    
    else {
        currentRadio.checked = true;

        let currentGuest = mainGuest.extraGuests[currentLabel.dataset.guestIndex];
        let extraInputs = Array.prototype.filter.call(currentForm.elements, (input => input.type == "text"));
        extraInputs.forEach(input => input.value = currentGuest[input.name]);

        addExtraButton.firstElementChild.textContent = "Modifica Ospite";
        addExtraButton.lastElementChild.textContent = "";
        addExtraButton.removeEventListener('click', addExtraGuest);
        addExtraButton.addEventListener('click', editExtraGuest);
    }
}

function editExtraGuest(event) {
    event.preventDefault();

    let currentForm = richForms.find(form => form.content == "extra_guests");
    let extraToken = currentForm.elements['_token'];
    let extraInputs = Array.prototype.filter.call(currentForm.elements, (input => input.type == "text"));

    let extraGuestData = new FormData();
    extraGuestData.append('_token', extraToken.value);
    extraInputs.forEach(input => extraGuestData.append(input.name, input.value));

    fetch('/guest/validate', {
        method: 'post',
        body: extraGuestData,
    })
        .then((servResponse) => servResponse.json())
        .then((jsonData) => onExtraGuestEditValidation(jsonData))
        .catch((servError) => console.log(servError));
}

function onExtraGuestEditValidation(jsonData) {
    let currentForm = richForms.find(form => form.content == "extra_guests");
    let currentLabel = currentForm.element.querySelector('.extra-guest-label:has(input[type="radio"]:checked)');
    let currentGuest = mainGuest.extraGuests[currentLabel.dataset.guestIndex];

    if(jsonData.error) {
        let extraInputs = Array.prototype.filter.call(currentForm.elements, (input => input.type == "text"));
        extraInputs.forEach(input => input.value = currentGuest[input.name]);

        jsonData.error.editGuest = ["Sono stati caricati i dati precedentemente validati."];
        currentForm.showError(jsonData.error);
    } else {
        for(let property in jsonData.success) {
            currentGuest[property] = jsonData.success[property]
        }
        currentForm.element.reset();
    }
}

function deleteExtraGuest(event) {
    event.preventDefault();

    let currentGuestContainer = event.currentTarget.parentElement;
    let currentGuestIndex = currentGuestContainer.dataset.guestIndex;
    
    currentGuestContainer.remove();
    mainGuest.extraGuests.splice(currentGuestIndex, 1);
    
    let currentForm = richForms.find(form => form.content == "extra_guests");
    currentForm.sideLabel.value = mainGuest.extraGuests.length;
}
