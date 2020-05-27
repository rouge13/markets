<?php


namespace App\Controller;


use App\Repository\ContactRepository;
use App\Repository\MarketRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class DeleteController extends AbstractController
{

    public function deleteAction(Request $request,$name, $id , MarketRepository $marketRepository , UserRepository $userRepository , ContactRepository $contactRepository){

        $manager = $this->getDoctrine()->getManager();

        switch ($name) {
            case 'market':
                $market = $marketRepository->find($id);
                $manager->remove($market);
                $manager->flush();
                return $this->redirectToRoute('dashboard');
                break;

            case 'user':
                $user = $userRepository->find($id);
                $manager->remove($user);
                $manager->flush();
                return $this->redirectToRoute('dashboard');
                break;

            case 'message':
                $message = $contactRepository->find($id);
                $manager->remove($message);
                $manager->flush();
                return $this->redirectToRoute('dashboard');
                break;



        }
        return $this->redirectToRoute('home');

    }

}