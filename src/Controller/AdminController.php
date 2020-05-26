<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    public function adminAction()
    {

        return $this->render('pages/admin/home.html.twig');
    }

}