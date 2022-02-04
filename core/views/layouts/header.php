<?php

use core\classes\Store;

//$_SESSION['cliente'] = 1;
?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-1 p-1">
            <a href="?a=inicio">
            <h3><img src="assets/images/logo.png"></h3>
            </a>
        </div>
        <div class="col-11 text-end p-4">
            <a href="?a=inicio" class="nav-item">Início</a>
            <a href="?a=loja" class="nav-item">Empregos</a>
            <!-- verifica se existe cliente na sessão -->
            <?php if (Store::clienteLogado()) : ?>
                <!--<a href="?a=minha_conta" class="nav-item">
                    </a>-->
                <i class="fas fa-user mr-6"></i> <?= $_SESSION['utilizador'] ?></a>
                <a href="?a=logout" class="nav-item">Logout</a>
            <?php else : ?>
                <a href="?a=login" class="nav-item"><i class="fas fa-sign-out-alt"></i></a>
                <a href="?a=novo_cliente" class="nav-item">Criar Conta</a>
            <?php endif; ?>
            <a href="?a=carrinho"><i class="fas fa-cart-plus"></i></a>
            <span class="badge bg-secondary"></span>
        </div>
    </div>
</div>