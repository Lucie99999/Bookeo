<?php

namespace App\controller;

use Exception;

class Controller{

    public function route():void
    {
        try {
            if (isset($_GET['controller']))
            {
                switch ($_GET['controller']){
                    case 'page':
                        //Je charge le controller Page.
                        $pageController = new PageController();
                        $pageController->route();
                        break;
                    case 'book':
                        //Je charge le controller Book.
                        $bookController = new BookController();
                        $bookController->route();
                        break;
                    case 'author':
                        //Je charge le controller Author.
                        $authorController = new AuthorController();
                        $authorController->route();
                        break;
                    case 'category':
                        //Je charge le controller Category.
                        $categoryController = new CategoryController();
                        $categoryController->route();
                        break;
                    default :
                        //Je génère une erreur.
                        throw new Exception('Le contrôleur n\'existe pas.');
                        break;

                }
            } else {
                //J'affiche la page d'accueil.
                $pageController = new PageController();
                $pageController->home();
            }
        } catch (Exception $e) {
            $erreur = [
                'error'=>$e->getMessage(),
            ];
            $this->render('error',$erreur);
        }

    }

    protected function render(string $path,array $params = []):void
    {
        $filepath = _ROOTPATH_.'/templates/'.$path.'.php';

        try {
            if (!file_Exists($filepath))
            {
                //Génération d'une erreur
                throw new Exception("Fichier non trouvé :".$filepath);

            } else {
                //Fonction PHP qui crée une variable pour chacune des lignes du tableau passé en paramètre.
                extract($params);
                require_once $filepath;
            }
        } catch (Exception $e){
            $erreur = [
                'error'=>$e->getMessage(),
            ];
            $this->render('error',$erreur);
        }
    }
}
?>