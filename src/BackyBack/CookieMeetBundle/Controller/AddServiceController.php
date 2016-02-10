<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackyBack\CookieMeetBundle\Form\AddServiceForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

/**
 * @Route("/addservice")
 * This is the documentation description of your method, it will appear
 * on a specific pane. It will read all the text until the first
 * annotation.
 *
 * @ApiDoc(
 *  resource=true,
 *  description="This is the homepage for the homepage view"
 *
 * )
 */
class AddServiceController extends Controller
{
    public function AddServiceAction()
    {
        $form = $this->AddServiceFormAction();
        return $this->render('BackyBackCookieMeetBundle:AddService:addme.html.twig', array('form' => $form->createView()));
    }

    public function AddServiceFormAction() {
        return $form = $this->createForm(AddServiceForm::class);
    }
}