// Função para salvar a preferência do usuário
function salvarPreferencia(preferencia) {
    localStorage.setItem('preferenciaBarraLateral', preferencia);
}

// Função para carregar a preferência do usuário
function carregarPreferencia() {
    return localStorage.getItem('preferenciaBarraLateral');
}

// Verifica se há uma preferência salva e exibe a barra lateral conforme necessário
document.addEventListener('DOMContentLoaded', function() {
    var preferencia = carregarPreferencia();
    if (preferencia === 'mostrar') {
        // Marca o checkbox como selecionado para exibir a barra lateral
        document.getElementById('nav-toggle').checked = true;
    } else {
        // Marca o checkbox como não selecionado para esconder a barra lateral
        document.getElementById('nav-toggle').checked = false;
    }
});

// Adiciona um listener para o evento de mudança no checkbox
document.getElementById('nav-toggle').addEventListener('change', function() {
    if (this.checked) {
        salvarPreferencia('mostrar');
    } else {
        salvarPreferencia('esconder');
    }
});

document.addEventListener('DOMContentLoaded', function() {
    var url = window.location.pathname;
    var links = document.querySelectorAll('.sidebar-menu a');

    links.forEach(function(link) {
        var href = link.getAttribute('href');

        // Verifica se o URL da página atual contém o href do link
        if (url.includes(href)) {
            // Adiciona a classe active ao link correspondente
            link.classList.add('active');
        } else {
            // Remove a classe active de qualquer outro link na barra lateral
            link.classList.remove('active');
        }
    });
});
