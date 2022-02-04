<div class="container">
    <div class="row my-5">
        <div class="col-sm-4 offset-sm-4">
            <div>
                <h3 class="text-center">LOGIN</h3>
                <form action="?a=login_submit" method="post">
                    <div class="my-3">
                        <label>Utilizador:</label>
                        <input type="email" name="text_utilizador" id="" placeholder="Utilizador" required class="form-control">
                    </div>
                    <div class="my-3">
                        <label>Password::</label>
                        <input type="password" name="text_password" id="" placeholder="Password" required class="form-control">
                    </div>
                    <div class="my-3">
                        <input type="submit" value="Login" class="btn btn-primary">
                    </div>
                </form>
                <?php if (isset($_SESSION['erro'])) : ?>
                    <div class="alert alert-danger text-center">
                        <?= $_SESSION['erro'] ?>
                        <?php unset($_SESSION['erro']) ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>