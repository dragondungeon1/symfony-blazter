<?php

namespace App\Form;

use App\Entity\KlasHasLes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KlasHasLesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('vervallen')
            ->add('opvang')
            ->add('klas_id')
            ->add('les_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => KlasHasLes::class,
        ]);
    }
}
