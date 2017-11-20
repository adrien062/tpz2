<?php

namespace App\Controller;

use App\Entity\Personne;

use App\Form\PersonneType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

class PersonneController extends Controller
{

    /**
     * @Route("/personne/new", name="app_personnecontroller_new")
     */
    function new(Request $request){
        $p = new Personne();

        $form = $this->createForm(PersonneType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();

            $router = $this->container->get('router');
            $url = $router->generate("app_personnecontroller_index");
            return new RedirectResponse($url, $status = 302);
        }
        else{
            return $this->render("Personne/new.html.twig" ,["form" => $form->createView()]);
        }
    }

    /**
     * @Route("/personne/edit", name="app_personnecontroller_edit")
     */
    function edit(Request $request){
        $p = $this->getDoctrine()->getManager()->getRepository(Personne::class)->find(1);

        $form = $this->createForm(PersonneType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("Personne/edit.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/personne/index", name="app_personnecontroller_index")
     */
    function index(){
        $this->container->get("session")->getFlashBag()->add("info", "test");
        $personnes = $this->getDoctrine()->getManager()->getRepository(Personne::class);
        return $this->render("Personne/index.html.twig", ["personnes" => $personnes->findAll()]);
    }
}