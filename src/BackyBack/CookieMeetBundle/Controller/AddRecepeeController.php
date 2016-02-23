<?php
/**
 * Created by PhpStorm.
 * User: mathieu
 * Date: 13/02/2016
 * Time: 22:37
 */

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackyBack\CookieMeetBundle\Form\AddRecepeeForm;
use Symfony\Component\HttpFoundation\Request;
use BackyBack\CookieMeetBundle\Entity\AddRecepee;
use Symfony\Component\HttpFoundation\Response;

class AddRecepeeController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     *
     * This fonction flushes the form to the database
     */
    public function AddRecepeeAction(Request $request)
    {
        $recepee = new AddRecepee();

        $my_errors = $this->handleErrorsAction($recepee);
        $form = $this->createForm(AddRecepeeForm::class, $recepee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($recepee);
            $em->flush();
            return $this->redirectToRoute('backy_back_cookie_meet_home');
        }
        return $this->render('BackyBackCookieMeetBundle:AddRecepee:addrecepee.html.twig', array('form' => $form->createView()));
    }

    /**
     * @param $recepee
     * @return Response
     * This fonction handles the errors with the powerful tool "validator"
     */
    private function handleErrorsAction($recepee)
    {
        $validator = $this->get('validator');
        $errors = $validator->validate($recepee);

        if (count($errors) > 0) {
            $errorsString = (string)$errors;
            return new Response($errorsString);
        }
    }

}