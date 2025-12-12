import { Controller } from "@hotwired/stimulus"
import debounce from 'debounce'

// Connects to data-controller="autosubmit"
export default class extends Controller {
    static targets = ["inputSeed"]
    initialize() {
        this.debouncedSubmit = debounce(this.debouncedSubmit.bind(this), 300)
    }

    submit(e) {
        this.element.requestSubmit()
    }

    debouncedSubmit() {
        this.submit()
    }

    random() {
        let random = Math.floor(Math.random() * 10000001);
        this.inputSeedTarget.value = random;
        this.element.requestSubmit()
    }
}
