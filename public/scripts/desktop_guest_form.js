let prevAction = document.querySelector('[data-action="prev"]');
prevAction.addEventListener('click', swipeDown);

let nextAction = document.querySelector('[data-action="next"]');
nextAction.addEventListener('click', swipeUp);

let forms = document.querySelectorAll('[data-selected]');


function swipeDown(event) {
    event.preventDefault();

    let currentForm = document.querySelector('[data-selected="1"]');
    let indexForm = Array.prototype.indexOf.call(forms, currentForm);

    if(indexForm > 0) {
        let newForm = forms[indexForm - 1];

        currentForm.dataset.selected = 0;
        currentForm.className = "";
        currentForm.classList.add('swipeDown', 'hidden');

        newForm.dataset.selected = 1;
        newForm.classList.remove('hidden');
        newForm.classList.add('swipeDown');
    }
}

function swipeUp(event) {
    event.preventDefault();

    let currentForm = document.querySelector('[data-selected="1"]');
    let indexForm = Array.prototype.indexOf.call(forms, currentForm);

    if(indexForm < (forms.length - 1)) {
        let newForm = forms[indexForm + 1];

        currentForm.dataset.selected = 0;
        currentForm.className = "";
        currentForm.classList.add('swipeUp', 'hidden');

        newForm.dataset.selected = 1;
        newForm.classList.remove('hidden');
        newForm.classList.add('swipeUp');
    }
}