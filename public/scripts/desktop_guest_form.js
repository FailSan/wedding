window.addEventListener('load', hideLoader);
function hideLoader() {
    let loaderDocument = document.querySelector('.modal-loading');
    setTimeout(function() {
        loaderDocument.classList.add('hidden');

        setTimeout(function() {
            loaderDocument.remove();
        }, 2000);
    }, 2000);
}

let mainGuest = {
    name: '',
    surname: '',
    church_confirm: '',
    castle_confirm: '',
    diet: '',
    allergies: '',
    extra_confirm: '',
    extra_guests: '',
    extraGuests: [],
};

import { RichForm } from './classes/richForm.js';
import { RichSection } from './classes/richSection.js';
import { RichLabel } from './classes/richLabel.js';

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

let sidePercentage = {
    element: document.querySelector('.percentage'),
    updateLength() {
        let sectionIndexProp = parseInt(document.documentElement.style.getPropertyValue('--section-index'));
        let formIndexProp = parseInt(document.documentElement.style.getPropertyValue('--form-index'));
        let sidePercentageProp = (formIndexProp+sectionIndexProp+1)*10;
        
        if(sidePercentageProp > 100 || sectionIndexProp == 2)
            sidePercentageProp = 100;
        if(sidePercentageProp < 10 || sectionIndexProp == 0)
            sidePercentageProp = 10;

        sidePercentage.element.style.setProperty("--percentage", sidePercentageProp + "%");
    }
};

function sectionSwipeUp() {
    let currentSection = richSections.find(section => section.selected);
    let currentIndex = richSections.indexOf(currentSection);

    if(currentIndex < (richSections.length - 1)) {
        if(currentIndex == 0) {
            navArrows.classList.remove('hidden');

            prevAction.classList.add('disabled');
            prevAction.removeEventListener('click', formSwipeDown);
        }

        if(currentIndex == 1) {
            navArrows.classList.add('hidden');
        }

        let newSection = richSections[currentIndex + 1];

        currentSection.selected = false;
        newSection.selected = true;

        document.documentElement.style.setProperty('--section-index', ++currentIndex);
        sidePercentage.updateLength();
    }
}

function sectionSwipeDown() {
    let currentSection = richSections.find(section => section.selected);
    let currentIndex = richSections.indexOf(currentSection);

    if(currentIndex > 0) {
        if(currentIndex == 1) {
            return;
        }

        if(currentIndex == (richSections.length - 1)) {
            navArrows.classList.remove('hidden');

            prevAction.removeEventListener('click', sectionSwipeDown);
            prevAction.addEventListener('click', formSwipeDown);
            nextAction.classList.remove('disabled');
            nextAction.addEventListener('click', inputControl);
        }

        let newSection = richSections[currentIndex - 1];

        currentSection.selected = false;
        newSection.selected = true;

        document.documentElement.style.setProperty('--section-index', --currentIndex);
        sidePercentage.updateLength();
    }
}

function formSwipeUp() {
    let enabledForms = richForms.filter(form => form.enabled);
    let currentForm = enabledForms.find(form => form.selected);

    let currentIndex = enabledForms.indexOf(currentForm);

    if(currentIndex < (enabledForms.length - 1)) {

        if(currentIndex == 0) {
            prevAction.classList.remove('disabled');
            prevAction.addEventListener('click', formSwipeDown);
        }

        let newForm = enabledForms[currentIndex + 1];

        currentForm.selected = false;
        newForm.selected = true;

        document.documentElement.style.setProperty('--form-index', ++currentIndex);
        sidePercentage.updateLength();
    } else {
        sectionSwipeUp();
        prevAction.removeEventListener('click', formSwipeDown);
        prevAction.addEventListener('click', sectionSwipeDown);

        nextAction.classList.add('disabled');
        nextAction.removeEventListener('click', inputControl);

        summaryUpdate();
    }
}

function formSwipeDown() {
    let enabledForms = richForms.filter(form => form.enabled);
    let currentForm = enabledForms.find(form => form.selected);

    let currentIndex = enabledForms.indexOf(currentForm);

    if(currentIndex > 0) {
        if(currentIndex == 1) {
            prevAction.classList.add('disabled');
            prevAction.removeEventListener('click', formSwipeDown);
        }
        let newForm = enabledForms[currentIndex - 1];

        currentForm.selected = false;
        newForm.selected = true;

        document.documentElement.style.setProperty('--form-index', --currentIndex);
        sidePercentage.updateLength();
    } else {
        sectionSwipeDown();
    }
}

let readyButton = document.querySelector('#ready');
readyButton.addEventListener('click', sectionSwipeUp);

let navArrows = document.querySelector('.arrows');
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

                mainGuest[currentContent] = currentValue;
                switch(currentValue) {
                    case '1':
                        if(currentContent != "extra_guests")
                            currentValue = 'Sì'
                        break;
                    case '0':
                        if(currentContent != "extra_guests")
                            currentValue = 'No'
                        break;
                    default:
                        break;
                }
                
                if(currentContent == 'castle_confirm') {

                    let dietForm = richForms.find(form => form.content == 'diet');
                    let allergiesForm = richForms.find(form => form.content == 'allergies');
                    let extraConfirmForm = richForms.find(form => form.content == 'extra_confirm');

                    if(currentValue == 'Sì') {
                        dietForm.enabled = true;
                        allergiesForm.enabled = true;
                        extraConfirmForm.enabled = true;
                    } else {
                        dietForm.enabled = false;
                        allergiesForm.enabled = false;
                        extraConfirmForm.enabled = false;

                        mainGuest['diet'] = '';
                        mainGuest['allergies'] = '';
                        mainGuest["extra_confirm"] = '';
                    }
                }
            
                if(currentContent == 'extra_confirm') {
                    let extraGuestsForm = richForms.find(form => form.content == 'extra_guests');

                    if(currentValue == 'Sì') {
                        extraGuestsForm.enabled = true;
                    } else {
                        extraGuestsForm.enabled = false;
                        mainGuest.extraGuests.splice(0, Infinity);
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

    let currentForm = richForms.find(form => form.content == 'extra_guests');
    let extraToken = currentForm.elements['_token'];
    let extraFieldset = currentForm.element.querySelector(".mini-form");
    let extraInputs = extraFieldset.elements;

    if(mainGuest.extraGuests.length >= 10) {
        let textError = 'Non puoi aggiungere più di 10 ospiti.';
        let errorList = {'guestsLength': [textError]};
        currentForm.showError(errorList);
    } else {
        let extraGuestData = new FormData();
        extraGuestData.append('_token', extraToken.value);
        Array.prototype.forEach.call(extraInputs, input => {
            if(input.type == "checkbox")
                extraGuestData.append(input.name, input.checked ? 1 : 0);
            else
                extraGuestData.append(input.name, input.value)
        });

        fetch('/guest/validate', {
            method: 'post',
            body: extraGuestData,
        })
            .then((servResponse) => servResponse.json())
            .then((jsonData) => onNewExtraValidation(jsonData))
            .catch((servError) => console.log(servError));
    }
}

function onNewExtraValidation(jsonData) {
    let currentForm = richForms.find(form => form.content == 'extra_guests');

    if(jsonData.error) {
        currentForm.showError(jsonData.error);
    } else {
        let extraGuest = {};
        for(let property in jsonData.success) {
            extraGuest[property] = jsonData.success[property];
        }
        mainGuest.extraGuests.push(extraGuest);

        currentForm.showValidate();
        currentForm.element.reset();

        createGuestLabel(extraGuest);
    }
}

function createGuestLabel(extraGuest) {
    let guestLabel = document.createElement('label');
    guestLabel.classList.add('extra-guest-label');
    guestLabel.dataset.guestIndex = mainGuest.extraGuests.indexOf(extraGuest);

    let fullName = document.createElement('p');
    fullName.textContent = extraGuest.name + " " + extraGuest.surname;
    fullName.addEventListener('click', toggleGuestDetails);

    let deleteGuestButton = document.createElement('p');
    deleteGuestButton.addEventListener('click', deleteExtraGuest);

    let hiddenInput = document.createElement('input');
    hiddenInput.type = 'radio';
    hiddenInput.name = 'extra_guest';
    hiddenInput.value = extraGuest.name + ' ' + extraGuest.surname;

    guestLabel.appendChild(fullName);
    guestLabel.appendChild(deleteGuestButton);
    guestLabel.appendChild(hiddenInput);

    let extraGuestsContainer = document.querySelector('.extra-guests-container');
    extraGuestsContainer.appendChild(guestLabel);
}

function toggleGuestDetails(event) {
    event.preventDefault();

    let currentLabel = event.currentTarget.parentElement;
    let currentRadio = currentLabel.querySelector('input');
    let currentForm = richForms.find(form => form.content == 'extra_guests');

    if(currentRadio.checked) {
        currentRadio.checked = false;
        currentForm.element.reset();

        addExtraButton.firstElementChild.textContent = 'Aggiungi Ospite';
        addExtraButton.classList.remove('edit-mode');
        addExtraButton.removeEventListener('click', editExtraGuest);
        addExtraButton.addEventListener('click', addExtraGuest);
    }
    
    else {
        currentRadio.checked = true;

        let currentGuest = mainGuest.extraGuests[currentLabel.dataset.guestIndex];
        let extraFieldset = currentForm.element.querySelector('.mini-form');
        let extraInputs = extraFieldset.elements;
        Array.prototype.forEach.call(extraInputs, input => {
            if(input.type == "checkbox")
                input.checked = currentGuest[input.name] == 0 ? false : true;
            else
                input.value = currentGuest[input.name]
        });

        addExtraButton.firstElementChild.textContent = 'Modifica Ospite';
        addExtraButton.classList.add('edit-mode');
        addExtraButton.removeEventListener('click', addExtraGuest);
        addExtraButton.addEventListener('click', editExtraGuest);
    }
}

function editExtraGuest(event) {
    event.preventDefault();

    let currentForm = richForms.find(form => form.content == 'extra_guests');
    let extraFieldset = currentForm.element.querySelector('.mini-form');
    let extraToken = currentForm.elements['_token'];
    let extraInputs = extraFieldset.elements;

    let extraGuestData = new FormData();
    extraGuestData.append('_token', extraToken.value);
    Array.prototype.forEach.call(extraInputs, input => {
        if(input.type == "checkbox")
            extraGuestData.append(input.name, input.checked ? 1 : 0);
        else
            extraGuestData.append(input.name, input.value)
    });

    fetch('/guest/validate', {
        method: 'post',
        body: extraGuestData,
    })
        .then((servResponse) => servResponse.json())
        .then((jsonData) => onEditExtraValidation(jsonData))
        .catch((servError) => console.log(servError));
}

function onEditExtraValidation(jsonData) {
    let currentForm = richForms.find(form => form.content == 'extra_guests');
    let extraFieldset = currentForm.element.querySelector('.mini-form');
    let currentLabel = currentForm.element.querySelector('.extra-guest-label:has(input[type="radio"]:checked)');
    let currentGuest = mainGuest.extraGuests[currentLabel.dataset.guestIndex];

    if(jsonData.error) {
        let extraInputs = extraFieldset.elements;
        Array.prototype.forEach.call(extraInputs, input => {
            if(input.type == "checkbox")
                input.checked = currentGuest[input.name];
            else
                input.value = currentGuest[input.name];
        });
        jsonData.error.editGuest = ['Sono stati caricati i dati precedentemente validati.'];
        currentForm.showError(jsonData.error);

    } else {
        for(let property in jsonData.success) {
            currentGuest[property] = jsonData.success[property]
        }
        currentLabel.firstElementChild.textContent = currentGuest.name + ' ' + currentGuest.surname;
        
        jsonData.success.guestsLength = mainGuest.extraGuests.length;
        currentForm.showValidate();
        currentForm.element.reset();

        addExtraButton.firstElementChild.textContent = 'Aggiungi Ospite';
        addExtraButton.classList.remove('edit-mode');
        addExtraButton.removeEventListener('click', editExtraGuest);
        addExtraButton.addEventListener('click', addExtraGuest);
    }
}

function deleteExtraGuest(event) {
    event.preventDefault();

    let currentForm = richForms.find(form => form.content == 'extra_guests');

    let currentLabel = event.currentTarget.parentElement;
    let currentRadio = currentLabel.querySelector('input');
    let currentGuestIndex = currentLabel.dataset.guestIndex;

    if(currentRadio.checked) {
        currentRadio.checked = false;
        currentForm.element.reset();

        addExtraButton.firstElementChild.textContent = 'Aggiungi Ospite';
        addExtraButton.classList.remove('edit-mode');
        addExtraButton.removeEventListener('click', editExtraGuest);
        addExtraButton.addEventListener('click', addExtraGuest);
    }
    
    currentLabel.remove();
    mainGuest.extraGuests.splice(currentGuestIndex, 1);
    let guestLabels = currentForm.element.querySelectorAll('[data-guest-index]');
    for(let i = 0; i < guestLabels.length; i++) {
        guestLabels[i].dataset.guestIndex = i;
    }
}

function summaryUpdate() {
    let summarySection = richSections[richSections.length - 1];
    let summaryContainer = summarySection.element.querySelector('.summary-container');

    for(let property in mainGuest) {
        let propertyValue = summaryContainer.querySelector('[data-content="' + property + '"] .value');

        switch(property) {
            case 'church_confirm':
            case 'castle_confirm':
                propertyValue.textContent = (mainGuest[property] == '1') ? 'Sì' : 'No';
                break;
            case 'diet':
            case 'allergies':
                propertyValue.textContent = mainGuest[property] ? mainGuest[property] : "nessuna";
                break;
            case 'extra_confirm':
                let fullNameCollections = "";
                if(mainGuest["extra_guests"] > 0) {
                    mainGuest.extraGuests.forEach(guest => {
                        fullNameCollections += guest.name + " " + guest.surname;
                        if(mainGuest["extraGuests"].indexOf(guest) != (mainGuest["extraGuests"].length - 1))
                            fullNameCollections += " ,";
                    });
                }
                if(fullNameCollections) {
                    propertyValue.textContent = mainGuest["extra_guests"] + " (" + fullNameCollections + ")";
                } else {
                    propertyValue.textContent = "Nessuno";
                }
                break;
            case 'extra_guests':
                break;
            case 'extraGuests':
                break;
            default:
                propertyValue.textContent = mainGuest[property];
        }
    }
}

let confirmButton = document.querySelector('.form-summary .input-button');
confirmButton.addEventListener('click', updateGuest);

function updateGuest(event) {
    event.preventDefault();

    let currentToken = event.currentTarget.querySelector('input[name="_token"]').value;
    let guestData = new FormData();
    guestData.append('_token', currentToken);
    guestData.append('guest', JSON.stringify(mainGuest));

    fetch('/guest/multivalidate', {
        method: 'post',
        body: guestData,
    })
        .then((servResponse) => servResponse.json())
        .then((jsonData) => onGuestUpdate(jsonData))
        .catch((servError) => console.log(servError));
}

function onGuestUpdate(jsonData) {
    if(jsonData.error) {
        location.reload();
    }

    else {
        location.href="/guest/thanks";
    }
}

let modifyButton = document.querySelector('.form-summary .action-button');
modifyButton.addEventListener('click', backToForm);

function backToForm(event) {
    event.preventDefault();

    let formIndex = document.documentElement.style.getPropertyValue('--form-index');
    sectionSwipeDown();

    do {
        formSwipeDown();
        --formIndex;
    }
    while(formIndex != 0)
}