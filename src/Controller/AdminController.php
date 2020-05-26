<?php


namespace App\Controller;


use App\Repository\ContactRepository;
use App\Repository\MarketRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends AbstractController
{
    public function adminAction(UserRepository $userRepository)
    {

        $users = $userRepository->findAll();
        //dump($users);

        return $this->render('pages/admin/home.html.twig' , [
            "users"=>$users
        ]);
    }

    public function showUsers(UserRepository $userRepository)
    {

        $users = $userRepository->findAll();

        return $this->render('pages/admin/home.html.twig' , [
            "users"=>$users
        ]);
    }

    public function showMessages(ContactRepository $contactRepository)
    {
        $messages = $contactRepository->findAll();

        return $this->render('pages/admin/home.html.twig' , [
            "messages"=>$messages
        ]);
    }

    public function showMarkets(Request $request  , MarketRepository $marketRepository){

        // build the form
        $searchMarketForm = $this->createForm('App\Form\SearchMarketType');
        $searchMarketForm->handleRequest($request);

        $markets = array();

        if($searchMarketForm->isSubmitted()  && $searchMarketForm->isValid() ){
            $criteria = $searchMarketForm->getData();


            foreach($criteria->getDay() as $day) {
                $market = $marketRepository->findByCityAndDay($criteria, $day);
                foreach ($market as $obj) {
                    dump($obj);
                    array_push($markets, $obj);
                }
            }
        }

        return $this->render(
            'pages/admin/home.html.twig', [
            "searchMarketForm" => $searchMarketForm->createView(),
            "markets"=>array_unique($markets, SORT_REGULAR)
        ]);
    }

}