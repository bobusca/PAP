<?php

use core\classes\Store;
?>
<div class="container-fluid navegacao">
    <div class="row">
        <div class="col-6 p-3">
            Nav 1
        </div>
        <div class="col-6 p-3 text-end">
            <?php if (Store::adminLogado()) : ?>
                <i class="fas fa-user me-2">
                </i><?= $_SESSION['admin_utilizador'] ?>
                <span class="mx-3"> </span>|
                <a href="?a=admin_logout"><i class="fas fa-sign-outalt me-2"></i>Logout</a>
            <?php else : ?> <?php endif; ?> <?php ?>
        </div>
    </div>
</div>