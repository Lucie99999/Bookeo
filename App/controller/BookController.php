<?php

namespace App\controller;

require 'vendor/autoload.php';

use App\entity\Book;
use App\repository\BookRepository;
use Exception;

class BookController extends Controller
{
    public function route():void
    {
        try{
            if (isset($_GET['action']))
            {
                switch ($_GET['action']){
                    case 'show':
                        //J'affiche un livre.
                        $this->show();
                        break;
                    case 'list':
                        //J'affiche tous les livres.
                        $this->list();
                        break;
                    case 'add':
                        //J'ajoute un livre.
                        $this->add();
                        break;
                    case 'edit':
                        //Je modifie un livre.
                        $this->edit();
                        break;
                    case 'delete':
                        //Je supprime un livre.
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

    protected function show()
    {
        try {
            if (isset($_GET['id'])){

                //Conversion de la variable $_GET en un entier quelque soit sa valeur.
                $id=(int)$_GET['id'];

                $bookRepository = new BookRepository();
                $book = $bookRepository->findOneById($id);

                $this->render('book/show',['book'=>$book]);
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
        $bookRepository = new BookRepository();
        $books = $bookRepository->findAll();
        $columns = $bookRepository->findColumns();
        if ($_GET['action']=="list"){
            $this->render('book/list',['book'=>$books]);
        } else if ($_GET['action']=="delete"){
            return $books;
        } else if ($_GET['action']=="edit"){
            return ['listBooks'=>$books,'listColumns'=>$columns];
        }
    }

    protected function add()
    {
        if (isset($_POST['title'])){
            $book = new Book($_POST['title'], $_POST['author'], $_POST['description'],
                $_POST['category'], $_POST['image']);
            $bookRepository = new BookRepository();
            $bookRepository->add($book);
            $success = [
                'success' => "Le livre a bien été enregistré dans la base de données."
            ];
            $this->render('success', $success);
        } else {
            $this->render('book/add',[]);
        }
    }

    protected function edit()
    {
        if (isset($_POST['field'])){
            $tr = new \Stichoza\GoogleTranslate\GoogleTranslate();
            $tr->setSource('fr');
            $tr->setTarget('en');
            $field=$tr->translate($_POST['field']);
            if ($field=="category"||$field=="author"){
                $field=$field.'Id';
            }
            $i=1;
            $value="";
            foreach($_POST as $item) {
                //Je récupère le champ qui a été rempli.
                if ($i>2 & $item!==""){
                    $value = $item;
                }
                $i=$i+1;
            }
            $bookRepository = new BookRepository();
            $bookRepository->update($field,$value,$_POST['book']);
            $success = [
                'success'=>"Le livre a bien été modifié dans la base de données."
            ];
            $this->render('success',$success);
        }
        $this->render('book/edit');
    }

    protected function delete()
    {
        if (isset($_POST['book'])){
            $bookRepository = new BookRepository();
            $bookRepository->delete($_POST['book']);
            $success = [
                'success'=>"Le livre a bien été supprimé de la base de données."
            ];
            $this->render('success',$success);
        }
        $this->render('book/delete',[]);
    }

}
