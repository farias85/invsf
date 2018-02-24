<?php

namespace INV\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ActivoFijoType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rotulo')->add('descripcion')->add('valorCuc')->add('valorMn')->add('tasa')->add('depAcuCuc')->add('depAcuMn')->add('valorActualCuc')->add('valorActualMn')->add('responsableText')->add('estadoText')->add('fechaAlta')->add('fechaEstadoActual')->add('estado')->add('local')->add('responsable')->add('revision')->add('tipoActivo');
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'INV\CommonBundle\Entity\ActivoFijo'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'inv_commonbundle_activofijo';
    }


}
