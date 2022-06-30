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
                   <h4 class="text-center my-3"> Digite seu email </h4>

                <div class="container d-flex justify-content-center">
                    <form action="email.php" method="POST" class="w-30" >
                        <input type="text" name=" email" required placeholder="Digite seu email">
                        <br><br>
                        <button class="btn btn-dark" type="submit" name="submit">Solicitar nova senha</button>

                        <div class="container d-flex justify-content-center">
                            <a href="login.php">Voltar para login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php

    include './footer.php';
