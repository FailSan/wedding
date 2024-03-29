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

let guestLoginForm = document.querySelector('#guest-login');
guestLoginForm.addEventListener('submit', guestLogin);

function guestLogin(event) {
    event.preventDefault();

    let guestName = guestLoginForm.elements['guest_name'].value;
    let guestSurname = guestLoginForm.elements['guest_surname'].value;
    let guestPassword = guestLoginForm.elements['guest_password'].value;
    let formToken = guestLoginForm.elements['_token'].value;

    let guestData = new FormData;
    guestData.append('name', guestName);
    guestData.append('surname', guestSurname);
    guestData.append('password', guestPassword);
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
    let dialogBox = document.querySelector('.error-dialog');
    dialogBox.innerHTML = "";

    if(serverResponse['error']) {
        dialogBox.classList.remove('hidden');
        
        for(let message in serverResponse['error']) {
            let messageBox = document.createElement('p');
            messageBox.textContent = serverResponse['error'][message];
            dialogBox.appendChild(messageBox);
        }
    } else {
        location.reload();
    }
    
}