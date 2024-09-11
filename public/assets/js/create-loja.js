document.addEventListener('DOMContentLoaded', function () {
    var form = document.querySelector('form');
    var cnpjInput = document.getElementById('cnpj');
    var cepInput = document.getElementById('cep');
    var submitButton = form.querySelector('button[type="submit"]');
    var estadoSelect = document.getElementById('estado');
    var cidadeSelect = document.getElementById('cidade');
    var estadoInput = document.getElementById('estado_input');
    var cidadeInput = document.getElementById('cidade_input');
    var paisSelect = document.getElementById('pais');

    function setCustomValidityMessage(input, message) {
        input.setCustomValidity(message || '');
        return message === '';
    }

    function formatCNPJ(value) {
        value = value.replace(/\D/g, '');
        if (value.length > 14) value = value.slice(0, 14);
        return value.replace(/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2}).*/, '$1.$2.$3/$4-$5');
    }

    function formatCEP(value) {
        value = value.replace(/\D/g, '');
        if (value.length > 8) value = value.slice(0, 8);
        return value.replace(/^(\d{5})(\d{3}).*/, '$1-$2');
    }

    function validateCNPJ() {
        var cnpj = cnpjInput.value.replace(/\D/g, '');
        return setCustomValidityMessage(cnpjInput, cnpj.length === 14 ? '' : 'O CNPJ deve conter exatamente 14 dígitos.');
    }

    function validateCEP() {
        var cep = cepInput.value.replace(/\D/g, '');
        return setCustomValidityMessage(cepInput, cep.length === 8 ? '' : 'O CEP deve conter exatamente 8 dígitos.');
    }

    function validateForm() {
        var isCNPJValid = validateCNPJ();
        var isCEPValid = validateCEP();
        submitButton.disabled = !(isCNPJValid && isCEPValid);
    }

    cnpjInput.addEventListener('input', function (e) {
        e.target.value = formatCNPJ(e.target.value);
        validateForm();
    });

    cepInput.addEventListener('input', function (e) {
        e.target.value = formatCEP(e.target.value);
        validateForm();
    });

    form.addEventListener('submit', function (event) {
        if (!validateCNPJ() || !validateCEP()) {
            event.preventDefault();
        }
    });

    paisSelect.addEventListener('change', function () {
        var paisId = this.value;
        var isBrasil = paisId == 1;
        
        this.querySelector('option[value=""]').disabled = true;

        estadoSelect.style.display = isBrasil ? 'block' : 'none';
        estadoSelect.disabled = !isBrasil;
        estadoInput.style.display = isBrasil ? 'none' : 'block';
        estadoInput.disabled = isBrasil;
        cidadeSelect.style.display = isBrasil ? 'block' : 'none';
        cidadeSelect.disabled = !isBrasil;
        cidadeInput.style.display = isBrasil ? 'none' : 'block';
        cidadeInput.disabled = isBrasil;
        cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';

        if (isBrasil) {
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
                .catch(error => console.error('Erro ao buscar estados:', error));
        }
    });

    estadoSelect.addEventListener('change', function () {
        var estadoId = this.value;
        cidadeSelect.innerHTML = '<option value="">Selecione a Cidade</option>';
        cidadeSelect.disabled = true;

        this.querySelector('option[value=""]').disabled = true;

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
                .catch(error => console.error('Erro ao buscar cidades:', error));
        }
    });

    var textInputs = document.querySelectorAll('input[type="text"]');
    textInputs.forEach(function (input) {
        input.addEventListener('input', function () {
            this.value = this.value.toUpperCase();
        });
    });

    validateForm();
});
