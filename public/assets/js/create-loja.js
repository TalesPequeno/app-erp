// Aguarda o carregamento completo do DOM antes de executar o código
document.addEventListener('DOMContentLoaded', function () {
    // Seleciona o formulário e os elementos de input e botão de submit
    var form = document.querySelector('form');
    var cnpjInput = document.getElementById('cnpj');
    var cepInput = document.getElementById('cep');
    var submitButton = form.querySelector('button[type="submit"]');
    var estadoSelect = document.getElementById('estado');
    var estadoInput = document.getElementById('estado_input');
    var paisSelect = document.getElementById('pais');

    // Função para validar o CNPJ
    function validateCNPJ() {
        // Remove todos os caracteres não numéricos
        var cnpj = cnpjInput.value.replace(/\D/g, '');
        // Verifica se o CNPJ tem exatamente 14 dígitos
        if (cnpj.length !== 14) {
            cnpjInput.setCustomValidity('O CNPJ deve conter exatamente 14 dígitos.');
            return false;
        } else {
            cnpjInput.setCustomValidity('');
            return true;
        }
    }

    // Função para validar o CEP
    function validateCEP() {
        // Remove todos os caracteres não numéricos
        var cep = cepInput.value.replace(/\D/g, '');
        // Verifica se o CEP tem exatamente 8 dígitos
        if (cep.length !== 8) {
            cepInput.setCustomValidity('O CEP deve conter exatamente 8 dígitos.');
            return false;
        } else {
            cepInput.setCustomValidity('');
            return true;
        }
    }

    // Função para validar o formulário, desabilitando o botão de submit se as validações falharem
    function validateForm() {
        var isCNPJValid = validateCNPJ();
        var isCEPValid = validateCEP();
        submitButton.disabled = !(isCNPJValid && isCEPValid);
    }

    // Formata o valor do CNPJ enquanto o usuário digita e chama a validação do formulário
    cnpjInput.addEventListener('input', function (e) {
        var value = e.target.value.replace(/\D/g, '');
        if (value.length > 14) {
            value = value.slice(0, 14);
        }
        var formattedValue = value;
        if (value.length > 2) {
            formattedValue = value.slice(0, 2) + '.' + value.slice(2);
        }
        if (value.length > 5) {
            formattedValue = value.slice(0, 2) + '.' + value.slice(2, 5) + '.' + value.slice(5);
        }
        if (value.length > 8) {
            formattedValue = value.slice(0, 2) + '.' + value.slice(2, 5) + '.' + value.slice(5, 8) + '/' + value.slice(8);
        }
        if (value.length > 12) {
            formattedValue = value.slice(0, 2) + '.' + value.slice(2, 5) + '.' + value.slice(5, 8) + '/' + value.slice(8, 12) + '-' + value.slice(12);
        }
        e.target.value = formattedValue;
        validateForm();
    });

    // Valida o CNPJ quando o campo perde o foco
    cnpjInput.addEventListener('blur', validateCNPJ);

    // Formata o valor do CEP enquanto o usuário digita e chama a validação do formulário
    cepInput.addEventListener('input', function (e) {
        var value = e.target.value.replace(/\D/g, '');
        if (value.length > 8) {
            value = value.slice(0, 8);
        }
        var formattedValue = value;
        if (value.length > 5) {
            formattedValue = value.slice(0, 5) + '-' + value.slice(5);
        }
        e.target.value = formattedValue;
        validateForm();
    });

    // Valida o CEP quando o campo perde o foco
    cepInput.addEventListener('blur', validateCEP);

    // Adiciona uma validação final no momento de submissão do formulário
    form.addEventListener('submit', function (event) {
        if (!validateCNPJ() || !validateCEP()) {
            event.preventDefault(); // Impede o envio do formulário se as validações falharem
        }
    });

    // Chama a função de validação inicial para garantir que o botão de submit esteja corretamente habilitado ou desabilitado
    validateForm();
});

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

// Converte o texto digitado nas inputs de tipo texto para maiúsculas automaticamente
document.addEventListener('DOMContentLoaded', function () {
    var inputs = document.querySelectorAll('input[type="text"]');
    
    inputs.forEach(function(input) {
        input.addEventListener('input', function() {
            this.value = this.value.toUpperCase(); // Converte o texto para letras maiúsculas
        });
    });
});
