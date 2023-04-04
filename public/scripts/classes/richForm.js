export class RichForm {
    constructor(form, label) {
        this.element = form;
        this.sideLabel = label;
    }
    
    get elements() {
        return this.element.elements;
    }

    get content() {
        return this.element.dataset.content;
    }
    
    get selected() {
        return this.element.dataset.formSel == 1 ? true : false;
    }

    set selected(value) {
        if(value) {
            this.element.dataset.formSel = 1;
            this.sideLabel.selected = true;
        }   
        else {
            this.element.dataset.formSel = 0;
            this.sideLabel.selected = false;
        }
    }

    get enabled() {
        return this.element.classList.contains('hidden') ? false : true;
    }

    set enabled(value) {
        if(value) {
            this.element.classList.remove('hidden');
            this.sideLabel.enabled = true;
        }
        else {
            this.element.classList.add('hidden');
            this.element.reset();
            this.sideLabel.enabled = false;
        }
    }

    get errorBox() {
        return this.element.querySelector('.error-box');
    }

    async inputValidation() {
        let currentContent = this.content;
        let currentToken = this.elements['_token'].value;
        
        let formBody = new FormData;
        formBody.append('_token', currentToken);
    
        let value = "";
        switch(currentContent) {
            case 'church_confirm':
            case 'castle_confirm':
            case 'extra_confirm':
                if(this.elements[currentContent].value == 'true')
                    value = 1;
                if(this.elements[currentContent].value == 'false')
                    value = 0;
                break;
            case 'extra_guests':
                let extraGuests = this.element.querySelectorAll('.extra-guest-label');
                value = extraGuests.length;
                break;
            default:
                value = this.elements[currentContent].value;
                break;
        }
        formBody.append(currentContent, value);
    
        let result = await fetch('/guest/validate', {
            method: 'post',
            body: formBody
        })
            .then((servResponse) => servResponse.json())
            .then((jsonData) => {

                if(jsonData.error) {
                    this.showError(jsonData.error);
                    return false;

                } else {
                    this.showValidate(jsonData.success);
                    return jsonData.success[this.content];
                }
            })
            .catch((servError => console.log(servError)));

        return result;
    }

    showError(errorList) {
        this.errorBox.innerHTML = "";
        this.errorBox.classList.remove('hidden');
        
        for(let textError in errorList) {
            let message = document.createElement('p');
            message.textContent = errorList[textError];
            this.errorBox.appendChild(message);
        }

        this.sideLabel.value = "";
        this.sideLabel.validated = false;
    }

    showValidate(successList) {
        this.errorBox.innerHTML = "";
        this.errorBox.classList.add('hidden');

        switch(successList[this.content]) {
            case "1":
                this.sideLabel.value = "Sì"
                break;
            case "0":
                this.sideLabel.value = "No"
                break;
            default:
                this.sideLabel.value = successList[this.content];
                break;
        }
        this.sideLabel.validated = true;
    }
}