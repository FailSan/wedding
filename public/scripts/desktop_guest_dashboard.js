let basicForm = document.querySelector('#guestBasic');
let foodForm = document.querySelector('#guestFood');
let presenceForm = document.querySelector('#guestPresence');

basicForm.addEventListener('submit', updateGuest);
foodForm.addEventListener('submit', updateGuest);
presenceForm.addEventListener('submit', updateGuest);

function updateGuest(event) {
    event.preventDefault();

    let currentForm = event.currentTarget;
    let formElements = currentForm.elements;

    let guestData = new FormData;

    for(let i = 0; i < formElements.length; i++) {
        let inputName = formElements[i].name;
        let inputValue = formElements[i].value;

        if(inputName == 'church_confirmed' || inputName == 'castle_confirmed') {
            inputValue = formElements[inputName].value == 'true' ? 1 : 0;
        }

        guestData.append(inputName, inputValue);
    }

    let currentSection = currentForm.parentElement;
    loadingAnimation(currentSection);

    let currentData = currentSection.dataset.form
    guestData.append('form', currentData);

    fetch('/guest/partialUpdate', {
        method: 'post',
        body: guestData,
    }).then(onResponse, onError).then(onGuestUpdate);
}

function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

function loadingAnimation(currentSection) {
    let currentStatus = currentSection.querySelector('.formStatus');
    currentStatus.classList.remove('hidden');

    let currentImg = currentStatus.querySelector('img');
    currentImg.classList.add('loading');
}

function onGuestUpdate(jsonData) {
    console.log(jsonData);

    let formName = jsonData['form'];
    let currentSection = document.querySelector('[data-form="' + formName + '"]');
    let currentStatus = currentSection.querySelector('.formStatus');
    let currentDialog = currentSection.querySelector('.dialog');

    let message = currentStatus.querySelector('p');
    let image = currentStatus.querySelector('img');

    if(jsonData['success']) {
        message.classList.add('success');
        message.textContent = 'Aggiornato!';
        
        image.classList.remove('loading');
        image.src = image.src.replace('loading', 'ok');
        
        setTimeout(function() {
            currentStatus.classList.add('hidden');

            message.classList.remove('success');
            message.textContent = '';
            image.src = image.src.replace('ok', 'loading');
        }, 3000);
    }

    if(jsonData['error']) {
        message.classList.add('error');
        message.textContent = 'Errore!';
        
        image.classList.remove('loading');
        image.src = image.src.replace('loading', 'warning');

        currentDialog.innerHTML = "";
        currentDialog.classList.remove('hidden');
        currentDialog.classList.add('error');

        for(let input in jsonData['error']) {
            let messageBox = document.createElement('p');
            messageBox.textContent = jsonData['error'][input];
            
            currentDialog.appendChild(messageBox);
        }

        setTimeout(function() {
            currentStatus.classList.add('hidden');
            
            currentDialog.classList.add('hidden');
            currentDialog.innerHTML = "";

            message.classList.remove('error');
            message.textContent = '';
            image.src = image.src.replace('warning', 'loading');
        }, 3000);
    }
}