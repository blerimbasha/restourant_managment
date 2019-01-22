<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $regions = $em->getRepository('App:Regions')->findAll();
        return $this->render('default/index.html.twig', [
            'regions' => $regions,
            'request' => $request->query->get('search')
        ]);
    }
}
