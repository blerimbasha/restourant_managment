<?php
/**
 * Created by PhpStorm.
 * User: blerimi_v
 * Date: 2/4/2019
 * Time: 1:06 PM
 */

namespace App\Controller;


use App\Entity\Restaurant;
use App\Form\SearchType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class SearchController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */

    public function searchAction(Request $request)
    {
        return $this->render('search.html.twig');
    }
}
