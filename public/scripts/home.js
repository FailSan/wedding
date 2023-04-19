//AJAX Functions
function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

let loginForm = document.querySelector('#login_form');
if(loginForm) {
    loginForm.addEventListener('submit', userLogin);
}

function userLogin(event) {
    event.preventDefault();

    let userEmail = loginForm.elements['email'].value;
    let userPassword = loginForm.elements['password'].value;
    let userRemember = loginForm.elements['remember'].checked ? 1 : 0;

    let formToken = loginForm.elements['_token'].value;

    let userData = new FormData;
    userData.append('email', userEmail);
    userData.append('password', userPassword);
    userData.append('remember', userRemember);
    userData.append('_token', formToken);

    fetch('/user/login', {
        method: 'post',
        body: userData,
    }).then(onResponse, onError).then(onUserLogin);
}

function onUserLogin(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error'], false);
    } else {
        dialogShow(serverResponse['success'], true);
        setTimeout(function() {
            location.href = "/user/administration";
        }, 2000);
    }
}

let signupForm = document.querySelector('#signup_form');
if(signupForm) {
    signupForm.addEventListener('submit', userSignup);
}

function userSignup(event) {
    event.preventDefault();

    let userName = signupForm.elements['name'].value;
    let userSurname = signupForm.elements['surname'].value;
    let userEmail = signupForm.elements['email'].value;
    let userPassword = signupForm.elements['password'].value;
    let userPasswordConfirm = signupForm.elements['password_confirmation'].value;
    
    let formToken = signupForm.elements['_token'].value;

    let userData = new FormData;
    userData.append('name', userName);
    userData.append('surname', userSurname);
    userData.append('email', userEmail);
    userData.append('password', userPassword);
    userData.append('password_confirmation', userPasswordConfirm );
    userData.append('_token', formToken);

    fetch('/user/create', {
        method: 'post',
        body: userData,
    }).then(onResponse, onError).then(onUserSignup);
}

function onUserSignup(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error'], false);
    } else {
        dialogShow(serverResponse['success'], true);
        setTimeout(function() {
            location.href = '/user/login';
        }, 2000);
    }
}

function dialogShow(dialogData, successFlag) {
    console.log(dialogData);

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