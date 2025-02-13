<?php
$authorController = new \App\controller\AuthorController();
$authors = $authorController->list();
?>
<h1>Suppression d'un auteur</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="author" class="form-label">Quel auteur souhaitez-vous supprimer ?</label>
        <select name="author" id="author" class="form-select">
            <option value="">--Choisissez une option--</option>
            <?php
            $i=0;
            foreach ($authors as $author){
                $i=$i+1;?>
                <option value="<?php echo $author->getId();?>"><?php echo $author->getFirstname().' '.$author->getLastname();?></option>
            <?php } ?>
        </select>
    </div>
    <div class="container d-flex p-0">
        <button type="submit" class="btn btn-primary me-2">Valider</button>
        <a class="btn btn-primary" href="<?php echo '/index.php?controller=book&action=delete'?>">Retour</a>
    </div>
</form>