<?php
/**
 * Created by PhpStorm.
 * User: blerimi_v
 * Date: 1/14/2019
 * Time: 11:15 PM
 */

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class Restaurants extends AbstractController
{
    /**
     * @Route("/restaurants", name="res")
     */
    public function index()
    {

        return $this->render('restaurants/index.html.twig');
    }
}
