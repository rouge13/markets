<?php


namespace App\Controller;


use App\Entity\User;
use App\Form\UpdateInformationUserType;
use App\Repository\MarketRepository;
use App\Repository\UserRepository;
use App\Service\FormsManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UpdateController extends AbstractController
{

    public function updateAction(Request $request,$name, $id, UserRepository $userRepository, UserPasswordEncoderInterface $passwordEncoder , MarketRepository $marketRepository){


        $form = null;
        $manager = $this->getDoctrine()->getManager();

        switch ($name) {
            case 'information':

                $user = $userRepository->find($id);
                $form = $this->createForm(UpdateInformationUserType::class, $user);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $file = $form->get('image')->getData();
                    $user = $form->getData();
                    $user->getRoles($this->getUser());
                    $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                    //dump et die du password
//                    dd($password);
                    $user->setPassword($password);
                    if($file) {
                        $newFilename = FormsManager::handleFileUpload($file, $this->getParameter('uploads'));
                        $user->setImage($newFilename);
                    }
                    $manager->persist($user);
                    $manager->flush();
                    return $this->redirectToRoute('home');
                }
                break;

            case 'market':
                $market = $marketRepository->find($id);
                $form = $this->createForm('App\Form\MarketType',$market);
                $form->handleRequest($request);
                if($form->isSubmitted()) {
                    $market = $form->getData();
                    $manager->persist($market);
                    $manager->flush();
                    return $this->redirectToRoute('home');
                }
                break;


        }
        return $this->render('pages/public/updateObject.html.twig',["id"=>$id, "name" =>$name ,"form"=>$form->createView()]);

    }


}

