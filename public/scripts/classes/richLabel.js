export class RichLabel {
    constructor(label) {
        this.element = label;
    }

    get content() {
        return this.element.dataset.content;
    }
    
    get selected() {
        return this.element.dataset.sideSel == 1 ? true : false;
    }

    set selected(value) {
        if(value)
            this.element.dataset.sideSel = 1;
        else
            this.element.dataset.sideSel = 0;
    }

    get validated() {
        return this.element.classList.contains('validated') ? true : false;
    }

    set validated(value) {
        if(value) {
            this.element.classList.remove('error');
            this.element.classList.add('validated');
        } else {
            this.element.classList.remove('validated');
            this.element.classList.add('error');
        }
    }

    get enabled() {
        return this.element.classList.contains('disabled') ? false : true;
    }

    set enabled(value) {
        if(value) {
            this.element.classList.remove('disabled');
        }
        else {
            this.element.classList.add('disabled');
        }
    }
}