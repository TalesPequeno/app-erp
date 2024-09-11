function formatCpfCnpj(input) {
    // Remove qualquer caractere que não seja número
    let value = input.value.replace(/\D/g, '');

    if (value.length <= 11) { // CPF
        // Formata o CPF (000.000.000-00)
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d)/, '$1.$2');
        value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    } else if (value.length <= 14) { // CNPJ
        // Formata o CNPJ (00.000.000/0000-00)
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d)/, '$1-$2');
    }

    // Atualiza o valor formatado no campo
    input.value = value;
}

function formatCep(input) {
    // Remove qualquer caractere que não seja número
    let value = input.value.replace(/\D/g, '');

    if (value.length > 5) {
        // Formata o CEP (00000-000)
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
    }

    // Atualiza o valor formatado no campo
    input.value = value;
}

// Gerencia a exibição e habilitação dos campos de estado e cidade com base na seleção do país
document.getElementById('pais').addEventListener('change', function() {
    var paisId = this.value;
    var estadoSelect = document.getElementById('estado');
    var estadoInput = document.getElementById('estado_input');
    var cidadeSelect = document.getElementById('cidade');
    var cidadeInput = document.getElementById('cidade_input');

    // Desabilita a opção "Selecione o País" após a seleção
    this.querySelector('option[value=""]').disabled = true;

    // Se o país selecionado for Brasil (ID 1)
    if (paisId == 1) {
        estadoSelect.style.display = 'block';
        estadoSelect.disabled = true;
        estadoInput.style.display = 'none';
        estadoInput.disabled = true;
        cidadeSelect.style.display = 'block';
        cidadeSelect.disabled = true;
        cidadeInput.style.display = 'none';
        cidadeInput.disabled = true;
        cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';

        // Busca os estados do Brasil via AJAX e popula o select de estados
        fetch('/get-estados/' + paisId)
            .then(response => response.json())
            .then(data => {
                estadoSelect.innerHTML = '<option value="">Selecione o Estado</option>';
                estadoSelect.disabled = false;
                data.forEach(estado => {
                    var option = document.createElement('option');
                    option.value = estado.id;
                    option.textContent = estado.nome;
                    estadoSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro:', error));
    } else {
        // Se o país não for Brasil, exibe os campos de texto para estado e cidade
        estadoSelect.style.display = 'none';
        estadoSelect.disabled = true;
        estadoInput.style.display = 'block';
        estadoInput.disabled = false;
        cidadeSelect.style.display = 'none';
        cidadeSelect.disabled = true;
        cidadeInput.style.display = 'block';
        cidadeInput.disabled = false;
        cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';
    }
});

// Gerencia a exibição e habilitação do campo de cidade com base na seleção do estado
document.getElementById('estado').addEventListener('change', function() {
    var estadoId = this.value;
    var cidadeSelect = document.getElementById('cidade');
    var cidadeInput = document.getElementById('cidade_input');

    // Desabilita a opção "Selecione o Estado" após a seleção
    this.querySelector('option[value=""]').disabled = true;

    cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';
    cidadeSelect.disabled = true;
    cidadeInput.style.display = 'none';
    cidadeInput.disabled = true;

    // Busca as cidades do estado selecionado via AJAX e popula o select de cidades
    if (estadoId) {
        fetch('/get-cidades/' + estadoId)
            .then(response => response.json())
            .then(data => {
                cidadeSelect.disabled = false;
                data.forEach(cidade => {
                    var option = document.createElement('option');
                    option.value = cidade.nome;
                    option.textContent = cidade.nome;
                    cidadeSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro:', error));
    }
});
