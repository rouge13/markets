<?php


namespace App\Controller;


use App\Entity\CommentMarket;
use App\Entity\Stand;
use App\Entity\Type;
use App\Form\CommentType;
use App\Form\StandType;
use App\Form\TypeType;
use App\Repository\MarketRepository;
use App\Repository\StandRepository;
use App\Service\FormsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class NewObjectController extends AbstractController
{

    public function newObjectAction(Request $request, $name,$id,MarketRepository $marketRepository, StandRepository $standRepository)
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
                $market = $marketRepository->find($id);
                $comment = new CommentMarket();
                $form = $this->createForm(CommentType::class, $comment);
                // 2) handle the submit (will only happen on POST)
                $form->handleRequest($request);

                if($form->isSubmitted()) {
                    $comment = $form->getData();
                    $comment->setMarket($market);
                    $comment->setUser($this->getUser());
                    // 4) save the Comment!
                    $manager = $this->getDoctrine()->getManager();
                    $manager->persist($comment);
                    $manager->flush();
                    return $this->redirectToRoute('home');

                }
                break;



            case 'stand':
                $market = $marketRepository->find($id);
                $stand = new Stand();
                $form = $this->createForm(StandType::class, $stand);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $stand = $form->getData();
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $stand->setImage($newFilename);
                        $stand->addMarket($market);
                        $manager = $this->getDoctrine()->getManager();
                        $manager->persist($stand);
                        $manager->flush();
                        return $this->redirectToRoute('home');
                    }
                }
                break;




            case 'type':
                $stand = $standRepository->find($id);
                $type = new Type();
                $form = $this->createForm(TypeType::class, $type);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $type = $form->getData();
                    $manager = $this->getDoctrine()->getManager();
                    $type->addStand($stand);
                    $manager->persist($type);
                    $manager->flush();
                    $this->addFlash('info',"type : ".$type->getName()." well added");
                    return $this->redirectToRoute('home');

                }
                break;



        }
        return $this->render('pages/public/newObject.html.twig', ["name" => $name, "form" => $form->createView()]);
    }




}