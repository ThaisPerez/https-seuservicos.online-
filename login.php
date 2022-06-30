<?php
session_start();

include('./navbar.php');
?>
    <div class="container">
        <?php
        include('./alertas.php');
        ?>
        <div class="row">
            <div class="col-12">
                <h1 class="text-center my-3"> Login</h1>

                <div class="container d-flex justify-content-center">
                    <form action="acaologin.php" method="POST" class="w-30" >
                        <input type="text" name=" txtEmail" required placeholder="Digite seu email">
                        <br><br>
                        <input type="password"name=" txtSenha" required placeholder="Digite sua senha">
                        <br><br>
                        <button class="btn btn-dark" type="submit" name="submit">Entrar</button>
                        <a href="cadastro.php">Cadastrar</a>

                        <div class="container d-flex justify-content-center">
                        <a href="esquecisenha.php">Esqueceu sua senha?</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>

<?php     
    include './footer.php';