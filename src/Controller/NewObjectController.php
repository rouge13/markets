<?php


namespace App\Controller;


use App\Entity\CommentMarket;
use App\Form\CommentType;
use App\Service\FormsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NewObjectController extends AbstractController
{
    public function newObjectAction(Request $request, $name,$id, $userId)
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


            case 'comment':
                // 1) build the form
                $comment = new CommentMarket();
                $form = $this->createForm(CommentType::class, $comment);
                // 2) handle the submit (will only happen on POST)
                $form->handleRequest($request);

                if($form->isSubmitted()) {
                    $comment = $form->getData();
                    $comment->getUser($userId);
                    $comment->getMarket($id);

                    // 4) save the Comment!
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($comment);
                    $manager->flush();
                    $this->addFlash('info',"comment : ".$comment->getName()." well added");
                    return $this->redirectToRoute('home');

                }
                break;


//            case 'type':
//                $form = $this->createForm('App\Form\TypeType');
//                $form->handleRequest($request);
//                if($form->isSubmitted()) {
//                    $type = $form->getData();
//                    $manager = $this->getDoctrine()->getManager();
//                    $manager->persist($type);
//                    $manager->flush();
//                    $this->addFlash('info',"type : ".$type->getName()." well added");
//                    return $this->redirectToRoute('home');
//
//                }
//                break;



//            case 'stand':
//                $form = $this->createForm('App\Form\StandType');
//                $form->handleRequest($request);
//                if($form->isSubmitted()) {
//                    $file = $form->get('image')->getData();
//                    $stand = $form->getData();
//                    if($file) {
//                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
//                        $stand->setImage($newFilename);
//                        $manager = $this->getDoctrine()->getManager();
//                        $manager->persist($stand);
//                        $manager->flush();
//                        $this->addFlash('info',"stand : ".$stand->getName()." well added");
//                        return $this->redirectToRoute('home');
//                    }
//                }
//                break;
        }
        return $this->render('pages/public/newObject.html.twig', ["name" => $name, 'id' => $id,"userId" => $userId, "form" => $form->createView()]);
    }
}