<?php
/**
 * Created by PhpStorm.
 * User: blerimi_v
 * Date: 2/13/2019
 * Time: 10:06 PM
 */

namespace App\Controller;


use App\Entity\Bookings;
use App\Entity\UserNotifications;
use App\Form\GuestBookingType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class GuestController extends Controller
{
    /**
     * @Route("/booking", name="guest_booking")
     */

    public function bookingAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $booking = new UserNotifications();
        $applyBook = new Bookings();

        $form = $this->createForm(GuestBookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em->persist($booking);
            $em->flush();

//            $applyBook->setStatus(33);
//            $em->persist($applyBook);
//            $em->flush();
            $this->addFlash('success', 'You have booked, we will contact with you.');
            return $this->redirectToRoute('restaurants');
        }
        return $this->render('/Booking/guest_booking.html.twig', [
            'form' => $form->createView(),
            'request' => $request
        ]);
    }
}
