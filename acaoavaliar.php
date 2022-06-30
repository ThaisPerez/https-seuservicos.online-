<?php
include('./conexao.php');

if ( isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['nota']) && !empty($_POST['nota']) ) {
    $usuario_id = $_SESSION['usuario_logado']['id'];
	$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
	$nota = filter_input(INPUT_POST, 'nota', FILTER_SANITIZE_NUMBER_INT);
	$comentario = addslashes(filter_input(INPUT_POST, 'comentario'));
    $data = date('Y-m-d H:i:s');

    $query = "
	SELECT 
		total_avaliacoes, media_total
	FROM
		anuncios
	WHERE
		id = " . $id;
		
	$selec = mysqli_query($con, $query);

	if ( mysqli_num_rows($selec) > 0 ) {
		$dado = mysqli_fetch_array($selec);
	} else {
        $retorno = [
            'type' => 'info',
            'message' => 'Anúncio não localizado!'
        ];
		
        echo json_encode($retorno);
	}

    $cadastrar = mysqli_query($con,"INSERT INTO avaliacao (usuario_id, servico_id, nota, comentario, data) VALUES ('$usuario_id', '$id', '$nota', '$comentario', '$data')");
    
    if ( $cadastrar ) {
        $select = mysqli_query($con, "SELECT SUM(nota) AS nota FROM avaliacao WHERE servico_id = " . $id);

        if ( mysqli_num_rows($selec) > 0 ) {
            $resultado = mysqli_fetch_array($select);
            $soma_notas = $resultado['nota'];
        } else
            $soma_notas = 0;

        $total_avaliacoes = $dado['total_avaliacoes'] + 1;
        $media = round($soma_notas / $total_avaliacoes, 1);

        $atualizar = mysqli_query($con,"UPDATE anuncios SET total_avaliacoes = '$total_avaliacoes', media_total = '$media' WHERE id = " . $id);

        $retorno = [
            'type' => 'success',
            'message' => 'Avaliação cadastrada com sucesso!'
        ];
		
        echo json_encode($retorno);
    } else {
        $retorno = [
            'type' => 'danger',
            'message' => 'Não foi possível avaliar!'
        ];
		
        echo json_encode($retorno);
    }
} else {
    $retorno = [
        'type' => 'info',
        'message' => 'Campos obrigatórios não foram preenchidos!'
    ];
    
    echo json_encode($retorno);
}