//AJAX Functions
function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

let updateForm = document.querySelector('#update_form');
updateForm.addEventListener('submit', function(event) {
    event.preventDefault();
});

let fieldSets = updateForm.querySelectorAll('fieldset');
for(let i = 0; i < fieldSets.length; i++) {
    let fieldElements = fieldSets[i].elements;

    for(let j = 0; j < fieldElements.length; j++) {
        fieldElements[j].addEventListener('input', validateInput);
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

    checkSubmits();
}

function checkSubmits() {
    for(let i = 0; i < fieldSets.length; i++) {
        let fieldFlags = fieldSets[i].querySelectorAll('[data-input]');
        let fieldSubmit = fieldSets[i].querySelector('[data-field]');
        
        let flags = fieldFlags.length;
        for(let j = 0; j < fieldFlags.length; j++) {
            if(fieldFlags[j].classList.contains('success')) {
                flags--;
            }
        }
        
        if(!flags)
            fieldSubmit.disabled = false;
    }
}

let submits = document.querySelectorAll('[data-field]');
for(let i = 0; i < submits.length; i++) {
    submits[i].addEventListener('click', submitFieldset);
}
function submitFieldset(event) {
    event.preventDefault();

    console.log(event.currentTarget);
}