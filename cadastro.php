<?php
session_start();

include('./navbar.php');
?>
<div class="container">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <?php
                include('./alertas.php');
                ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h1 class="text-center my-3"> Cadastro </h1>
            <div class="container d-flex justify-content-center">
                <form method="POST" action="acaousuario.php">
                <input type="text" name=" txtNome" required placeholder="Digite seu nome">
                <br><br>
                <input type="text" name="telefone" class="telefone" required placeholder="Telefone">
                <br><br>
                <select class="w-100" name="is_whatsapp" id="is_whatsapp" required>
                    <option value="">É WhatsApp?</option>
                    <option value="1">Sim</option>
                    <option value="0">Não</option>
                </select>
                <br><br>
                <input type="email" name=" txtEmail" required placeholder="Digite seu email">
                <br><br>
                <input type="password"name=" txtSenha" required placeholder="Digite sua senha">
                <br><br>
                <button>Entrar</button>
            </div>
        </div>
    </div>
</div>

<?php
include './footer.php';