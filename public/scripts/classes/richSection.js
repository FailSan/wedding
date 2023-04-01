export class RichSection {
    constructor(section) {
        this.element = section;
    }
    
    get selected() {
        return this.element.dataset.sectionSel == 1 ? true : false;
    }

    set selected(value) {
        if(value)
            this.element.dataset.sectionSel = 1;
        else
            this.element.dataset.sectionSel = 0;
    }
}