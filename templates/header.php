<?php
    session_start();
?>
<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/override-bootstrap.css" rel="stylesheet">
    <title>Bookéo</title>
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap align-items-center justify-content-evenly py-3 mb-4 border-bottom">
        <div class="col-md-2 mb-2 mb-md-0">
            <a href="/" class="d-inline-flex link-body-emphasis text-decoration-none">
                <img src="assets/images/logo-bookeo.jpg" alt="Logo de Bookeo" width="90">
            </a>
        </div>

        <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
            <li><a href="<?php echo '/index.php?controller=page&action=home'?>" class="nav-link px-2 link-secondary">Accueil</a></li>
            <li><a href="<?php echo '/index.php?controller=book&action=list'?>" class="nav-link px-2">Livres</a></li>
            <li><a href="<?php echo '/index.php?controller=book&action=add'?>" class="nav-link px-2">Ajouts</a></li>
            <li><a href="<?php echo '/index.php?controller=book&action=edit'?>" class="nav-link px-2">Modifications</a></li>
            <li><a href="<?php echo '/index.php?controller=book&action=delete'?>" class="nav-link px-2">Suppressions</a></li>
        </ul>
    </header>