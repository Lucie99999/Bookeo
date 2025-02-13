<?php

namespace App\controller;

use App\entity\Author;
use App\repository\AuthorRepository;
use Exception;

class AuthorController extends Controller
{
    public function route():void
    {
        try{
            if (isset($_GET['action']))
            {
                switch ($_GET['action']){
                    case 'show':
                        //J'affiche un auteur.
                        $this->show();
                        break;
                    case 'list':
                        //J'affiche tous les auteurs.
                        $this->list();
                        break;
                    case 'add':
                        //J'ajoute un auteur.
                        $this->add();
                        break;
                    case 'edit':
                        //Je modifie un auteur.
                        $this->edit();
                        break;
                    case 'delete':
                        //Je supprime un auteur.
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

    //Exemple d'appel depuis l'URL : http://localhost:7001/index.php?controller=author&action=show&id=2
    protected function show()
    {
        try {
            if (isset($_GET['id'])){

                //Conversion de la variable $_GET en un entier quelque soit sa valeur.
                $id=(int)$_GET['id'];

                $authorRepository = new AuthorRepository();
                $author = $authorRepository->findOneById($id);

                $this->render('author/show',['author'=>$author]);
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
        $authorRepository = new AuthorRepository();
        $authors = $authorRepository->findAll();
        return $authors;
    }

    protected function add()
    {
        if (isset($_POST['firstname'])){
            $author = new Author($_POST['firstname'], $_POST['lastname']);
            $authorRepository = new AuthorRepository();
            $authorRepository->add($author);
            $success = [
                'success' => "Le nouvel auteur a bien été enregistré dans la base de données."
            ];
            $this->render('success', $success);
            $this->render('book/add',[]);
        } else {
            $this->render('author/add',[]);
        }
    }

    protected function edit()
    {
        if (isset($_POST['author'])){
            $i=1;
            $value="";
            foreach($_POST as $item) {

                //Je récupère la valeur du champ qui a été rempli.
                if ($i>1 & $item!==""){
                    $value = $item;
                }
                $i=$i+1;
            }
            //Je récupère le nom du champ qui a été modifié.
            for ($i=0; $i < count($_POST) ; $i++) {
                if (current($_POST)==$value){
                    $field=key($_POST);
                }
                next($_POST);
            }
            $authorRepository = new AuthorRepository();
            $authorRepository->update($field,$value,$_POST['author']);
            $success = [
                'success'=>"L'auteur a bien été modifié dans la base de données."
            ];
            $this->render('success',$success);
            $this->render('book/edit',[]);
        } else {
        $this->render('author/edit');
        }
    }

    protected function delete()
    {
        if (isset($_POST['author'])){
            $authorRepository = new AuthorRepository();
            $books=$authorRepository->findBooksByAuthor($_POST['author']);
            if (count($books)==0){
                $authorRepository->delete($_POST['author']);
                $success = [
                    'success'=>"L'auteur a bien été supprimé dans la base de données."
                ];
                $this->render('success',$success);
                $this->render('book/delete',[]);
            } else {
                $error = [
                    'error'=>"L'auteur ne peut pas être supprimé car des livres lui sont affectés."
                ];
                $this->render('error',$error);
                $this->render('book/delete',[]);
            }
        } else {
        $this->render('author/delete');
        }
    }
}