<?php
// Fonctionnalité de cette classe : dialoguer avec la base de données.

namespace App\repository;

use App\db\Mysql;
use App\entity\Book;
use PDO;

class BookRepository
{
    //Méthode qui permet de rechercher un livre
    public function findOneById(int $id):?Book
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM book WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
        $book=$query->fetch(PDO::FETCH_ASSOC);

        $bookEntity = new Book($book['title'],$book['authorId'],$book['description'],
            $book['categoryId'],$book['image']);
        $bookEntity ->setId($book['id']);

        return $bookEntity;
    }

    //Méthode qui permet de rechercher tous les livres
    public function findAll():?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM book");
        $query->execute();
        $books=$query->fetchAll(PDO::FETCH_ASSOC);

        //Je construis un tableau d'objets Book.
        //J'initialise mon tableau.
        $arrayBook = [];
        foreach ($books as $book) {
            $bookEntity = new Book($book['title'],$book['authorId'],$book['description'],
                $book['categoryId'],$book['image']);
            $bookEntity->setId($book['id']);
            array_push($arrayBook, $bookEntity);
        }

        return $arrayBook;
    }

    public function findColumns():?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SHOW COLUMNS FROM book");
        $query->execute();
        $columns=$query->fetchAll(PDO::FETCH_ASSOC);

        return $columns;
    }

    //Méthode qui permet de récupérer les nom et prénom d'un auteur à partir d'un identifiant de la table book
    public function findAuthor(int $id):?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT firstname, lastname FROM author JOIN book 
    ON author.id=book.authorId WHERE book.authorId=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
        $author=$query->fetch(PDO::FETCH_ASSOC);

        return $author;
    }

    //Méthode qui permet de récupérer la catégorie à partir d'un identifiant de la table book
    public function findCategory(int $id)
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT name FROM type JOIN book 
    ON type.id=book.categoryId WHERE book.categoryId=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
        $category=$query->fetch(PDO::FETCH_ASSOC);

        return $category;
    }

    //Méthode qui permet d'ajouter un livre.
    public function add(Book $bookEntity):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("INSERT INTO book(title,description,image,categoryId,authorId) 
VALUES(:title,:description,:image,:categoryId,:authorId)");
        $query->bindValue(":title",$bookEntity->getTitle(),PDO::PARAM_STR);
        $query->bindValue(":description",$bookEntity->getDescription(),PDO::PARAM_STR);
        $query->bindValue(":image",$bookEntity->getImage(),PDO::PARAM_STR);
        $query->bindValue(":categoryId",$bookEntity->getCategoryId(),PDO::PARAM_INT);
        $query->bindValue(":authorId",$bookEntity->getAuthorId(),PDO::PARAM_INT);
        $query->execute();
    }

    public function delete(string $title):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("DELETE FROM book WHERE title=:title");
        $query->bindValue(":title",$title,PDO::PARAM_STR);
        $query->execute();

    }

    public function update($column,$value,$title):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("UPDATE book SET ".$column."=:value WHERE title=:title");
        $query->bindValue(":title",$title,PDO::PARAM_STR);
        $query->bindValue(":value",$value,PDO::PARAM_STR);
        $query->execute();
    }

}