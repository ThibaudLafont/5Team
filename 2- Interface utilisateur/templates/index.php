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

    <!-- Modal -->
    <div id="modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"></div>

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
    <!-- App script -->
    <script>
        list();

        function add()
        {
            $.ajax({
                url: '/add',
                type: 'GET',
                success : function(response, statut){
                    // On success, simply append form view and show modal
                    showModal(response);
                }
            });
        }

        function edit(id)
        {
            $.ajax({
                url: '/edit/' + id,
                type: 'GET',
                success : function(response, statut){
                    // On success, simply append form view and show modal
                    showModal(response);
                }
            });
        }

        function submit()
        {
            // Store form and data
            var form = $('#modal form');
            var data = {
                id: form.find('input#id').val(),
                title: form.find('input#title').val(),
                date: form.find('input#date').val(),
                spent: form.find('input#spent').val()
            }
            // Dynamic build of url => empty id is creation, given id is edition
            var url = (
                data.id == '' ?
                    '/add' :
                    '/edit/' + data.id
            );
            // Ajax request
            $.ajax({
                url: url,
                type: 'POST',
                data: data,
                success : function(response, statut){
                    // If add was successfull, show list
                    hideModal();
                    list();
                },
                error: function(response, statut, erreur){
                    // On error, append form view in modal (will contain errors)
                    showModal(response.responseText);
                }
            });
        }

        function spent() {
            $.ajax({
                url: '/spent',
                type: 'GET',
                success : function(response, statut){
                    appendSpent(response);
                },
                error: function(resultat, statut, erreur){
                    appendSpent('Error during spent fetch');
                }
            });
        }

        function list() {
            $.ajax({
                url: '/list',
                type: 'GET',
                success : function(response, statut){
                    appendMainView(response);
                },
                error: function(resultat, statut, erreur){
                    appendMainError(resultat, statut)
                }
            });
        }

        function deleteTicket(id) {
            // Ajax request
            $.ajax({
                url: '/delete/' + id,
                type: 'POST',
                success: function(response, status) {
                    list();
                }
            })
        }

        // Main view functions
        //////////////////////
        function appendMainView(view) {
            // Clear main content
            $('main').empty();
            // Display spent
            spent();
            // Append given view
            $('main').append(view);
        }

        function appendMainError(resultat, statut) {
            $('main').empty();
            $('main').append('<h1>' + resultat.responseText + '</h1>');
        }

        function appendSpent(content) {
            $('header nav p').remove();
            $('header nav').append(content);
        }


        // Modal functions
        //////////////////
        function showModal(content)
        {
            $('#modal').empty();
            $('#modal').append(content);
            $('#modal').modal('show');
        }
        function hideModal()
        {
            $("#modal").modal('hide');
        }

    </script>
</body>
</html>