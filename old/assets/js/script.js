$(() => {

    if (window.location.pathname == '/login.php') {

        if ($('#sucesso').length > 0) {
            window.location.href = '/'
        }
        
    }

})