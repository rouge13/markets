<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function home(){
        return $this->render('pages/public/home.html.twig');
    }


    public function about(){
        return $this->render('/pages/public/about.html.twig');
    }

    public function login(){
        return $this->render('pages/login.html.twig');
    }

    public function markets(){
        return $this->render('pages/markets.html.twig');
    }

    public function market(){
        return $this->render('pages/market.html.twig');

    }

    public function informations(){
        return $this->render('pages/informations.html.twig');
    }
}