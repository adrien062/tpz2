<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 27/11/17
 * Time: 14:53
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_indexcontroller_index")
     */
    function index(){

        return $this->render("Index/index.html.twig");
    }

}