<?php

namespace App\Controller;

use App\Entity\Item;

use App\Form\ItemType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Tests\Fixtures\Entity;


/**
 * @Route("/item")
 */
class ItemController extends Controller
{

    /**
     * @Route("/new", name="app_itemcontroller_new")
     */
    function new(Request $request){
        $p = $this->get(\App\Entity\Item::class);


        $form = $this->createForm(ItemType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();

            $router = $this->container->get('router');
            $url = $router->generate("app_itemcontroller_index");
            return new RedirectResponse($url, $status = 302);
        }
        else{
            return $this->render("Item/new.html.twig" ,["form" => $form->createView()]);
        }
    }

    /**
     * @Route("/edit", name="app_itemcontroller_edit")
     */
    function edit(Request $request){
        $p = $this->getDoctrine()->getManager()->getRepository(Item::class)->find(1);

        $form = $this->createForm(ItemType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("Player/edit.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/index", name="app_itemcontroller_index")
     */
    function index(){
        $this->container->get("session")->getFlashBag()->add("info", "test");
        $players = $this->getDoctrine()->getManager()->getRepository(Item::class);
        return $this->render("Item/index.html.twig", ["items" => $players->findAll()]);
    }
}