document.addEventListener('DOMContentLoaded', () => {
    const editModal = $('#editModal');
    const editForm = document.getElementById('editForm');

    editModal.on('show.bs.modal', (event) => {
        const button = $(event.relatedTarget);

        const id = button.data('id');
        const nome = button.data('nome');
        const dataNascimento = button.data('data-nascimento');
        const email = button.data('email');
        const profissao = button.data('profissao');
        const telefone = button.data('telefone');
        const celular = button.data('celular');
        const whatsapp = button.data('whatsapp');
        const notificacoesEmail = button.data('notificacoes-email');
        const notificacoesSms = button.data('notificacoes-sms');
        
        $('#editId').val(id);
        $('#editNome').val(nome);
        $('#editDataNascimento').val(dataNascimento);
        $('#editEmail').val(email);
        $('#editProfissao').val(profissao);
        $('#editTelefone').val(telefone);
        $('#editCelular').val(celular);
        
        // Checando e marcando os checkboxes de acordo com os valores
        if (whatsapp === 1) {
            $('#whatsappModal').prop('checked', true);
        } else {
            $('#whatsappModal').prop('checked', false);
        }
        

        if (notificacoesEmail === 1) {
            $('#notificacoes-email-modal').prop('checked', true);
        } else {
            $('#notificacoes-email-modal').prop('checked', false);
        }

        if (notificacoesSms === 1) {
            $('#notificacoes-sms-modal').prop('checked', true);
        } else {
            $('#notificacoes-sms-modal').prop('checked', false);
        }

        // Atualizando o action do formulário para incluir o id do usuário
        editForm.setAttribute('action', `?action=update&id=${id}`);
    });
});



function preencherModalExclusao(event) {
    const deleteForm = document.getElementById('deleteForm');
    var button = event.relatedTarget; 
    var userId = button.getAttribute('data-id');
    var userName = button.getAttribute('data-nome');
    var userEmail = button.getAttribute('data-email');

    var userInfo = "Nome: " + userName + "<br>Email: " + userEmail;

    document.getElementById('deleteUserInfo').innerHTML = userInfo;
    document.getElementById('deleteUserId').value = userId;

    deleteForm.setAttribute('action', `?action=delete&id=${userId}`);
}

$('#deleteModal').on('show.bs.modal', preencherModalExclusao);