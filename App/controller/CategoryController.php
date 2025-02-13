<?php

namespace App\controller;

use App\entity\Category;
use App\repository\AuthorRepository;
use App\repository\CategoryRepository;
use Exception;

class CategoryController extends Controller
{
    public function route():void
    {
        try{
            if (isset($_GET['action']))
            {
                switch ($_GET['action']){
                    case 'show':
                        //J'affiche une catégorie.
                        $this->show();
                        break;
                    case 'list':
                        //J'affiche toutes les catégories.
                        $this->list();
                        break;
                    case 'add':
                        //J'ajoute une catégorie.
                        $this->add();
                        break;
                    case 'edit':
                        //Je modifie une catégorie.
                        $this->edit();
                        break;
                    case 'delete':
                        //Je supprime une catégorie.
                        $this->delete();
                        break;
                    default :
                        //Je génère 'une erreur
                        throw new Exception('L\'action proposée n\'existe pas.');
                        break;
                }
            } else {
                //On charge la page d'accueil.
                $this->home();
            }
        } catch(Exception $e){
            $error = [
                'error' => $e->getMessage()
            ];
            $this->render('error',$error);
        }
    }

    //Exemple d'appel depuis l'URL : http://localhost:7001/index.php?controller=category&action=show&id=2
    protected function show()
    {
        try {
            if (isset($_GET['id'])){

                //Conversion de la variable $_GET en un entier quelque soit sa valeur.
                $id=(int)$_GET['id'];

                $categoryRepository = new CategoryRepository();
                $category = $categoryRepository->findOneById($id);

                $this->render('category/show',['category'=>$category]);
            } else {
                throw new Exception('L\'identifiant n\'est pas renseigné dans les paramètres.');
            }
        } catch (Exception $e){
            $error = [
                'error' => $e->getMessage()
            ];
            $this->render('error',$error);
        }

    }

    public function list()
    {
        $categoryRepository = new CategoryRepository();
        $categories = $categoryRepository->findAll();
        return $categories;
    }

    protected function add()
    {
        if (isset($_POST['name'])){
            $category = new Category($_POST['name']);
            $categoryRepository = new CategoryRepository();
            $categoryRepository->add($category);
            $success = [
                'success' => "La nouvelle catégorie a bien été enregistrée dans la base de données."
            ];
            $this->render('success', $success);
            $this->render('book/add',[]);
        } else {
            $this->render('category/add',[]);
        }
    }

    protected function edit()
    {
        if (isset($_POST['category'])){
            $field='name';
            $value=$_POST['name'];
            $categoryRepository = new CategoryRepository();
            $categoryRepository->update($field,$value,$_POST['category']);
            $success = [
                'success'=>"La catégorie a bien été modifié dans la base de données."
            ];
            $this->render('success',$success);
            $this->render('book/edit',[]);
        } else {
        $this->render('category/edit');
        }
    }

    protected function delete()
    {
        if (isset($_POST['category'])){
            $categoryRepository = new CategoryRepository();
            $books=$categoryRepository->findBooksByCategory($_POST['category']);
            if (count($books)==0){
                $categoryRepository->delete($_POST['category']);
                $success = [
                    'success'=>"La catégorie a bien été supprimée dans la base de données."
                ];
                $this->render('success',$success);
                $this->render('book/delete',[]);
            } else {
                $error = [
                    'error'=>"La catégorie ne peut pas être supprimée car des livres lui sont affectés."
                ];
                $this->render('error',$error);
                $this->render('book/delete',[]);
            }
        } else {
        $this->render('category/delete');
        }
    }
}