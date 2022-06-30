<?php
require_once('conexao.php');

if ( !isset($_SESSION['usuario_logado']) && empty($_SESSION['usuario_logado']) &&
    !isset($_SESSION['usuario_logado']['id']) && empty($_SESSION['usuario_logado']['id']) && 
    !isset($_SESSION['usuario_logado']['nome']) && empty($_SESSION['usuario_logado']['nome']) &&
    !isset($_SESSION['usuario_logado']['email']) && empty($_SESSION['usuario_logado']['email']) ) {
        
        header("Location: login.php");
    exit();
}

include('./navbar.php');
include('./alertas.php');
$id = filter_input(INPUT_GET, 'id');

$query = "
SELECT 
    anuncios.id,
    anuncios.imagem,
    anuncios.preco,
    anuncios.descricao,
    anuncios.total_avaliacoes,
    anuncios.media_total,
    usuarios.nome,
    usuarios.telefone,
    usuarios.is_whatsapp
FROM
    anuncios
        INNER JOIN
    usuarios ON usuarios.id = anuncios.usuario_id
WHERE
    anuncios.id = " . $id;

$selec = mysqli_query($con, $query);

if ( mysqli_num_rows($selec) > 0 ) {
    $dado = mysqli_fetch_array($selec);
} else {
    $_SESSION['type'] = 'info';
    $_SESSION['message'] = 'Anúncio não localizado!';

    header("Location: index.php");
}
?>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<h1 class="text-center my-3">  <?php echo $dado['nome']; ?></h1>
				</div>
			</div>
				
			<div class="row">
				<div class="col-12 text-center">
					<img class="img-fluid" src="uploads/anuncios/<?php echo $dado['imagem']; ?>" alt="<?php echo $dado['nome']; ?>" />
				</div>
			</div>
			
			<div class="row mt-4">
				<div class="col-12">
					<div class="rating">
						<h1 class="product-description"><?php echo $dado['descricao']; ?></h1>
						<h4 class="price">R$<?php echo number_format($dado['preco'], 2, ',', '.'); ?></h4>						
						<?php
						
						$telefone = str_replace(['(', ') ', '-'], '', $dado['telefone']);
						
                        if ( $dado['telefone'] != '' ) {
                            if ( $dado['is_whatsapp'] == 1 ) {
                                echo '
                                    <a href="https://api.whatsapp.com/send?phone=55' . $telefone . '&text=Olá!%20Gostaria%20que%20contratar%20seu%20serviço.%20" target="_blank"> 
                                        <span  style="font-size:30px">	<i class="fa fa-whatsapp" aria-hidden="true"></i> ' . $dado['telefone'] . '</span>
                                    </a>
                                ';
                            } else {
                                echo '<span style="font-size:30px"><i class="fa fa-phone"></i> ' . $dado['telefone'] . '</span>';
                            }
                        }
						
						?>
					</div>
				</div>
			</div>

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="text-center my-3">Avalie sua experiência com <?php echo $dado['nome']; ?></h1>
                        </div>
                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col d-flex align-items-center justify-content-center">
                                    <?php
                                    if ( $dado['total_avaliacoes'] > 0 ) {
                                        ?>
                                        <div id="nota-clientes" class="avaliacao-box contratar-avaliacao divisor">
                                            <span class="rating">
                                                <i id="media_total_avaliacoes" class="fa fa-star" data-rating="<?php echo $dado['media_total']; ?>" aria-hidden="true"></i>
                                            </span>
                                            <?php
                                            $avaliacao_avaliacoes = ( $dado['total_avaliacoes'] == 1 ) ? 'Avaliação' : 'Avaliações';
                                            ?>
                                            <span class="rating-descricao"><?php echo number_format($dado['media_total'], 1); ?> (<?php echo $dado['total_avaliacoes'] . ' ' . $avaliacao_avaliacoes; ?>)</span>
                                        </div><!-- nota-clientes -->
                                        <?php
                                    } else
                                        echo '<span class="rating-descricao">0 avaliações</span>';
                                    ?>
                                </div>

                                <div class="col">
                                    <p>
                                        <div class="progress-label-left"><b>5</b> <i class="fa fa-star text-warning"></i></div>

                                        <?php
                                        $selec_5 = mysqli_query($con, "SELECT COUNT(nota) AS nota_5 FROM avaliacao WHERE servico_id = {$id} AND nota = 5");
                                        if ( mysqli_num_rows($selec_5) > 0 ) {
                                            $dado_5 = mysqli_fetch_array($selec_5);
                                            $total_5 = $dado_5['nota_5'];
                                        } else
                                            $total_5 = 0;
                                        ?>
                                        <div class="progress-label-right">(<span id="total_five_star_review"><?php echo $total_5; ?></span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                                        </div>
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>4</b> <i class="fa fa-star text-warning"></i></div>
                                        
                                        <?php
                                        $selec_4 = mysqli_query($con, "SELECT COUNT(nota) AS nota_4 FROM avaliacao WHERE servico_id = {$id} AND nota = 4");
                                        if ( mysqli_num_rows($selec_4) > 0 ) {
                                            $dado_4 = mysqli_fetch_array($selec_4);
                                            $total_4 = $dado_4['nota_4'];
                                        } else
                                            $total_4 = 0;
                                        ?>
                                        <div class="progress-label-right">(<span id="total_four_star_review"><?php echo $total_4; ?></span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                                        </div>               
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>3</b> <i class="fa fa-star text-warning"></i></div>
                                        
                                        <?php
                                        $selec_3 = mysqli_query($con, "SELECT COUNT(nota) AS nota_3 FROM avaliacao WHERE servico_id = {$id} AND nota = 3");
                                        if ( mysqli_num_rows($selec_3) > 0 ) {
                                            $dado_3 = mysqli_fetch_array($selec_3);
                                            $total_3 = $dado_3['nota_3'];
                                        } else
                                            $total_3 = 0;
                                        ?>
                                        <div class="progress-label-right">(<span id="total_three_star_review"><?php echo $total_3; ?></span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                                        </div>               
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>2</b> <i class="fa fa-star text-warning"></i></div>
                                        
                                        <?php
                                        $selec_2 = mysqli_query($con, "SELECT COUNT(nota) AS nota_2 FROM avaliacao WHERE servico_id = {$id} AND nota = 2");
                                        if ( mysqli_num_rows($selec_2) > 0 ) {
                                            $dado_2 = mysqli_fetch_array($selec_2);
                                            $total_2 = $dado_2['nota_2'];
                                        } else
                                            $total_2 = 0;
                                        ?>
                                        <div class="progress-label-right">(<span id="total_two_star_review"><?php echo $total_2; ?></span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                                        </div>               
                                    </p>
                                    <p>
                                        <div class="progress-label-left"><b>1</b> <i class="fa fa-star text-warning"></i></div>
                                        
                                        <?php
                                        $selec_1 = mysqli_query($con, "SELECT COUNT(nota) AS nota_1 FROM avaliacao WHERE servico_id = {$id} AND nota = 1");
                                        if ( mysqli_num_rows($selec_1) > 0 ) {
                                            $dado_1 = mysqli_fetch_array($selec_1);
                                            $total_1 = $dado_1['nota_1'];
                                        } else
                                            $total_1 = 0;
                                        ?>
                                        <div class="progress-label-right">(<span id="total_one_star_review"><?php echo $total_1; ?></span>)</div>
                                        <div class="progress">
                                            <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                                        </div>               
                                    </p>
                                </div>
                                
                                <div class="col d-flex align-items-center justify-content-center">
                                    <button type="button" name="add_review" id="add_review" class="btn btn-primary" data-toggle="modal" data-target="#review_modal">Avaliar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $selec_avaliacao = mysqli_query($con, "SELECT avaliacao.*, usuarios.nome FROM avaliacao INNER JOIN usuarios ON usuarios.id = avaliacao.usuario_id WHERE avaliacao.servico_id = {$id}");
            if ( mysqli_num_rows($selec_avaliacao) > 0 ) {
                ?>
                <div class="row mt-5">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h1 class="text-center my-3">Veja o que comentam sobre o serviço</h1>
                            </div>
                        
                            <div class="card-body">
                                <div class="row">
                                <ul class="list-group w-100">
                                    <?php
                                    while ( $dado_avaliacao = mysqli_fetch_array($selec_avaliacao) ) {
                                        if ( $dado_avaliacao['comentario'] != '' )
                                            echo '
                                            <li class="list-group-item">
                                                <p>
                                                    <strong>' . $dado_avaliacao['nome'] . '</strong> 
                                                    - <span class="comentario">Nota: ' . number_format($dado_avaliacao['nota']) . '</span>
                                                </p>
                                                ' . $dado_avaliacao['comentario'] . '
                                            </li>
                                            ';
                                    }
                                    ?>
                                </ul>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <?php
                }
            ?>
		</div>

        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="enviar-avaliacao" action="#" method="POST">
                        <div class="modal-header">
                            <h5 class="modal-title">Enviar avaliação <h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="retorno_inserir_avaliacao"></div>
                            <div class="avaliacao-box estrelas">
                                <input type="radio" id="cm_star-empty" name="nota" value="" />

                                <?php
                                for ( $i = 1; $i <= 5; $i++ ) {
                                    $ultimo = ( $i == 5 ) ? 'ultimo' : '';

                                    echo '
                                    <label for="cm_star-' . $i . '">
                                        <i class="fa"></i>
                                    </label>
                                    <input type="radio" id="cm_star-' . $i . '" name="nota" value="' . $i . '" class="' . $ultimo . '" />
                                    ';
                                }
                                ?>
                            </div>
                            <div class="form-group">
                                <textarea name="comentario" id="comentario" class="form-control" placeholder="Comente"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="form-group text-center mt-4">
                                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                                <button type="submit" class="btn btn-primary" id="save_review">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
<?php
    mysqli_close($con);
    
    include './footer.php';