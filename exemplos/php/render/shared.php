<?php
  $retornoCW = cw_render();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vue.js Simples com Contador</title>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script> <!-- Inclua o Vue.js -->
    <?php
    // Extrai o conteúdo HTML da aplicação Next.js e insere na div
    echo $retornoCW->head;
    ?>
</head>
<body>
    <p>Header do site do cliente</p>

    <div id="app">
        <h1>{{ mensagem }}</h1>
        <p>Contador: {{ contador }}</p>
        <button @click="incrementarContador">Clique em mim!</button>
    </div>

    <script>
        new Vue({
            el: '#app',
            data: {
                mensagem: 'Olá, Vue.js teste!',
                contador: 0
            },
            methods: {
                incrementarContador() {
                    this.contador += 1;
                }
            }
        });
    </script>

    <?php
    // Extrai o conteúdo HTML da aplicação Next.js e insere na div
    echo $retornoCW->html;
    ?>


    <footer>Footer do site do cliente</footer>
</body>
</html>
