<?php

namespace BackyBack\CookieMeetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class AddServiceForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plateName')
            ->add('plateCategory', ChoiceType::class, array(
                'choices' => array(
                'Type de cuisine' => null,
                'Spécialités Française' => true,
                'Pizza' => true,
                'Japonais' => true,
                'Chinois' => true,
                'Indien-Pakistanais' => true,
                'Libanais' => true,
                'Italien' => true,
                'Espagnol' => true,
                'Casher' => true,
                'Bio' => true
            ),
            'choices_as_values' => true,
            ))
            ->add('platePrice', 'genemu_jqueryrating')
            ->add('plateExcerpt', TextareaType::class,
                array('attr' => array('class' => 'myTextarea'),
            'required' => false))
            ->add('save', SubmitType::class);
    }

    public function getBlockPrefix()
    {
        return 'app_add_service_form';
    }

    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
