<h1>Ajout d'une catégorie</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Nom de la catégorie</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="container d-flex p-0">
        <button type="submit" class="btn btn-primary me-2">Valider</button>
        <a class="btn btn-primary" href="<?php echo '/index.php?controller=book&action=add'?>">Retour</a>
    </div>
</form>