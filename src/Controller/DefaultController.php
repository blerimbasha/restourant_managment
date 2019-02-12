<?php

namespace App\Controller;

use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(Request $request, PaginatorInterface $paginator)
    {
        $em = $this->getDoctrine()->getManager();

        if ($request->query->get('search') != '') {
            $restaurants = $em->getRepository('App:Restaurant')->findAllRestaurants(
                $request->query->get('search')['region'],
                $request->query->get('search')['name'],
                $request->query->get('search')['from_date'],
                $request->query->get('search')['to_date'],
                $request

            );
            $pagination = $paginator->paginate(
                $restaurants,
                $request->query->getInt('page', 1),
                5
            );

            return $this->render('restaurants/index.html.twig', [
                'restaurants' => $pagination,
            ]);
        }

        $regions = $em->getRepository('App:Regions')->findAll();
        return $this->render('default/index.html.twig', [
            'regions' => $regions,
        ]);
    }
}
