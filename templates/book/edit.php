<?php

require 'vendor/autoload.php';

$authorController = new \App\controller\AuthorController();
$authors = $authorController->list();
$categoryController = new \App\controller\CategoryController();
$categories = $categoryController->list();
$bookController = new \App\controller\BookController();
extract($bookController->list());

?>
<h1>Modification d'un livre</h1>
<div class="container d-flex align-items-center mb-4 p-0">
    <h6 class="m-0 pe-3">Vous souhaitez modifier un auteur ? Modifiez-le ici :</h6>
    <a class="btn btn-primary" href="<?php echo '/index.php?controller=author&action=edit'?>">Modification d'un auteur</a>
</div>
<div class="container d-flex align-items-center mb-4 p-0">
    <h6 class="m-0 pe-3">Vous souhaitez modifier une catégorie ? Modifiez-la ici :</h6>
    <a class="btn btn-primary" href="<?php echo '/index.php?controller=category&action=edit'?>">Modification d'une catégorie</a>
</div>
<form action="" method="POST">
    <div class="mb-3">
        <label for="book" class="form-label">Quel livre souhaitez-vous modifier ?</label>
        <select name="book" id="book" class="form-select" required>
            <option value="">--Choisissez une option--</option>
            <?php
            foreach ($listBooks as $book){?>
                <option value="<?php echo $book->getTitle();?>"><?php echo $book->getTitle();?></option>
            <?php } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="field" class="form-label">Quel champ souhaitez-vous modifier ?</label>
        <select name="field" id="field" class="form-select" required>
            <option value="">--Choisissez une option--</option>
            <?php
            foreach ($listColumns as $column){
                $tr = new \Stichoza\GoogleTranslate\GoogleTranslate();
                $tr->setSource('en');
                $tr->setTarget('fr');
                if ($column['Field']!=="id"){
                    if (substr($column['Field'], -2)!=="Id"){
                    ?>
                        <option value="<?php echo $tr->translate($column['Field']);?>"><?php echo $tr->translate(ucfirst($column['Field']));?></option>
            <?php
                    } else {
                        ?>
                        <option value="<?php echo $tr->translate(substr($column['Field'], 0, -2));?>"><?php echo $tr->translate(ucfirst(substr($column['Field'], 0, -2)));?></option>
            <?php
                    }
                }
             } ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="title" class="form-label">Titre</label>
        <input type="text" class="form-control" id="title" name="title">
    </div>
    <div class="mb-3">
        <label for="author" class="form-label">Auteur</label>
        <select name="author" id="author" class="form-select">
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
        <label for="category" class="form-label">Catégorie</label>
        <select name="category" id="category" class="form-select">
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
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="6"></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="text" class="form-control" id="image" name="image">
    </div>
    <button type="submit" class="btn btn-primary">Valider</button>
</form>
