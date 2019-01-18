<?php
/**
 * Created by PhpStorm.
 * User: blerimi_v
 * Date: 1/14/2019
 * Time: 11:15 PM
 */

namespace App\Controller;


use App\Entity\Restaurant;
use App\Form\RestaurantType;
use phpDocumentor\Reflection\Types\This;
use App\Form\UserType;
use App\Repository\RestaurantTypeRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\Pagination\PaginationInterface;
use Knp\Component\Pager\PaginatorInterface;
use function MongoDB\BSON\toJSON;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Restaurants
 * @package App\Controller
 * @Route("/restaurants")
 */
class Restaurants extends AbstractController
{
    /**
     * @Route("/", name="restaurants")
     */
    public function index(Request $request, PaginatorInterface $paginator )
    {
        $repository = $this->getDoctrine()->getManager();
        $restaurants = $repository->getRepository('App:Restaurant')->findByExampleField();

        $paginaton = $paginator->paginate(
            $restaurants,
            $request->query->getInt('page',1),
            10
        );

        return $this->render('restaurants/index.html.twig',[
            'restaurants' => $paginaton
        ]);
    }

    /**
     * @Route("/new", name="new_restaurant")
     */
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $restaurant = new Restaurant();

        $form = $this->createForm(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($restaurant);
            $em->flush();
            $this->addFlash('success','Your changes were saved!');
            return $this->redirectToRoute('restaurants');
        }
        return $this->render('restaurants/new.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/edit/{id}", name="edit_restaurant")
     */
    public function editAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $restaurant = $em->getRepository('App:Restaurant')->find($id);
        $form = $this->createFormBuilder(RestaurantType::class, $restaurant);
        $form->handleRequest($request);

//        if (!$restaurant) {
//            $this->addFlash('danger','Your Restaurant not exist');
//            return $this->redirectToRoute('restaurants');
//        }

        if ($form->isSubmitted() && $form->isValid()) {
            dump('sdasd');die;
            $em->flush();
        }
        return $this->render('restaurants/edit.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("/remove/{id}", name="remove_restaurant")
     */
    public function removeAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $restaurant = $em->getRepository('App:Restaurant')->find($id);
        if (!$restaurant) {
            $this->addFlash('danger','Your Restaurant not exist');
            return $this->redirectToRoute('restaurants');
        }
        $em->remove($restaurant);
        $em->flush();
        $this->addFlash('success','Your Restaurant has been deleted');
        return $this->redirectToRoute('restaurants');
    }

}
