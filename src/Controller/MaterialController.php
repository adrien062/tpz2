<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 20/11/17
 * Time: 13:17
 */

namespace App\Controller;


use App\Entity\Material;

use App\Form\MaterialType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

class MaterialController extends Controller
{
    /**
     * @Route("/material/new", name="app_materialcontroller_new")
     */
    function new(Request $request){

        $p = new Material();

        $form = $this->createForm(MaterialType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("Material/new.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/material/edit/{p}", name="app_materialcontroller_edit")
     */
    function edit(Request $request, Material $p){
        $form = $this->createForm(MaterialType::class, $p);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $p = $form->getData();
            $this->getDoctrine()->getManager()->persist($p);
            $this->getDoctrine()->getManager()->flush();
        }
        return $this->render("Material/edit.html.twig" ,["form" => $form->createView()]);
    }

    /**
     * @Route("/material/index", name="app_materialcontroller_index")
     */
    function index(){
        $materials = $this->getDoctrine()->getManager()->getRepository(Material::class);
        return $this->render("Material/index.html.twig", ["materials" => $materials->findAll()]);
    }
}