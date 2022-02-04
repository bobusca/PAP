<?php

use core\classes\Store;
// Verifcar se recebo dados
?>
<table class="table">
    <!-- Cabeçalho da Nossa Tabela -->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Email</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
        </tr>
    </thead>
    <!-- Fim cabeçalho da nossa tabela -->
    <!-- Inicio do corpo da tabela -->
    <tbody>
        <!-- Ciclo que correrá toda a tabela -->
        <?php foreach ($clientes as $cliente) : ?>
            <tr>
                <th scope="row">1</th>
                <td><?=$cliente->email ?></td>
                <td><?=$cliente->nome_completo ?></td>
                <td><?=$cliente->senha ?></td>
            </tr>
        <?php endforeach; ?>
        <!-- Fim ciclo -->
    </tbody>
    <!-- Fim do Corpo da nossa Tabela -->
</table>