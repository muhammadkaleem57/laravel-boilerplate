window.perPage = 20


$(document).ready(function (){

    $(document).on('click', '.pagination a', function (event) {
        event.preventDefault()
        const page = $(this).attr('href').split('page=')[1]

        manipulateTable(page, true)
    })

    $(document).on('change', '.page_limit', function (event) {
        event.preventDefault()

        window.perPage = $(this).val()

        manipulateTable(1, true)
    })
})

// TODO Open Model demo
$('#add-product').click(function () {
    window.livewire.emit('interact:with:open:model', 'forms.product.create-product-form', '', 'modal-lg')
})

// TODO pagination filters demo
$('.search-input, .stock-status').on('click keyup', function () {
    manipulateTable()
})

let pageNumber = 1
const loader = $('#requestLoader')

// TODO manipulateTable demo
function manipulateTable(page = 1, isShowLoader = false) {

    pageNumber = page

    const search = $('.search-input').val()
    const stockStatus = $(".stock-status").val()
    const storeName = $("#store-name").val()

    $.ajax({
        beforeSend: function () {
            isShowLoader ? loader.show() : loader.hide()
        },
        method: "Get",
        url: "{{ URL::route(getRouteAlias().'.store.products.table-list') }}?page=" + pageNumber+"&perPage="+window.perPage,
        data: {name: search, stockStatus, storeName}

    }).done(function (response) {
        loader.hide()
        if (response)
            $('#table').html(JSON.parse(response))
        if(id){
            $('#product-name').val($('#prod-name-0').text())
        }
    })
}
