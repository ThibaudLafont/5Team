// When document is ready, call list() to display tickets
$(document).ready(list());

function add()
{
    $.ajax({
        url: '/add',
        type: 'GET',
        success : function(response, statut){
            // On success, simply append form view and show modal
            showModal(response);
        },
        error: function(response, statut, erreur) {
            appendMainAlert(erreur + ' error during add form fetch. Please try again');
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
        },
        error: function(response, statut, erreur) {
            appendMainAlert(erreur + ' error during edit form fetch. Please try again');
        }
    });
}

function remove(id) {
    // Ajax request
    $.ajax({
        url: '/delete/' + id,
        type: 'POST',
        success: function(response, status) {
            list();
        },
        error: function(response, statut, erreur) {
            appendMainAlert(erreur + ' error during ticket delete. Please try again');
        }
    })
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

function appendMainAlert(error) {
    var alert = document.createElement('p');
    alert.classList = 'alert alert-danger';
    alert.textContent = error;
    $('main').prepend(alert);
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
