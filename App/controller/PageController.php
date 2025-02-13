<?php

namespace App\controller;

use Exception;

class PageController extends Controller
{
    public function route():void
    {
        try{
            if (isset($_GET['action']))
            {
                switch ($_GET['action']){
                    case 'about':
                        //J'appelle la méthode about().
                        $this->about();
                        break;
                    case 'home':
                        //J'appelle la méthode home().
                        $this->home();
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

    protected function about()
    {
        $params=[
            'test'=>'abc',
            'test2'=>'def'
        ];

        $this->render('page/about',$params);
    }

    protected function home()
    {
        $this->render('page/home');
    }
}