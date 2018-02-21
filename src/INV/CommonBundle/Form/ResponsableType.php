<?php

namespace INV\CommonBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ResponsableType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('nombre', TextType::class,
                [
                    'label' => $this->display('nombre'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('nombre')
                    ]
                ]
            )
            ->add('email', EmailType::class,
                [
                    'label' => $this->display('email'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('email')
                    ]
                ]
            )
            ->add('descripcion', TextareaType::class,
                [
                    'label' => $this->display('descripcion'),
                    'data' => $this->get('descripcion'),
                    'required' => false,
                    'attr' => [
                        'class' => 'form-control',
                        'rows' => 4,
                    ]
                ]
            );
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'inv_commonbundle_responsable';
    }
}
