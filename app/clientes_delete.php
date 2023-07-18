<?php

require_once('inc/config.php');
require_once('inc/api_functions.php');


if(!isset($_GET['id'])){
    header("Location: clientes.php");
    exit;
}

$id_cliente = $_GET['id'];

if(isset($_GET['confirm']) && $_GET['confirm'] == 'true'){
    api_request('delete_client', 'GET', ['id' => $id_cliente]);
    header("Location: clientes.php");
    exit;
}


$results = api_request('get_client', 'GET', ['id' => $id_cliente]);

if(count($results['data']['results']) == 0){
    header("Location: clientes.php");
    exit;
}

if($results['data']['status'] == 'SUCCESS'){
    $cliente = $results['data']['results'][0];
} else {
    $cliente = [];
}

if(empty($cliente)){
    header("Location: clientes.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="pt">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Consumidora - Clientes</title>
    <link rel="stylesheet" href="assets/bootstrap/bootstrap.min.css">

</head>

<body>

    <?php include('inc/nav.php') ?>

    <section class="container">
        <div class="row">
            <div class="col p-5">

                <h5 class="text-center">
                    Deseja eliminar o cliente <strong><?= $cliente['nome'] ?></strong>
                </h5>

                <div class="text-center mt-3">
                    <a href="clientes.php" class="btn btn-secondary">Não</a>
                    <a href="clientes_delete.php?id=<?= $cliente['id_cliente'] ?>&confirm=true" class="btn btn-primary">Sim</a>
                </div>

            </div>
        </div>
    </section>


    <script src="assets/bootstrap/bootstrap.bundle.min.js"></script>
</body>

</html>