$(document)(function () {
    $('#createForm')(function (event) {
        event.preventDefault();

        var formData = $(this).serialize();

        $.ajax({
            url: 'caminho/do/servidor', 
            type: 'POST',
            data: formData,
            success: function(response) {
                $('#createForm')[0].reset();

                alert('Usuário cadastrado com sucesso!');
            },
            error: function(xhr, status, error) {
                alert('Erro ao cadastrar usuário: ' + error);
            }
        });
    });
});