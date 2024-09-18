// Função para formatar CPF ou CNPJ com pontos e hífen
function formatCpfCnpj(input) {
    let value = input.value.replace(/\D/g, ''); // Remove tudo que não é dígito

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

    input.value = value; // Atualiza o valor do input
}

// Função para formatar CEP com o hífen
function formatCep(input) {
    let value = input.value.replace(/\D/g, ''); // Remove tudo que não é dígito

    if (value.length > 5) {
        value = value.replace(/(\d{5})(\d)/, '$1-$2');
    }

    input.value = value; // Atualiza o valor do input
}

// Função para desabilitar a opção "Selecione"
function disableSelectOption(selectId, value) {
    const select = document.getElementById(selectId);
    const option = select.querySelector(`option[value="${value}"]`);
    if (option) {
        option.disabled = true; // Desabilita a opção
    }
}

// Função para exibir ou ocultar campos com base no país
function toggleFields(paisId) {
    const estadoSelect = document.getElementById('estado');
    const estadoInput = document.getElementById('estado_input');
    const cidadeSelect = document.getElementById('cidade');
    const cidadeInput = document.getElementById('cidade_input');

    const isBrazil = paisId == 1; // Se Brasil
    estadoSelect.style.display = isBrazil ? 'block' : 'none';
    estadoSelect.disabled = !isBrazil;
    estadoInput.style.display = isBrazil ? 'none' : 'block';
    estadoInput.disabled = isBrazil;
    cidadeSelect.style.display = isBrazil ? 'block' : 'none';
    cidadeSelect.disabled = !isBrazil;
    cidadeInput.style.display = isBrazil ? 'none' : 'block';
    cidadeInput.disabled = isBrazil;

    // Limpa o select de cidades ao mudar o país
    cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';
}

// Gerencia a exibição e habilitação dos campos de estado e cidade com base na seleção do país
document.getElementById('pais').addEventListener('change', function () {
    const paisId = this.value;
    disableSelectOption('pais', '');

    toggleFields(paisId);

    if (paisId == 1) {
        fetch(`/get-estados/${paisId}`)
            .then(response => response.json())
            .then(data => {
                const estadoSelect = document.getElementById('estado');
                estadoSelect.innerHTML = '<option value="">Selecione o Estado</option>';
                data.forEach(estado => {
                    const option = document.createElement('option');
                    option.value = estado.id;
                    option.textContent = estado.nome;
                    estadoSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar estados:', error));
    }
});

// Gerencia a exibição e habilitação do campo de cidade com base na seleção do estado
document.getElementById('estado').addEventListener('change', function () {
    const estadoId = this.value;
    disableSelectOption('estado', '');

    const cidadeSelect = document.getElementById('cidade');
    cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';
    cidadeSelect.disabled = true;

    const cidadeInput = document.getElementById('cidade_input');
    cidadeInput.style.display = 'none';
    cidadeInput.disabled = true;

    if (estadoId) {
        fetch(`/get-cidades/${estadoId}`)
            .then(response => response.json())
            .then(data => {
                cidadeSelect.disabled = false;
                data.forEach(cidade => {
                    const option = document.createElement('option');
                    option.value = cidade.nome;
                    option.textContent = cidade.nome;
                    cidadeSelect.appendChild(option);
                });
            })
            .catch(error => console.error('Erro ao carregar cidades:', error));
    }
});

// Aplicação das funções nos inputs
document.addEventListener('DOMContentLoaded', function () {
    const cpfCnpjInput = document.getElementById('cpf_cnpj');
    const cepInput = document.getElementById('postal_code');

    if (cpfCnpjInput) {
        cpfCnpjInput.addEventListener('input', function () {
            formatCpfCnpj(cpfCnpjInput);
        });
    }

    if (cepInput) {
        cepInput.addEventListener('input', function () {
            formatCep(cepInput);
        });
    }

    document.getElementById('pais').addEventListener('change', function () {
        const paisId = this.value;
        toggleFields(paisId);
        // Adicione aqui a lógica para buscar estados
    });

    document.getElementById('estado').addEventListener('change', function () {
        const estadoId = this.value;
        // Adicione aqui a lógica para buscar cidades
    });
});
