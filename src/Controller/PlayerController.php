<?php

namespace App\Controller;

use App\Entity\Player;

use App\Entity\PlayerItem;
use App\Form\PlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Tests\Fixtures\Entity;


/**
 * @Route("/player")
 */
class PlayerController extends Controller
{

    /**
     * @Route("/new", name="app_playercontroller_new")
     */
    function new(Request $request){
        $p = $this->get(\App\Entity\Player::class);

        $form = $this->createForm(PlayerType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();

            $router = $this->container->get('router');
            $url = $router->generate("app_playercontroller_index");
            return new RedirectResponse($url, $status = 302);
        }
        else{
            return $this->render("Player/new.html.twig" ,["form" => $form->createView()]);
        }
    }

    /**
     * @Route("/edit", name="app_playercontroller_edit")
     */
    function edit(Request $request){
        $p = $this->getDoctrine()->getManager()->getRepository(Player::class)->find(1);

        $form = $this->createForm(PlayerType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("Player/edit.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/index", name="app_playercontroller_index")
     */
    function index(){
        $this->container->get("session")->getFlashBag()->add("info", "test");
        $players = $this->getDoctrine()->getManager()->getRepository(Player::class);
        return $this->render("Player/index.html.twig", ["players" => $players->findAll()]);
    }
    
    /**
     * @Route("/player/{id}", name="app_playercontroller_playerindex")
     */
    function indexPlayer(Player $player){
       // $this->container->get("session")->getFlashBag()->add("info", "test");
        $playersItem = $this->getDoctrine()->getManager()->getRepository(PlayerItem::class);
        return $this->render("Player/player_index.html.twig", ["player" => $player, "playerItem" => $playersItem->findBy(["player" => $player])]);
    }
}