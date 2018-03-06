<?php

namespace INV\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivoFijoType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
//            ->add('rotulo')
//            ->add('descripcion')
//            ->add('valorCuc')
//            ->add('valorMn')
//            ->add('tasa')
//            ->add('depAcuCuc')
//            ->add('depAcuMn')
//            ->add('valorActualCuc')
//            ->add('valorActualMn')
//            ->add('responsableText')
//            ->add('estadoText')
//            ->add('fechaAlta')
//            ->add('fechaEstadoActual')
            ->add('estado', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('local', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('responsable', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
//            ->add('revision')
            ->add('tipoActivo', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('serie', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('marca', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('modelo', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('paisProcedencia', null, [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('fechaProduccion', BirthdayType::class, [

                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'INV\CommonBundle\Entity\ActivoFijo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'inv_commonbundle_activofijo';
    }


}
