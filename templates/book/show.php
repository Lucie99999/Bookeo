<?php
$categoryId=$book->getCategoryId();
$authorId=$book->getAuthorId();
$join=new \App\repository\BookRepository();
$author=$join->findAuthor($authorId);
$category=$join->findCategory($categoryId);
?>
<div class="row align-items-center g-5 py-5">
    <div class="col-10 col-sm-8 col-lg-6">
        <img src="/uploads/books/<?php echo $book->getImage();?>" class="d-block mx-lg-auto img-fluid" alt="Bootstrap Themes" width="400" loading="lazy">
    </div>
    <div class="col-lg-6">
        <h1 class="display-5 fw-bold lh-1 mb-3"><?php echo $book->getTitle();?></h1>
        <h3>Catégorie : <?php echo ucfirst($category['name']);?></h3>
        <h3>Auteur : <?php echo $author['firstname'].' '.$author['lastname'];?></h3>
        <p class="lead"><?php echo $book->getDescription();?></p>
    </div>
</div>