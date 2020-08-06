<?php

namespace App\Form;

use App\Entity\Pret;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class PretType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('bien_pret')
            //->add('user')
            ->add('date_debut', DateType::class,
            [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',],
                )

            ->add('date_fin', DateType::class,
            [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',])
            //->add('points_pret')
            ->add('Reserver ce bien', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pret::class,
        ]);
    }
}
