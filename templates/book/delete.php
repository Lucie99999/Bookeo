<?php

$bookController = new \App\controller\BookController();
$books = $bookController->list();

?>
<h1>Suppression d'un livre</h1>
<div class="container d-flex align-items-center mb-4 p-0">
    <h6 class="m-0 pe-3">Vous souhaitez supprimer un auteur ? Supprimez-le ici :</h6>
    <a class="btn btn-primary" href="<?php echo '/index.php?controller=author&action=delete'?>">Suppression d'un auteur</a>
</div>
<div class="container d-flex align-items-center mb-4 p-0">
    <h6 class="m-0 pe-3">Vous souhaitez supprimer une catégorie ? Supprimez-la ici :</h6>
    <a class="btn btn-primary" href="<?php echo '/index.php?controller=category&action=delete'?>">Suppression d'une catégorie</a>
</div>
<form action="" method="POST">
    <div class="mb-3">
        <label for="book" class="form-label">Quel livre souhaitez-vous supprimer ?</label>
        <select name="book" id="book" class="form-select" required>
            <option value="">--Choisissez une option--</option>
            <?php
            foreach ($books as $book){?>
                <option value="<?php echo $book->getTitle();?>"><?php echo $book->getTitle();?></option>
            <?php } ?>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
