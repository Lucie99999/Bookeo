<?php

namespace App\repository;

use App\db\Mysql;
use App\entity\Category;
use PDO;

class CategoryRepository
{
    //Méthode qui permet de rechercher une catégorie de livres
    public function findOneById(int $id):?Category
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM type WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
        $category=$query->fetch(PDO::FETCH_ASSOC);

        $categoryEntity = new Category($category['name']);
        $categoryEntity ->setId($category['id']);

        return $categoryEntity;
    }

    //Méthode qui permet de rechercher toutes les catégories
    public function findAll():?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM type");
        $query->execute();
        $categories=$query->fetchAll(PDO::FETCH_ASSOC);

        //Je construis un tableau d'objets Category.
        //J'initialise mon tableau.
        $arrayCategory = [];
        foreach ($categories as $category) {
            $categoryEntity = new Category($category['name']);
            $categoryEntity->setId($category['id']);
            array_push($arrayCategory, $categoryEntity);
        }

        return $arrayCategory;
    }

    //Méthode qui permet d'ajouter un livre.
    public function add(Category $categoryEntity):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("INSERT INTO type(name) VALUES(:name)");
        $query->bindValue(":name",$categoryEntity->getName(),PDO::PARAM_STR);
        $query->execute();
    }

    public function update($column,$value,$id):void
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("UPDATE type SET ".$column."=:value WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_STR);
        $query->bindValue(":value",$value,PDO::PARAM_STR);
        $query->execute();
    }

    public function findBooksByCategory(int $id):?array
    {
        //Je fais un appel à ma base de données.
        $mysql = Mysql::getInstance();
        $pdo = $mysql->getPDO();

        //Je fais une requête préparée pour sécuriser l'accès aux données.
        $query=$pdo->prepare("SELECT * FROM type JOIN book ON type.id=book.categoryId WHERE type.id=:id;");
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
        $query=$pdo->prepare("DELETE FROM type WHERE id=:id");
        $query->bindValue(":id",$id,PDO::PARAM_INT);
        $query->execute();
    }
}