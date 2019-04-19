<html>
<head>
    <!-- Bootstrap stylesheet -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
          crossorigin="anonymous">
</head>
<body>
    <!-- Header -->
    <header>
        <?php include('fragments/_header.html') ?>
    </header>

    <!-- Main content -->
    <main class="container mt-4"></main>

    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
    <!-- Perso script -->
    <script>
        $.ajax({
            url: '/list',
            type: 'GET',
            success : function(response, statut){
                appendView(response);
            },
            error: function(resultat, statut, erreur){
                appendError(resultat, statut)
            }
        })

        function appendView(view) {
            $('main').empty();
            $('main').append(view);
        }

        function appendError(resultat, statut) {
            $('main').empty();
            $('main').append('<h1>' + resultat.responseText + '</h1>');
        }
    </script>
</body>
</html>