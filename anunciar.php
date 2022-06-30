<?php
require_once('./operacoes.php');
include('./navbar.php'); 
require_once('./conexao.php');
?>
    <div class="container">
        <?php
        include './alertas.php';
        ?>
        <div class="row">
            <div class="col-12">
                <h2 class="text-center my-3"> Anunciar Seu Serviço</h2>

                <div class="d-flex justify-content-center">
                    <form action="acaoanunciar.php" method="POST" class="w-50" enctype="multipart/form-data">
                        <p class="mb-5">Todos os campos com <small class="text-danger">*</small> são obrigatórios.</p>
                        <div class="mb-3">
                            <label for="file" class="form-label">Procure sua imagem <small class="text-danger">*</small></label>
                            <input type="file" id="file" name="file" class="form-control" />
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Descrição do seu serviço <small class="text-danger">*</small></label>
                            <textarea name="descricao"  placeholder="descrição" cols="80" class="textarea" rows="15"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">Preço do serviço <small class="text-danger">*</small></label>
                            <input type="text" name="preco" class="form-control moeda" required placeholder="Preço do serviço" />
                        </div>
                        
                        <button class="btn btn-dark" type="submit" name="submit">Enviar anuncio</button>
                    </form>
                </div>
            </div>
        </div>
        
        <hr>
    <?php
    include './footer.php';