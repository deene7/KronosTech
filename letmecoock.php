<label>Digite seu CEP: </label>
<input type="number" id="cep">
<button onclick="consultaEndereco()">Consultar</button>

<div id="resultado">
    <p>Endereço: <input type="text" id="endereco" readonly></p> <!-- Campo de endereço agora é readonly -->
    <p>Complemento: <input type="text" id="complemento" readonly></p> <!-- Campo de complemento readonly -->
    <p>Bairro: <input type="text" id="bairro" readonly></p> <!-- Campo de bairro readonly -->
    <p>Cidade: <input type="text" id="cidade" readonly> - <input type="text" id="uf" readonly></p> <!-- Campos de cidade e estado readonly -->
</div>
</section>

<script>
function consultaEndereco() {
    let cep = document.querySelector('#cep').value;

    // Verificação do formato do CEP
    if (!/^\d{8}$/.test(cep)) { // Verifica se o CEP possui 8 dígitos numéricos
        alert('CEP inválido!');
        return;
    }

    let url = `https://viacep.com.br/ws/${cep}/json/`;

    fetch(url)
        .then(response => response.json())
        .then(data => {
            mostrarEndereco(data);
        })
        .catch(error => console.error('Erro ao consultar o CEP:', error));
}

function mostrarEndereco(dados) {
    let resultado = document.querySelector('#resultado');
    if (dados.erro) {
        resultado.innerHTML = "Não foi possível localizar seu endereço!";
    } else {
        document.getElementById('endereco').value = dados.logradouro;
        document.getElementById('complemento').value = dados.complemento;
        document.getElementById('bairro').value = dados.bairro;
        document.getElementById('cidade').value = dados.localidade;
        document.getElementById('uf').value = dados.uf;

        // Habilitar campos para edição
        document.getElementById('endereco').readOnly = false;
        document.getElementById('complemento').readOnly = false;
        document.getElementById('bairro').readOnly = false;
        document.getElementById('cidade').readOnly = false;
        document.getElementById('uf').readOnly = false;
    }
}
</script>
