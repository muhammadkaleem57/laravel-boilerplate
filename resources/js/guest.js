import "./bootstrap.js"

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

import "cleave.js"
import "select2"

import Swal from "sweetalert2"
window.Swal = Swal

import "../assets/js/guest-scripts"

$(document).ready(function(){
    creditCardFields()
})

function creditCardFields() {
    // const today = new Date()
    // let month = today.getMonth()+1
    // month = month < 10 ? '0'+month : month

    new Cleave('#card_number', {
        creditCard: true
    })

    new Cleave('#card_date', {
        date: true,
        // dateMin: `${today.getDate()}-${month}`,
        datePattern: ['m', 'y']
    })

    new Cleave('#card_cvv', {
        blocks: [3],
        numericOnly: true
    })
}



