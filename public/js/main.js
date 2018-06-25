$(document).ready(function () {

    $(document).on('shown.bs.modal', '#modal-product-add', function () {
        setTimeout(function () {
            $('#modal-product-add').modal('hide')
        }, 1000)
    })

    $(document).on('shown.bs.modal', '#modal-error', function () {
        setTimeout(function () {
            $('#modal-error').modal('hide')
        }, 1000)
    })

    $(document).on('click', 'button[name=\'btn-product-add\']', function () {
        var id = $(this).attr('data-product-id')
        var price = $(this).attr('data-product-price')
        var count = $.trim($(this).parent().prev().val())
        $.ajax({
            url: 'cart/add',
            data: {
                id: id,
                count: count,
                price: price
            },
            type: 'POST',
        }).done(function (data) {
            $('#modal-product-add').modal('show')
            $('#modal-cart').remove()
            $('nav').remove()
            $('body').prepend(data)
        }).fail(function () {
            $('#modal-error').modal('show')
        })
    })

    $(document).on('click', 'button[name=\'btn-cart-item-del\']', function () {
        var id = $(this).attr('data-product-id')
        $.ajax({
            url: 'cart/del',
            data: {
                id: id,
            },
            type: 'POST',
        }).done(function (data) {
            $('#modal-cart').modal('hide')
            $('#modal-cart').remove()
            $('nav').remove()
            $('body').prepend(data)
            $('#modal-cart').modal('show')
        }).fail(function () {
            $('#modal-error').modal('show')
        })
    })

    $(document).on('click', 'button[name=\'btn-cart-del\']', function () {
        $.ajax({
            url: 'cart/clear',
            type: 'POST',
        }).done(function (data) {
            $('#modal-cart').remove()
            $('nav').remove()
            $('body').prepend(data)
        }).fail(function () {
            $('#modal-error').modal('show')
        })
    })

    $(document).on('click', 'button[name=\'btn-cart-open\']', function () {
        $('#modal-cart').modal('show')
    })

})