<?php


namespace App\Controller;


use App\Service\FormsManager;
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

            case 'type':
                $form = $this->createForm('App\Form\TypeType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $type = $form->getData();
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($type);
                    $manager->flush();
                    $this->addFlash('info',"type : ".$type->getName()." well added");
                    return $this->redirectToRoute('home');

                }
                break;

            case 'comment':
                $form = $this->createForm('App\Form\CommentType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $comment = $form->getData();
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $comment->setImage($newFilename);
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($comment);
                        $manager->flush();
                        $this->addFlash('info',"comment : ".$comment->getName()." well added");
                        return $this->redirectToRoute('home');
                    }
                }
                break;

            case 'stand':
                $form = $this->createForm('App\Form\StandType');
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $stand = $form->getData();
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $stand->setImage($newFilename);
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($stand);
                        $manager->flush();
                        $this->addFlash('info',"stand : ".$stand->getName()." well added");
                        return $this->redirectToRoute('home');
                    }
                }
                break;
        }
        return $this->render('pages/public/newObject.html.twig', ["name" => $name, "form" => $form->createView()]);
    }
}