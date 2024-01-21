export class AjaxTable {
    #targetContainer;
    #targetTable;
    #targetBody;
    #targetObject;
    #targetForm;
    #pageIndexSelector;
    #pageSizeSelector;
    #pageTotal;
    #pageIndex;
    #pageSize;

    constructor(targetContainer, targetPageIndexSelector, targetPageSizeSelector) {
        this.#targetContainer = targetContainer;
        this.#targetTable = this.#targetContainer.querySelector("table");
        this.#targetBody = this.#targetTable.querySelector("tbody");

        this.#pageIndexSelector = targetPageIndexSelector;
        this.#pageSizeSelector = targetPageSizeSelector;
    }

    set targetObject(jsonData) {
        this.#targetObject = jsonData;
        this.Update();
    }

    get currentPagination() {
        let pagination = {
            pageTotal: this.#pageTotal,
            pageIndex: this.#pageIndex,
            pageSize: this.#pageSize,
        };

        return pagination;
    }

    set targetPagination(value) {
        this.#pageTotal = value.pageTotal;
        this.#pageIndex = value.pageIndex;
        this.#pageSize = value.pageSize;

        this.UpdatePagination();
    }

    set targetForm(value) {
        this.#targetForm = value;

        this.#pageSizeSelector.addEventListener('change', () => {
            this.#pageSize = this.#pageSizeSelector.value;
            this.#targetForm.Search(this.#pageIndex);
        });
    }

    Update() {
        this.#targetBody.innerHTML = "";
        
        //Pagination Update
        this.targetPagination = {
            pageTotal: this.#targetObject.pageTotal,
            pageIndex: this.#targetObject.pageIndex,
            pageSize: this.#targetObject.pageSize,
        };

        //Table Update
        var results = this.#targetObject.results;
        if (results.length == 0) {
            this.AddEmptyRow()
        }
        
        else {
            for(let row in results) {
                this.AddRow(results[row]);
            }
        }
    }

    AddEmptyRow() {
        var targetRow = document.createElement('tr');
        
        var targetCell = document.createElement('td');
        targetCell.classList.add('w-100', 'text-center');
        targetCell.colSpan = 4;
        targetCell.textContent = "Nessun elemento nella collezione.";

        targetRow.appendChild(targetCell);
        this.#targetBody.appendChild(targetRow);
    }

    AddRow(rowData) {
        var targetRow = document.createElement('tr');

        var targetIdCell = document.createElement('th');
        targetIdCell.scope = "row";
        targetIdCell.textContent = rowData.id;

        var targetNameCell = document.createElement('td');
        targetNameCell.textContent = rowData.name;

        var targetSurnameCell = document.createElement('td');
        targetSurnameCell.textContent = rowData.surname;

        var targetModalButton = document.createElement('button');
        targetModalButton.type = "button";
        targetModalButton.classList.add('btn', 'btn-success');
        targetModalButton.textContent = "Vai";

        var targetModalCell = document.createElement('td');
        targetModalCell.appendChild(targetModalButton);

        targetRow.appendChild(targetIdCell);
        targetRow.appendChild(targetNameCell);
        targetRow.appendChild(targetSurnameCell);
        targetRow.appendChild(targetModalCell);

        this.#targetBody.appendChild(targetRow);
    }

    UpdatePagination() {
        this.#pageIndexSelector.innerHTML = "";

        var prevSpan = document.createElement('span');
        prevSpan.ariaHidden = true;
        prevSpan.textContent = "Prev";
        
        var prevLink = document.createElement('a');
        prevLink.ariaLabel = "Previous";
        prevLink.classList.add("page-link");
        prevLink.appendChild(prevSpan);

        var prevItem = document.createElement('li');
        prevItem.classList.add('page-item');
        
        if (this.#pageIndex == 0) {
            prevLink.ariaDisabled = true;
            prevLink.tabIndex = -1;
            prevItem.classList.add('disabled');
        }

        else
            prevItem.addEventListener('click', (event) => {
                event.preventDefault();
                this.#targetForm.Search(this.#pageIndex - 1);
            });

        prevItem.appendChild(prevLink);
        this.#pageIndexSelector.appendChild(prevItem);

        if (this.#pageIndex > 0) {
            var realPrevLink = document.createElement('a');
            realPrevLink.textContent = (this.#pageIndex);
            realPrevLink.classList.add('page-link');

            var realPrevItem = document.createElement('li');
            realPrevItem.classList.add('page-item');

            realPrevItem.appendChild(realPrevLink);
            realPrevItem.addEventListener('click', (event) => {
                event.preventDefault();
                this.#targetForm.Search(this.#pageIndex - 1);
            });
            this.#pageIndexSelector.appendChild(realPrevItem);
        }

        var currentLink = document.createElement('a');
        currentLink.textContent = (this.#pageIndex + 1);
        currentLink.classList.add('page-link');

        var currentItem = document.createElement('li');
        currentItem.ariaCurrent = "page";
        currentItem.classList.add('page-item', 'active');

        currentItem.appendChild(currentLink);
        this.#pageIndexSelector.appendChild(currentItem);

        if (this.#pageTotal > (this.#pageIndex + 1)) {
            var realNextLink = document.createElement('a');
            realNextLink.textContent = (this.#pageIndex + 2);
            realNextLink.classList.add('page-link');

            var realNextItem = document.createElement('li');
            realNextItem.classList.add('page-item');

            realNextItem.appendChild(realNextLink);
            realNextItem.addEventListener('click', (event) => {
                event.preventDefault();
                this.#targetForm.Search(this.#pageIndex + 1);
            });
            this.#pageIndexSelector.appendChild(realNextItem);
        }

        var nextSpan = document.createElement('span');
        nextSpan.ariaHidden = true;
        nextSpan.textContent = "Next";
        
        var nextLink = document.createElement('a');
        nextLink.ariaLabel = "Next";
        nextLink.classList.add("page-link");
        nextLink.appendChild(nextSpan);

        var nextItem = document.createElement('li');
        nextItem.classList.add('page-item');

        if (this.#pageTotal <= (this.#pageIndex + 1)) {
            nextLink.ariaDisabled = true;
            nextLink.tabIndex = "-1";
            nextItem.classList.add('disabled')
        }
            
        else
            nextItem.addEventListener('click', (event) => {
                event.preventDefault();
                this.#targetForm.Search(this.#pageIndex + 1);
            });

        nextItem.appendChild(nextLink);
        this.#pageIndexSelector.appendChild(nextItem);

        this.#pageSizeSelector.value = this.#pageSize;
    }
}