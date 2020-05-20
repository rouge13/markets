<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homeAction(){
        return $this->render('pages/public/home.html.twig');
    }


    public function aboutAction(){
        return $this->render('/pages/public/about.html.twig');
    }

    public function loginAction(){
        return $this->render('pages/public/login.html.twig');
    }

    public function marketsAction(){
        return $this->render('pages/public/markets.html.twig');
    }

    public function marketAction(){
        return $this->render('pages/public/market.html.twig');

    }

    public function informationsAction(){
        return $this->render('pages/public/informations.html.twig');
    }
}