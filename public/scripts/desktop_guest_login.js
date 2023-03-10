let guestLoginForm = document.querySelector('#guestLogin');
guestLoginForm.addEventListener('submit', guestLogin);

function guestLogin(event) {
    event.preventDefault();

    let guestName = guestLoginForm.elements['guest_name'].value;
    let guestSurname = guestLoginForm.elements['guest_surname'].value;
    let formToken = guestLoginForm.elements['_token'].value;

    let guestData = new FormData;
    guestData.append('name', guestName);
    guestData.append('surname', guestSurname);
    guestData.append('_token', formToken);

    fetch('/guest/search', {
        method: 'post',
        body: guestData,
    }).then(onResponse, onError).then(onGuestLogin);
}

//AJAX Functions
function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

function onGuestLogin(serverResponse) {
    let dialogBox = document.querySelector('.dialog');
    dialogBox.innerHTML = "";

    if(serverResponse['error']) {
        for(let message in serverResponse['error']) {
            let messageBox = document.createElement('span');
            messageBox.textContent = serverResponse['error'][message];
            messageBox.classList.add('error');
            dialogBox.appendChild(messageBox);
        }
    } else {
        for(let message in serverResponse['success']) {
            let messageBox = document.createElement('span');
            messageBox.textContent = serverResponse['success'][message];
            messageBox.classList.add('success');
            dialogBox.appendChild(messageBox);
        }
        setTimeout(function() {
            location.reload();
        }, 2000);
    }
    
}