var confirmDeleteModal = document.getElementById('confirmDeleteModal');
confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
    // Botão que acionou o modal
    var button = event.relatedTarget;
    // Extrai o ID do botão data-bs-id
    var lojaId = button.getAttribute('data-bs-id');
    // Atualiza o formulário de exclusão com o ID correto
    var form = confirmDeleteModal.querySelector('#deleteForm');
    form.action = '/lojas/' + lojaId;
});