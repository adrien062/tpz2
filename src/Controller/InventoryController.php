<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 20/11/17
 * Time: 14:31
 */

namespace App\Controller;

use App\Entity\Inventory;

use App\Form\InventoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

class InventoryController extends Controller
{
    /**
     * @Route("/inventory/new", name="app_inventorycontroller_new")
     */
    function new(Request $request){

        $em = $this->getDoctrine()->getManager();
        $p = new Inventory();

        $form = $this->createForm(InventoryType::class, $p);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $p = $form->getData();

            $calculInventory = new \App\Calculate\Inventory($em);
            $calculInventory->setPerson($p->getPersonne());
            $calculInventory->setInventory($p);
            if($calculInventory->calcul()){
                $em->persist($p);
                $em->flush();
                $this->container->get("session")->getFlashBag()->add("success", "L'inventory a été créé");

            }
            else{
                $this->container->get("session")->getFlashBag()->add("erreur", "Le poids maximal depasse l'inventory");
            }
        }
        return $this->render("Inventory/new.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/inventory/edit/{p}", name="app_inventorycontroller_edit")
     */
    function edit(Request $request, Inventory $p){
        $form = $this->createForm(InventoryType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("Inventory/edit.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/inventory/index", name="app_inventorycontroller_index")
     */
    function index(){
        return $this->render("Inventory/index.html.twig", ["inventory" => []]);
    }
}