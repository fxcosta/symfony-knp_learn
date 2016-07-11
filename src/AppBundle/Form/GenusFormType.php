<?php
/**
 * Created by PhpStorm.
 * User: webdown
 * Date: 11/07/2016
 * Time: 13:31
 */

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GenusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('speciesCount')
            ->add('funFact');
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }
}