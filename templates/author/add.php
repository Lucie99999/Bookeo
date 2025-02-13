<h1>Ajout d'un auteur</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="firstname" class="form-label">Prénom de l'auteur</label>
        <input type="text" class="form-control" id="firstname" name="firstname" required>
    </div>
    <div class="mb-3">
        <label for="lastname" class="form-label">Nom de l'auteur</label>
        <input type="text" class="form-control" id="lastname" name="lastname" required>
    </div>
    <div class="container d-flex p-0">
        <button type="submit" class="btn btn-primary me-2">Valider</button>
        <a class="btn btn-primary" href="<?php echo '/index.php?controller=book&action=add'?>">Retour</a>
    </div>
</form>
