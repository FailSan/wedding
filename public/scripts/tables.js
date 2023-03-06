//AJAX Functions
function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

let tableForm = document.querySelector('#table_form');
tableForm.addEventListener('submit', tableCreation);

function tableCreation(event) {
    event.preventDefault();

    let tableDescription = tableForm.elements['description'].value;

    let formToken = tableForm.elements['_token'].value;

    let tableData = new FormData;
    tableData.append('description', tableDescription);
    tableData.append('_token', formToken);

    fetch('/table/create', {
        method: 'post',
        body: tableData,
    }).then(onResponse, onError).then(onTableCreation);
}

function onTableCreation(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error'], false);
    } else {
        dialogShow(serverResponse['success'], true);

        //Clean Form
        tableForm.elements['description'].value = "";

        retrieveData().then((tableData) => createTable(tableData));
    }
}

//Retrieve Guests Data
async function retrieveData() {

    let tableData = await fetch('/table/data', {
        method: 'get',
    }).then(onResponse, onError).then((serverData) => {
        return serverData;
    });

    return tableData;
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

let tableDeletes = document.querySelectorAll('[data-link="delete"] a');
for(let i = 0; i < tableDeletes.length; i++) {
    tableDeletes[i].addEventListener('click', tableDelete);
}

function tableDelete(event) {
    event.preventDefault();

    let link = event.currentTarget.href;

    fetch(link, {
        method: 'get',
    }).then(onResponse, onError).then(onTableDelete);
}

function onTableDelete(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error'], false);
    } else {
        dialogShow(serverResponse['success'], true);

        //Retrieve Data and Populate Table
        retrieveData().then((tableData) => createTable(tableData));
    }
}

//Populate Table
function createTable(tableData) {
    let mainTable = document.querySelector('#table_table');
    let mainBody = mainTable.querySelector('tbody');
    mainBody.innerHTML = "";

    for(let i = 0; i < tableData.length; i++) {
        let guestRow = document.createElement('tr');
        mainBody.appendChild(guestRow);

        let id_cell = document.createElement('td');
        id_cell.textContent = tableData[i]['id'];
        guestRow.appendChild(id_cell);

        let description_cell = document.createElement('td');
        description_cell.textContent = tableData[i]['description'];
        guestRow.appendChild(description_cell);

        let delete_cell = document.createElement('td');
        delete_cell.dataset.link = 'delete';
        let delete_link = document.createElement('a');
        delete_link.textContent = "Cancella";
        delete_link.href = '/table/delete/' + tableData[i]['id'];
        delete_link.addEventListener('click', tableDelete);
        delete_cell.appendChild(delete_link);
        guestRow.appendChild(delete_cell);
    }
}