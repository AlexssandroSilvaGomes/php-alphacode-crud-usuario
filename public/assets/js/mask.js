// Máscara para Telefone
function mascaraTelefone(event) {
    var valor = event.target.value.replace(/\D/g, '');
    if (valor.length <= 10) {
        valor = valor.replace(/^(\d{2})(\d{4})(\d{4})$/, '($1) $2-$3');
    } else {
        valor = valor.replace(/^(\d{2})(\d{5})(\d{4})$/, '($1) $2-$3');
    }
    event.target.value = valor;
}

// Máscara para Data
function mascaraData(event) {
    var valor = event.target.value.replace(/\D/g, '');
    if (valor.length <= 4) {
        valor = valor.replace(/^(\d{2})(\d{2})$/, '$1/$2');
    } else {
        valor = valor.replace(/^(\d{2})(\d{2})(\d{4})$/, '$1/$2/$3');
    }
    event.target.value = valor;
}

document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('telefone').addEventListener('input', mascaraTelefone);
    document.getElementById('celular').addEventListener('input', mascaraTelefone);
    document.getElementById('data-nascimento').addEventListener('input', mascaraData);
});
const editModal = $('#editModal');
editModal.on('shown.modal', function () {
    document.getElementById('editTelefone').addEventListener('input', mascaraTelefone);
    document.getElementById('editCelular').addEventListener('input', mascaraTelefone);
    document.getElementById('editDataNascimento').addEventListener('input', mascaraData);
});