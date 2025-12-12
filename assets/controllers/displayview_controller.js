import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ["tableViewBtn", "galleryViewBtn", "galleryViewSelected"]
    connect() {
    }

    activeTableView(){
        this.activeBtnStyle(this.tableViewBtnTarget)
        this.disactiveBtnStyle(this.galleryViewBtnTarget)
        this.galleryViewSelectedTarget.value = 0
        this.activeFirstSubmit(5)

    }

    activeGalleryView(){
        console.log('ok')
        this.activeBtnStyle(this.galleryViewBtnTarget)
        this.disactiveBtnStyle(this.tableViewBtnTarget)
        this.galleryViewSelectedTarget.value = 1
        this.activeFirstSubmit(5)

    }

    activeBtnStyle(btn){
        btn.classList.add('bg-blue-500')
        btn.classList.add('text-white')
        btn.classList.remove('text-body')
        btn.classList.remove('bg-neutral-primary-soft')
        btn.classList.remove('hover:bg-neutral-secondary-medium')
        btn.classList.remove('hover:text-heading')
    }

    disactiveBtnStyle(btn){
        btn.classList.remove('bg-blue-500')
        btn.classList.remove('text-white')
        btn.classList.add('text-body')
        btn.classList.add('bg-neutral-primary-soft')
        btn.classList.add('hover:bg-neutral-secondary-medium')
        btn.classList.add('hover:text-heading')
    }

    activeFirstSubmit(valueMax){
        console.log(valueMax)
        let maxPerPage = document.getElementById('maxPerPage')
        maxPerPage.value = valueMax
        let form = document.querySelector('form')
        form.requestSubmit()
    }

}
