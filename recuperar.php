<?php
require_once('./conexao.php');
require_once('./operacoes.php');
include('./navbar.php');

if ( isset($_GET['token']) && !empty($_GET['token']) ) {
    $token = filter_input(INPUT_GET, 'token');
    $data_hora = date('Y-m-d H:i:s');

    $selec = mysqli_query($con, "SELECT * FROM token where token = '$token' AND usado = 0 AND '$data_hora' BETWEEN data_hora_inicial AND data_hora_final");

    if ( mysqli_num_rows($selec) > 0 ) {
		$dado = mysqli_fetch_array($selec);
        ?>
        <div class="container">
            <?php
            include './alertas.php';
            ?>
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center my-3"> Definir nova senha</h2>

                    <div class="d-flex justify-content-center">
                        <form action="acaorecuperar.php" method="POST" class="w-50">
                            <p class="mb-5">Todos os campos com <small class="text-danger">*</small> são obrigatórios.</p>
                            <div class="mb-3">
                                <label for="file" class="form-label">Insira uma nova senha <small class="text-danger">*</small></label>
                                <input type="password" name="senha" placeholder="Insira uma nova senha" required>
                            </div>
                            
							<input type="hidden" name="token" value="<?php echo $dado['token']; ?>" />
                            <button class="btn btn-dark" type="submit" name="submit">Alterar a Senha</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <hr>
        <?php
        include './footer.php';
    } else {
        $_SESSION['type'] = 'danger';
        $_SESSION['message'] = 'E-mail não cadastrado!';

        header("Location: login.php");
    }
}  else {
    $_SESSION['type'] = 'info';
    $_SESSION['message'] = 'Campos obrigatórios não foram preenchidos!';

    header("Location: login.php");
}