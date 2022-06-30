<?php
include('./conexao.php');
include('./navbar.php'); 
?>
<div class="container">
    <?php 
    include('./alertas.php');
    $query = "
    SELECT 
        anuncios.id,
        anuncios.imagem,
        anuncios.preco,
        anuncios.descricao,
        usuarios.nome AS nome
    FROM
        anuncios
            INNER JOIN
        usuarios ON usuarios.id = anuncios.usuario_id";

    if ($result = mysqli_query($con, $query)) {
        echo '<div class="row row-cols-3 g-4 my-5">';
        
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
           <div class="col-3 my-3">
                <div class="card">
                    <img src="uploads/anuncios/<?php echo $row["imagem"]; ?>" class="card-img-top img-fluid" alt="...">
                    <div class="card-body">
                        <p> <?php echo $row["nome"]; ?> </p>
                        <p><?php echo ($row["descricao"]); ?> </p>
                        <p> A partir de R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?> </p>
                    </div>
                    <div class="card-footer">
                    <a href="contratar.php?id=<?php echo $row["id"]; ?>&usuario=<?php echo $row["nome"]; ?>" class="btn btn-primary">Contratar Serviço</a>
                    </div>
                </div>
            </div>
        <?php
        }
        echo '</div>';
    }

    mysqli_close($con);
    
    include './footer.php';