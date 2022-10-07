$(document).ready(function() {

    // add buy
    $('#form-add-buy').bind('submit', add)
    // add category
    $('#form-add-cat').bind('submit', add)

    // add
    function add(e) {
        e.preventDefault()

        let form = $(this)
        let url  = form.attr('action')
        let data = new FormData(this)

        $.ajax(url, {
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,

            success: function(response) {
                let errors = $('.errors')
                errors.html('')

                if (response.status == true) {
                    let list = $('.list')

                    if (form.is('#form-add-buy')) {
                        list.prepend(buyHtml(response.new))
                    }

                    if (form.is('#form-add-cat')) {
                        list.prepend(catHtml(response.new))
                    }

                    form.trigger('reset')
                    $('.filter').trigger('change')
                }

                if (response.status == false) {
                    Object.values(response.errors)
                        .forEach(error => {
                            errors.append(errorHtml(error))
                        })
                }
            },
        })
    }

    // buy html
    function buyHtml(buy) {
        return `<li class="list-group-item list__item d-flex justify-content-between align-items-center" 
                    status="not bought" cat-id="${buy.category_id}">
                    <span>${buy.name}</span>
                    <a href="/buys/${buy.id}" class="not-buy" title="buy">not bought</a>
                    <span>${buy.category_name}</span>
                    <span>${buy.created_at}</span>
                    <a href="/buys/${buy.id}" class="delete text-end" title="deleete">&#10060;</a>
                </li>`;
    }

    // category html
    function catHtml(cat) {
        return `<li class="list-group-item list__item d-flex justify-content-between align-items-center">
                    <span>${cat.name}</span>
                    <a href="/categories/${cat.id}" class="delete" title="deleete">&#10060;</a>
                </li>`
    }

    // error html
    function errorHtml(error) {
        return `<p class="error">${error}</p>`
    }


    // delete
    $(document).on('click', '.delete', function(e) {
        e.preventDefault()

        let link = $(this);
        let url  = link.attr('href')

        $.ajax(url, {
            type: 'DELETE',

            success: function(response) {
                if (response.status == true) {
                    let item = link.closest('li');
                    
                    item.remove()
                }
            },
        })
    })


    // buy
    $(document).on('click', '.not-buy', function(e) {
        e.preventDefault()

        let link = $(this);
        let url  = link.attr('href')

        $.ajax(url, {
            type: 'PATCH',

            success: function(response) {
                if (response.status == true) {
                    link.closest('li').attr('status', 'bought')
                    link.replaceWith(statusHtml('bought'))

                    $('.filter').trigger('change')
                }
            }
        })
    })

    // status html
    function statusHtml(status) {
        return `<span>${status}</span>`
    }


    // filter
    $('.filter').bind('change', function(e) {
        let status = $('.filter-status').val()
        let cat_id = $('.filter-cat').val()

        let items = $('.list__item')

        items.each((i, e) => {
            let item = $(e)

            if ((status == item.attr('status') || status == 'all') && (cat_id == item.attr('cat-id') || cat_id == 'all')) {
               item.removeClass('d-none')
            } else {
                item.addClass('d-none')
            }
        })
    })

})
