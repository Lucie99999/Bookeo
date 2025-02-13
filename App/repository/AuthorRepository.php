<?php

namespace App\repository;

use App\db\Mysql;
use App\entity\Author;
use PDO;

class AuthorRepository
{
    //Méthode qui permet de rechercher un auteur
    public function findOneById(int $id):?Author
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM author WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
        $author=$query->fetch(PDO::FETCH_ASSOC);

        $authorEntity = new Author();
        $authorEntity ->setId($author['id']);
        $authorEntity ->setFirstname($author['firstname']);
        $authorEntity ->setLastname($author['lastname']);

        return $authorEntity;
    }

    //Méthode qui permet de rechercher tous les livres
    public function findAll():?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM author");
        $query->execute();
        $authors=$query->fetchAll(PDO::FETCH_ASSOC);

        //Je construis un tableau d'objets Book.
        //J'initialise mon tableau.
        $arrayAuthor = [];
        foreach ($authors as $author) {
            $authorEntity = new Author($author['firstname'], $author['lastname']);
            $authorEntity->setId($author['id']);
            array_push($arrayAuthor, $authorEntity);
        }

        return $arrayAuthor;
    }

    //Méthode qui permet d'ajouter un livre.
    public function add(Author $authorEntity):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("INSERT INTO author(firstname, lastname) VALUES(:firstname, :lastname)");
        $query->bindValue(":firstname",$authorEntity->getFirstname(),PDO::PARAM_STR);
        $query->bindValue(":lastname",$authorEntity->getLastname(),PDO::PARAM_STR);
        $query->execute();
    }

    public function update($column,$value,$id):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("UPDATE author SET ".$column."=:value WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->bindValue(":value",$value,PDO::PARAM_STR);
        $query->execute();
    }

    public function findBooksByAuthor(int $id):?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM author JOIN book ON author.id=book.authorId WHERE author.id=:id;");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
        $books=$query->fetchAll(PDO::FETCH_ASSOC);

        return $books;
    }

    public function delete(int $id):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("DELETE FROM author WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
    }
}