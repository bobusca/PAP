<div class="container">
    <div class="row my-5">
        <div class="col-12">
            <h3 class="text-center">Registro de Novo Cliente</h3>
            
            <form action="?a=criar_cliente" method="post">
                <!-- email campo obrigatório -->
                <div class="my-3">
                    <label>Email</label>
                    <input type="email" name="text_email" placeholder="Email" class="form-control" required>
                </div>
                <!-- password - senha 1 campo obrigatório -->
                <div class="my-3">
                    <label>Senha</label>
                    <input type="password" name="text_senha_1" placeholder="Senha" class="form-control" required>
                </div>
                <!-- password - senha 2 campo obrigatório -->
                <div class="my-3">
                    <label>Repetir a Senha</label>
                    <input type="password" name="text_senha_2" placeholder="Repetir a Senha" class="form-control" required>
                </div>
                <!-- Nome campo obrigatório-->
                <div class="my-3">
                    <label>Nome Completo</label>
                    <input type="text" name="text_nome_completo" placeholder="Nome Completo " class="form-control" required>
                </div>
                <!-- Morada campo obrigatório-->
                <div class="my-3">
                    <label>Morada</label>
                    <input type="text" name="text_morada" placeholder="Morada " class="form-control" required>
                </div>
                <!-- Cidade -campo obrigatório -->
                <div class="my-3">
                    <label>Cidade</label>
                    <input type="text" name="text_cidade" placeholder="Cidade " class="form-control" required>
                </div>
                <!-- Telefone -Não é Obrigatório, retirar required-->
                <div class="my-3">
                    <label>Telefone</label>
                    <input type="text" name="text_telefone" placeholder="Telefone " class="form-control">
                </div>
                <!-- Telefone -Não é Obrigatório, retirar required-->
                <div class="my-4">
                    <input type="submit" value="Criar Conta" class="btn btn-primary">
                </div>
                <?php
                
                // Deteta se existiu erro, senhas diferentes
                if (isset($_SESSION['erro'])) : ?>
                    <div class="alert alert-danger" text-center p-2>
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </div>
</div>