<main class="container-fluid d-flex justify-content-around flex-wrap">

    <?php
    $i = 1;
    foreach ($book as $book) {
        $categoryId=$book->getCategoryId();
        $authorId=$book->getAuthorId();
        $join=new \App\repository\BookRepository();
        $author=$join->findAuthor($authorId);
        $category=$join->findCategory($categoryId);
        ?>
        <div class="card my-2" style="width: 18rem;">
            <img src="<?php echo ('/uploads/books/'.$book->getImage());?>" class="card-img-top" alt="Photo du livre">
            <div class="card-body">
                <h5 class="card-title"><?php echo ($i.' - '.$book->getTitle()); ?></h5>
                <h6>Catégorie : <?php echo ucfirst($category['name'])?></h6>
                <h6>Auteur : <?php echo $author['firstname'].' '.$author['lastname']; ?></h6>
                <p class="card-text"><?php echo substr($book->getDescription(),0,50).'...'; ?></p>
                <a href="<?php echo ('/index.php?controller=book&action=show&id='.$book->getId());?>" class="btn btn-primary">Voir le détail</a>
            </div>
        </div>

    <?php
    $i = $i + 1;
    } ?>

</main>

