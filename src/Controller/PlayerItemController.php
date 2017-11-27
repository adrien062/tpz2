<?php

namespace App\Controller;

use App\Entity\Player;
use App\Entity\PlayerItem;

use App\Form\PlayerItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Tests\Fixtures\Entity;


/**
 * @Route("/playeritem")
 */
class PlayerItemController extends Controller
{

    /**
     * @Route("/new", name="app_playeritemcontroller_new")
     */
    function new(Request $request){
        $playerItem = $this->get(\App\Entity\PlayerItem::class);

        $form = $this->createForm(PlayerItemType::class, $playerItem);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $playerItem = $form->getData();
            $this->getDoctrine()->getManager()->persist($playerItem);
            $this->getDoctrine()->getManager()->flush();

            $router = $this->container->get('router');
            $url = $router->generate("app_playeritemcontroller_index");
            return new RedirectResponse($url, $status = 302);
        }
        else{
            return $this->render("PlayerItem/new.html.twig" ,["form" => $form->createView()]);
        }
    }

    /**
     * @Route("/edit", name="app_playeritemcontroller_edit")
     */
    function edit(Request $request){
        $p = $this->getDoctrine()->getManager()->getRepository(PlayerItem::class)->find(1);

        $form = $this->createForm(PlayerItemType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("PlayerItem/edit.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/index", name="app_playeritemcontroller_index")
     */
    function index(){
        $this->container->get("session")->getFlashBag()->add("info", "test");
        $players = $this->getDoctrine()->getManager()->getRepository(PlayerItem::class);
        return $this->render("PlayerItem/index.html.twig", ["playersItems" => $players->findAll()]);
    }
}