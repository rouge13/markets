<?php


namespace App\Controller;


use App\Entity\Contact;
use App\Repository\MarketRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DefaultController extends AbstractController
{
    public function homeAction(MarketRepository $marketRepository){
        $markets = $marketRepository->findBy(array(),array(),4);
        return $this->render('pages/public/home.html.twig',[
            'markets'=>$markets
        ]);
    }

    public function aboutAction(Request $request){
        $contact= new Contact();
        $contactForm = $this->createForm('App\Form\ContactType',$contact);
        $contactForm->handleRequest($request);
        if($contactForm->isSubmitted()){
            $contact = $contactForm->getData();


            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();
            return $this->redirect($request->getUri());
        }
        return $this->render('/pages/public/about.html.twig', ["contactForm" => $contactForm->createView()]);
    }

    public function loginAction(){
        return $this->render('pages/public/login.html.twig');
    }




    public function marketAction($id,MarketRepository $marketRepository){
        $market=$marketRepository->findOneBy([
            'id'=>$id
        ]);
        return $this->render('pages/public/market.html.twig',[
            'market'=>$market
        ]);


    }

    public function informationsAction(){
        return $this->render('pages/public/informations.html.twig');
    }

    public function marketsAction(Request $request  , MarketRepository $marketRepository){

        // build the form
        $searchMarketForm = $this->createForm('App\Form\SearchMarketType');
        $searchMarketForm->handleRequest($request);

        $markets = array();

        if($searchMarketForm->isSubmitted()  && $searchMarketForm->isValid() ){
            $criteria = $searchMarketForm->getData();

//            foreach($criteria->getDay() as $day){
//                dump($day->getName());
//           }


            foreach($criteria->getDay() as $day) {
                $market = $marketRepository->findByCityAndDay($criteria, $day);
                //dump($market);
                foreach ($market as $obj) {
                    dump($obj);
                    array_push($markets, $obj);
                }
                //dump($markets);
            }
        }

        return $this->render(
            'pages/public/markets.html.twig', [
            "searchMarketForm" => $searchMarketForm->createView(),
            "markets"=>array_unique($markets, SORT_REGULAR)
        ]);

    }
}





