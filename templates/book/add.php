<?php

$authorController = new \App\controller\AuthorController();
$authors = $authorController->list();
$categoryController = new \App\controller\CategoryController();
$categories = $categoryController->list();

?>
<h1>Ajout d'un livre</h1>
<div class="container d-flex align-items-center mb-4 p-0">
    <h6 class="m-0 pe-3">L'auteur du livre que vous souhaitez ajouter n'existe pas ? Ajoutez-le ici :</h6>
    <a class="btn btn-primary" href="<?php echo '/index.php?controller=author&action=add'?>">Ajout d'un auteur</a>
</div>
<div class="container d-flex align-items-center mb-4 p-0">
    <h6 class="m-0 pe-3">La catégorie du livre que vous souhaitez ajouter n'existe pas ? Ajoutez-le ici :</h6>
    <a class="btn btn-primary" href="<?php echo '/index.php?controller=category&action=add'?>">Ajout d'une catégorie</a>
</div>
<form action="" method="POST">
    <div class="mb-3">
        <label for="title" class="form-label"><h2>Titre</h2></label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="mb-3">
        <label for="author" class="form-label"><h2>Auteur</h2></label>
        <select name="author" id="author" class="form-select" required>
            <option value="">--Choisissez une option--</option>
            <?php
                $i=0;
                foreach ($authors as $author){
                    $i=$i+1;?>
                <option value="<?php echo $i;?>"><?php echo $author->getFirstname().' '.$author->getLastname();?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="category" class="form-label"><h2>Catégorie</h2></label>
        <select name="category" id="category" class="form-select" required>
            <option value="">--Choisissez une option--</option>
            <?php
                $j=0;
                foreach ($categories as $category){
                    $j=$j+1;?>
                    <option value="<?php echo $j;?>"><?php echo ucfirst($category->getName());?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label"><h2>Description</h2></label>
        <textarea class="form-control" id="description" name="description" rows="6" required></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label"><h2>Image</h2></label>
        <input type="text" class="form-control" id="image" name="image" required>
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
