<?php

namespace BackyBack\CookieMeetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use BackyBack\CookieMeetBundle\Form\AddServiceForm;

class AddServiceController extends Controller
{
    public function AddServiceAction()
    {
        return $this->render('BackyBackCookieMeetBundle:AddService:addme.html.twig');
    }

    public function AddServiceFormAction($form) {
        return $form = $this->createForm(AddServiceForm::class);
    }
}