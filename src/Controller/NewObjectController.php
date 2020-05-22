<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NewObjectController extends AbstractController
{
    public function newObjectAction(Request $request, $name)
    {
        $form = null;
        switch ($name) {
            case 'market':
                $form = $this->createForm('App\Form\MarketType');
                $form->handleRequest($request);
                if ($form->isSubmitted()) {
                    $market = $form->getData();
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($market);
                    $manager->flush();
                    $this->addFlash('info', "market : " . $market->getName() . " well added");
                    return $this->redirectToRoute('home');

                }
                break;

        }
        return $this->render('pages/public/newMarket.html.twig', ["name" => $name, "form" => $form->createView()]);
    }
}