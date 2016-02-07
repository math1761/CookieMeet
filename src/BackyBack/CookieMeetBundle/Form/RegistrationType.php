<?php

namespace BackyBack\CookieMeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


class RegistrationType extends AbstractType
{


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('firstname');
        $builder->add('name');
        $builder->add('address');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    public function getFirstName()
    {
        return $this->getBlockPrefix();
    }
    public function getName()
    {
        return $this->getBlockPrefix();
    }
    public function getAddress()
    {
        return $this->getBlockPrefix();
    }
}