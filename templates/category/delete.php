<?php
$categoryController = new \App\controller\CategoryController();
$categories = $categoryController->list();
?>
<h1>Suppression d'une catégorie</h1>
<form action="" method="POST">
    <div class="mb-3">
        <label for="category" class="form-label">Catégorie</label>
        <select name="category" id="category" class="form-select">
            <option value="">--Choisissez une option--</option>
            <?php
            $j=0;
            foreach ($categories as $category){
                $j=$j+1;?>
                <option value="<?php echo $category->getId();?>"><?php echo ucfirst($category->getName());?></option>
            <?php } ?>
        </select>
    </div>
    <div class="container d-flex p-0">
        <button type="submit" class="btn btn-primary me-2">Valider</button>
        <a class="btn btn-primary" href="<?php echo '/index.php?controller=book&action=edit'?>">Retour</a>
    </div>
</form>
