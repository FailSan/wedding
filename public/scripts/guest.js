//AJAX Functions
function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

let buttons = document.querySelectorAll('button');
for(let i = 0; i < buttons.length; i++) {
    if(buttons[i]) {
        buttons[i].addEventListener('click', guestConfirm);
    }
}

function guestConfirm(event) {
    event.preventDefault();

    let currentButton = event.currentTarget;
    let currentValue = currentButton.value;

    let dialogBox = document.querySelector('.dialogs');
    dialogBox.innerHTML = '';

    if(currentValue == true) {
        let dialogData = {
            'success': ['Bene. Attendi mentre ti reindirizziamo alla tua Area Personale'] 
        }
        dialogShow(dialogData, true);
        setTimeout(function() {
            location.href = location.href + '/confirm';
        }, 3000);
    } else {
        let dialogData = {
            'error': ['Oops! Rivolgiti agli Sposi per avere il giusto link di accesso!'],
        };
        dialogShow(dialogData, false);
    }
}

function dialogShow(dialogData, successFlag) {
    let dialogBox = document.querySelector('.dialogs');
    dialogBox.innerHTML = '';

    for(let message in dialogData) {
        let messageBox = document.createElement('span');
        messageBox.textContent = dialogData[message];

        if(successFlag) 
            messageBox.classList.add('success');
        else
            messageBox.classList.add('error');

        dialogBox.appendChild(messageBox);
    }
}

let updateForm = document.querySelector('#update_form');
if(updateForm != undefined) {
    updateForm.addEventListener('submit', guestUpdate);
    for(let i = 0; i < updateForm.elements.length; i++) {
        if(updateForm.elements[i].nodeName.toLowerCase() == 'fieldset')
            continue;
        
        updateForm.elements[i].addEventListener('input', validateInput);
    }
}

function validateInput(event) {
    event.preventDefault();

    let currentInput = event.currentTarget;
    let currentName = currentInput.name;
    let currentValue = currentInput.value;
    if(currentName == 'confirmed') {
        currentValue = currentInput.checked ? 1 : 0;
    }

    let formToken = updateForm.elements['_token'].value;

    let inputData = new FormData;
    inputData.append(currentName, currentValue);
    inputData.append('_token', formToken);

    fetch('/guest/validate', {
        method: 'post',
        body: inputData,
    }).then(onResponse, onError).then(onValidateInput);
}

function onValidateInput(serverResponse) {
    if(serverResponse['error']) {
        for(let inputName in serverResponse['error']) {
            let flagCell = document.querySelector('[data-input="' + inputName + '"]');
            flagCell.classList.remove('success');
            flagCell.classList.add('error');
            flagCell.textContent = "Errore";
        }
    } else {
        for(let inputName in serverResponse['success']) {
            let flagCell = document.querySelector('[data-input="' + inputName + '"]');
            flagCell.classList.remove('error');
            flagCell.classList.add('success');
            flagCell.textContent = "Ok";
        }
    }
}

function guestUpdate(event) {
    event.preventDefault();

    let guestName = updateForm.elements['name'].value;
    let guestSurname = updateForm.elements['surname'].value;
    let guestDiet = updateForm.elements['diet'].value;
    let guestAllergies = updateForm.elements['allergies'].value;
    let guestConfirmed = updateForm.elements['confirmed'].checked ? 1 : 0;

    let formToken = updateForm.elements['_token'].value;

    let guestData = new FormData;
    guestData.append('name', guestName);
    guestData.append('surname', guestSurname);
    guestData.append('diet', guestDiet);
    guestData.append('allergies', guestAllergies);
    guestData.append('confirmed', guestConfirmed);
    guestData.append('_token', formToken);

    fetch('/guest/update', {
        method: 'post',
        body: guestData,
    }).then(onResponse, onError).then(onGuestUpdate);
}

function onGuestUpdate(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error'], false);
    } else {
        dialogShow(serverResponse['success'], true);
    }
}

let guestForm = document.querySelector('#guest_form');
if(guestForm != undefined) {
    guestForm.addEventListener('submit', guestCreation);
}

function guestCreation(event) {
    event.preventDefault();

    let guestName = guestForm.elements['name'].value;
    let guestSurname = guestForm.elements['surname'].value;
    let guestDiet = guestForm.elements['diet'].value;
    let guestAllergies = guestForm.elements['allergies'].value;
    let guestConfirmed = guestForm.elements['confirmed'].checked ? 1 : 0;
    
    let formToken = guestForm.elements['_token'].value;

    let guestData = new FormData;
    guestData.append('name', guestName);
    guestData.append('surname', guestSurname);
    guestData.append('diet', guestDiet);
    guestData.append('allergies', guestAllergies);
    guestData.append('confirmed', guestConfirmed);

    guestData.append('_token', formToken);

    fetch('/guest/create', {
        method: 'post',
        body: guestData,
    }).then(onResponse, onError).then(onGuestCreation);

}

function onGuestCreation(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error'], false);
    } else {
        dialogShow(serverResponse['success'], true);

        //Clean Form
        guestForm.elements['name'].value = "";
        guestForm.elements['surname'].value = "";
        guestForm.elements['diet'].value = "";
        guestForm.elements['allergies'].value = "";
        guestForm.elements['confirmed'].checked = false;
    }
}