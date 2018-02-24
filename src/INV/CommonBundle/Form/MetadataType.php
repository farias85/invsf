<?php

namespace INV\CommonBundle\Form;

use Symfony\Component\Form\FormBuilderInterface;

class MetadataType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('totalActivos')
            ->add('valorTotal')
            ->add('valorTotalMc')
            ->add('depAcuTotal')
            ->add('depAcuTotalMc')
            ->add('elaborado')
            ->add('responsable')
            ->add('revisado')
            ->add('revision');
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'inv_commonbundle_metadata';
    }


}
