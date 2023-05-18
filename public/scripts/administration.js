//AJAX Functions
function onResponse(response) {
    let jsonData = response.json();

    return jsonData;
}

function onError(error) {
    console.log(error)
}

//Guest Creation
let guestForm = document.querySelector('#guest_form');
guestForm.addEventListener('submit', guestCreation);

function guestCreation(event) {
    event.preventDefault();

    let guestName = guestForm.elements['name'].value;
    let guestSurname = guestForm.elements['surname'].value;
    let guestDiet = guestForm.elements['diet'].value;
    let guestAllergies = guestForm.elements['allergies'].value;
    let guestChurchConfirm = guestForm.elements['church_confirm'].checked ? 1 : 0;
    let guestCastleConfirm = guestForm.elements['castle_confirm'].checked ? 1 : 0;
    let guestChildMenu = guestForm.elements['child_menu'].checked ? 1 : 0;
    let guestUpdated = guestForm.elements['updated'].checked ? 1 : 0;

    let formToken = guestForm.elements['_token'].value;

    let guestData = new FormData;
    guestData.append('name', guestName);
    guestData.append('surname', guestSurname);
    guestData.append('diet', guestDiet);
    guestData.append('allergies', guestAllergies);
    guestData.append('church_confirm', guestChurchConfirm);
    guestData.append('castle_confirm', guestCastleConfirm);
    guestData.append('child_menu', guestChildMenu);
    guestData.append('updated', guestUpdated);
    guestData.append('_token', formToken);

    fetch('/guest/create', {
        method: 'post',
        body: guestData,
    }).then(onResponse, onError).then(onGuestCreation);

}

function onGuestCreation(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error']);
    } else {
        dialogShow(serverResponse['success']);

        //Clean Form
       guestForm.reset();

        //Retrieve Data and Populate Table
        retrieveData().then((guestData) => createTable(guestData));
    }
}

function dialogShow(dialogData) {
    let dialogBox = document.querySelector('.error-dialog');
    dialogBox.classList.remove('hidden');
    dialogBox.innerHTML = '';

    for(let message in dialogData) {
        let messageBox = document.createElement('p');
        messageBox.textContent = dialogData[message];

        dialogBox.appendChild(messageBox);
    }
}

//Retrieve Guests Data
async function retrieveData() {

    let guestData = await fetch('/guest/data', {
        method: 'get',
    }).then(onResponse, onError).then((serverData) => {
        return serverData;
    });

    return guestData;
}


let searchForm = document.querySelector('#search_form');
searchForm.elements['search_string'].addEventListener('input', filterData);
searchForm.elements['veg_flag'].addEventListener('change', filterData);
searchForm.elements['church_flag'].addEventListener('change', filterData);
searchForm.elements['castle_flag'].addEventListener('change', filterData);
searchForm.elements['child_flag'].addEventListener('change', filterData);
searchForm.elements['updated_flag'].addEventListener('change', filterData);
searchForm.addEventListener('submit', filterData);

//Filter and Sort Data
function filterData(event) {
    if(event)
        event.preventDefault();
    
    let searchString = searchForm.elements['search_string'].value.toLowerCase();
    let vegFlag = searchForm.elements['veg_flag'].checked;
    let churchFlag = searchForm.elements['church_flag'].checked;
    let castleFlag = searchForm.elements['castle_flag'].checked;
    let childFlag = searchForm.elements['child_flag'].checked;
    let updatedFlag = searchForm.elements['updated_flag'].checked;

    let currentHead = document.querySelector('th:not([data-order="none"])');
    let currentSort = currentHead.dataset.sort.toLowerCase();
    let currentOrder = currentHead.dataset.order.toLowerCase();

    retrieveData().then((serverData) => {
        switch(currentSort) {
            case 'id':
                serverData.sort((first, second) => {
                    if(first.id < second.id) {
                        return -1;
                    }
                    if(first.id > second.id) {
                        return 1;
                    }
                    return 0;
                });
                break;
            case 'name':
                serverData.sort((first, second) => {
                    if(first.name === second.name) {
                        if(first.surname < second.surname)
                            return -1;
                        if(first.surname > second.surname)
                            return 1;
                        return 0;
                    }
                    if(first.name < second.name) {
                        return -1;
                    }
                    if(first.name > second.name) {
                        return 1;
                    }
                });
                break;
            case 'surname':
                serverData.sort((first, second) => {
                    if(first.surname === second.surname) {
                        if(first.name < second.name)
                            return -1;
                        if(first.name > second.name)
                            return 1;
                        return 0;
                    }
                    if(first.surname < second.surname) {
                        return -1;
                    }
                    if(first.surname > second.surname) {
                        return 1;
                    }
                });
                break;
            case 'updated':
            case 'church_confirm':
            case 'castle_confirm':
            case 'child_menu':
                serverData.sort((first, second) => {
                    if(first[currentSort] === second[currentSort]) {
                        if(first.id < second.id)
                            return -1;
                        if(first.id > second.id)
                            return 1;
                        return 0;
                    }
                    return second[currentSort] - first[currentSort];
                });
                break;
            case 'host':
                serverData.sort((first, second) => {

                    if(!first.host) {
                        if(!second.host)
                            return 0;
                        return -1;
                    }
                    if(!second.host) {
                        return 1;
                    }

                    if(first.host.surname === second.host.surname) {
                        if(first.host.name < second.host.name)
                            return -1;
                        if(first.host.name > second.host.name)
                            return 1;
                        return 0;
                    }
                    if(first.host.surname < second.host.surname)
                        return -1;
                    if(first.host.surname > second.host.surname)
                        return 1;
                });
                break;
            default:
                serverData.sort((first, second) => {
                    if(first[currentSort] === second[currentSort]) {
                        if(first.id < second.id)
                            return -1;
                        if(first.id > second.id)
                            return 1;
                        return 0;
                    }
                    if(first[currentSort] < second[currentSort])
                        return -1;
                    if(first[currentSort] > second[currentSort])
                        return 1;
                });
                break;
        }

        if(currentOrder == "desc") {
            serverData.reverse();
        }

        let filteredData = serverData.filter((guest) => {
            if(guest.name.toLowerCase().includes(searchString) || guest.surname.toLowerCase().includes(searchString))
                return true;
        });

        if(vegFlag) {
            filteredData = filteredData.filter((guest) => {
                if(guest.diet.toLowerCase().includes('veg'))
                    return true;
            });
        }

        if(churchFlag) {
            filteredData = filteredData.filter((guest) => {
                if(guest.church_confirm)
                    return true;
            });
        }

        if(castleFlag) {
            filteredData = filteredData.filter((guest) => {
                if(guest.castle_confirm)
                    return true;
            });
        }

        if(childFlag) {
            filteredData = filteredData.filter((guest) => {
                if(guest.child_menu)
                    return true;
            });
        }
        
        if(updatedFlag) {
            filteredData = filteredData.filter((guest) => {
                if(guest.updated)
                    return true;
            });
        }

        createTable(filteredData);
    });
}

//Sort by Table Headings
let tableHeads = document.querySelectorAll('th');
for(let i = 0; i < tableHeads.length; i++) {
    tableHeads[i].addEventListener('click', sortTable);
}
function sortTable(event) {
    event.preventDefault();
    
    let currentHead = document.querySelector('th:not([data-order="none"])');
    let newHead = event.currentTarget;

    if(currentHead != newHead) {
        currentHead.dataset.order = "none";
        newHead.dataset.order = "asc";
    } else {
        currentHead.dataset.order = (currentHead.dataset.order == "asc") ? "desc" : "asc";
    }

    filterData();
}

//Populate Table
function createTable(guestData) {
    let mainTable = document.querySelector('#guest_table');

    let mainCounter = mainTable.querySelector('.guest-counter');
    mainCounter.textContent = 'Invitati Trovati: ' + guestData.length;

    let mainBody = mainTable.querySelector('tbody');
    mainBody.innerHTML = "";

    for(let i = 0; i < guestData.length; i++) {
        let guestRow = document.createElement('tr');
        mainBody.appendChild(guestRow);

        let id_cell = document.createElement('td');
        id_cell.textContent = guestData[i]['id'];
        guestRow.appendChild(id_cell);

        let name_cell = document.createElement('td');
        name_cell.textContent = guestData[i]['name'];
        guestRow.appendChild(name_cell);

        let surname_cell = document.createElement('td');
        surname_cell.textContent = guestData[i]['surname'];
        guestRow.appendChild(surname_cell);

        let allergy_cell = document.createElement('td');
        allergy_cell.textContent = guestData[i]['diet'];
        guestRow.appendChild(allergy_cell);

        let diet_cell = document.createElement('td');
        diet_cell.textContent = guestData[i]['allergies'];
        guestRow.appendChild(diet_cell);

        let church_confirm_cell = document.createElement('td');
        if(guestData[i]['church_confirm'])
            church_confirm_cell.textContent = 'Sì';
        else
            church_confirm_cell.textContent = 'No';
        guestRow.appendChild(church_confirm_cell);

        let castle_confirm_cell = document.createElement('td');
        if(guestData[i]['castle_confirm'])
            castle_confirm_cell.textContent = 'Sì';
        else
            castle_confirm_cell.textContent = 'No';
        guestRow.appendChild(castle_confirm_cell);

        let child_menu_cell = document.createElement('td');
        if(guestData[i]['child_menu'])
            child_menu_cell.textContent = 'Sì';
        else
            child_menu_cell.textContent = 'No';
        guestRow.appendChild(child_menu_cell);

        let updated_cell = document.createElement('td');
        if(guestData[i]['updated'])
            updated_cell.textContent = 'Sì';
        else
            updated_cell.textContent = 'No';
        guestRow.appendChild(updated_cell);

        let password_cell = document.createElement('td');
        password_cell.textContent = guestData[i]['password'];
        guestRow.appendChild(password_cell);

        let host_cell = document.createElement('td');
        if(guestData[i]['host'])
            host_cell.textContent = guestData[i]['host'].name + ' ' + guestData[i]['host'].surname;
        else
            host_cell.textContent = 'Aurelio e Chiara';
        guestRow.appendChild(host_cell);

        let delete_cell = document.createElement('td');
        delete_cell.dataset.link = 'delete';
        let delete_link = document.createElement('a');
        delete_link.textContent = "Cancella";
        delete_link.href = '/guest/delete/' + guestData[i]['id'];
        delete_link.addEventListener('click', guestDelete);
        delete_cell.appendChild(delete_link);
        guestRow.appendChild(delete_cell);

    }
}

let guestDeletes = document.querySelectorAll('[data-link="delete"] a');
for(let i = 0; i < guestDeletes.length; i++) {
    guestDeletes[i].addEventListener('click', guestDelete);
}

function guestDelete(event) {
    event.preventDefault();

    let link = event.currentTarget.href;

    fetch(link, {
        method: 'get',
    }).then(onResponse, onError).then(onGuestDelete);
}

function onGuestDelete(serverResponse) {
    if(serverResponse['error']) {
        dialogShow(serverResponse['error']);
    } else {
        //Retrieve Data and Populate Table
        retrieveData().then((guestData) => createTable(guestData));
    }
}