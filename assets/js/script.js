$(() => {

    if (window.location.pathname == '/login') {

        if ($('#sucesso').length > 0) {
            window.location.href = '/'
        }
        
    }

})