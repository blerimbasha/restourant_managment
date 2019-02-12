<?php
/**
 * Created by PhpStorm.
 * User: blerimi_v
 * Date: 2/4/2019
 * Time: 1:06 PM
 */

namespace App\Controller;


use App\Entity\Restaurant;
use App\Form\RestaurantType;
use App\Form\SearchType;
use Knp\Component\Pager\PaginatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @Route("/search", name="search")
     */

    public function searchAction(Request $request)
    {
        $form = $this->createForm(SearchType::class);
        return $this->render('search.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
