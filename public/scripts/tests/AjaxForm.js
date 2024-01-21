export class AjaxForm {
    //API Url -> utilizzato nella Fetch (obbligatorio)
    #targetUrl;
    //Tabella da aggiornare (obbligatorio)
    #targetTable;
    //Input di Ricerca (obbligatorio)
    #targetFields = [];
    //Token Anti-CSRF (obbligatorio per Laravel)
    #targetToken;
    //Bottone di Reset (opzionale)
    #resetButton;
    //Bottone di Ricerca (opzionale)
    #searchButton;
    //Se 'true' si abilita la ricerca durante la digitazione
    #searchOnChange;

    constructor(targetUrl, targetTable, targetToken, searchOnChange = true) {
        this.#targetUrl = targetUrl;
        this.#targetTable = targetTable;
        this.#targetToken = targetToken;
        this.#searchOnChange = searchOnChange;
    }

    set resetButton(button) {
        this.#resetButton = button;

        this.#resetButton.addEventListener('click', (event) => {
            event.preventDefault();
            this.Reset();
        })
    }

    set searchButton(button) {
        this.#searchButton = button;

        this.#searchButton.addEventListener('click', (event) => {
            event.preventDefault();
            this.Search();
        });
    }

    set searchFields(fields) {
        fields.forEach(field => this.#targetFields.push(field));
        if (this.#searchOnChange) {
            this.#targetFields.forEach(element => {
                element.addEventListener('keydown', () => {
                    this.Search();
                });
            });
        }
    }

    async Reset() {
        this.#targetFields.forEach(element => element.value = "");
        this.Search();
    }

    async Search(pageIndex) {
        var searchData = {
            searchParams: [],
            pageParams: {
                pageIndex: pageIndex ?? 0,
                pageSize: this.#targetTable.currentPagination.pageSize ?? 5,
            }
        };

        this.#targetFields.forEach(element => {
            let elementValue = element.value;
            let elementName = element.dataset.property;

            let elementObj = {
                value: elementValue,
                name: elementName
            };

            searchData.searchParams.push(elementObj);
        });

        var result = await fetch(this.#targetUrl, {
            method: 'post',
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": this.#targetToken,
            },
            body: JSON.stringify(searchData), 
        })
        .then(response => response.json())
        .catch(error => "Error in Fetch. Message: " + error);

        if (result)
            this.Show(result);
    }

    Show(result) {
        this.#targetTable.targetObject = result;
    }
}