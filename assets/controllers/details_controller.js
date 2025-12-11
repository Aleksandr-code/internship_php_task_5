import { Controller } from '@hotwired/stimulus';


export default class extends Controller {

    toggle(e) {
        let target = e.target.parentElement.dataset['accordionTarget']
        let body = document.querySelector(target)
        body.classList.toggle("hidden");
    }

    toggleDiv(e){
        let target = e.target.parentElement.dataset['accordionTarget']
        let body = document.querySelector(target)
        body.classList.toggle("hidden");
    }


}
