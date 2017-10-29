$(document).ready(function () {

    if ($('#dashboard').length > 0) {
        CKEDITOR.replace("commentaire");
    }
    if ($('#prospect').length > 0) {
        CKEDITOR.replace("com");
    }
    if ($('#client').length > 0) {
        CKEDITOR.replace("com");
    }

    if ($('#dashboard').length > 0) {
        $('.delete_resume').click(function () {
            var ident = $(this).data();
            $.post(
                'delete_report.php', // Le fichier cible côté serveur.
                {
                    id: ident['id']
                }
                , deleted(ident['id'])
            );
            function deleted(id) {
                var el = '.item_resume_' + id;
                $(el).css('display', 'none');
            }
        });
    }
    if ($('#list').length > 0) {
        $('.delete_resume').click(function () {
            var ident = $(this).data();
            $.post(
                'delete_report.php', // Le fichier cible côté serveur.
                {
                    id: ident['id']
                }
                , deleted(ident['id'])
            );

            function deleted(id) {
                var el = '.item_resume_' + id;
                $(el).css('display', 'none');

            }
        });
    }
    if ($('#prospect').length > 0 || $('#list_prospect').length > 0) {
        $('.delete_resume').click(function () {
            var ident = $(this).data();
            $.post(
                'delete_prospect.php', // Le fichier cible côté serveur.
                {id: ident['id']}
                , deleted(ident['id'])
            );
            function deleted(id) {
                var el = '.item_resume_' + id;
                $(el).css('display', 'none');

            }
        });
    }
    if ($('#list_prospect').length > 0) {
        $('.swap_client').click(function () {
            var ident = $(this).data();
            $.ajax({
                url: 'swap_client.php',
                type: 'POST',
                data: 'id=' + ident['id'], // On fait passer nos variables, exactement comme en GET, au script more_com.php
                dataType: 'json',
                success: function (data) {
                    if (data['id']) {
                        window.location.href = "client.php?id=" + data['id'];
                    } else {
                        alert('Le client existe déjà');
                    }
                }
            });

        });
    }
    if ($('#list_client').length > 0) {
        $('.search-bar input').on('change paste keyup', function () {
            var val = $(this).val();
            $.ajax({
                url: 'search_client.php',
                type: 'POST',
                data: 'search=' + val, // On fait passer nos variables, exactement comme en GET, au script more_com.php
                dataType: 'json',
                success: function (data) {
                    $('#result').empty();
                    if (data.length > 0) {
                        for (var i = 0; i < data.length; i++) {
                            var element = '<div class="col-4"><div class="card" style="width: 20rem;"><div class="card-body">' +
                                '<h4 class="card-title">' + data[i]['societe'] + '</h4><p class="card-text"><span>' + data[i]['nom'] + ' </span>' +
                                '<span>' + data[i]['prenom'] + ' </span ></p><a href = "client.php?id=' + data[i]['id'] + '"class= "btn btn-primary btn-block" > ' +
                                'Accéder </a></div></div></div>';
                            $('#result').append(element);
                        }
                    }
                    else{
                        var element = '<div class="alert alert-light" role="alert">Aucun élément trouvé</div>';
                        $('#result').append(element);
                    }
                }
            });
        })
    }

    if($('#client').length > 0 ){
        $('.info_client input , .info_client textarea').on('change paste keyup',function () {
        var donnee = $('#form_client').serialize();
            $.ajax({
                url: 'modify_client.php',
                type: 'POST',
                data: donnee,
                dataType: 'json',
                success: function (data) {
                    $('h1').text(data);
                }
            });
        });
        CKEDITOR.instances['com'].on('change', function() {
            var text = CKEDITOR.instances['com'].getData();
            var id = $('.info_client_commentaire textarea').data();
            id = id['id'];
            $.ajax({
                url: 'modify_client_commentaire.php',
                type: 'POST',
                data: 'text='+text+'&id='+id,
                dataType: 'JSON',
                success: function (data) {
                }
            });
        });


        $('#client .nav-client #general').click(function () {
            $('.element_navigation > div').each(function () {
               $(this).hide();
            });
            $('.element_navigation .info_client').show();
        });
        $('#client .nav-client #commentaires').click(function () {
            $('.element_navigation > div').each(function () {
               $(this).hide();
            });
            $('.element_navigation .info_client_commentaire').show();
        });
        $('#client .nav-client #documents').click(function () {
            $('.element_navigation > div').each(function () {
               $(this).hide();
            });
            $('.element_navigation .info_client_documents').show();
        });

    }

});