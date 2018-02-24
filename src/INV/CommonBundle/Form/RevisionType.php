<?php

namespace INV\CommonBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RevisionType extends EntityGetterType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('activo', CheckboxType::class,
                [
                    'label' => $this->display('activo'),
                    'required' => false,
                    'attr' => [
                        'checked' => $this->get('activo')
                    ]
                ]
            )
//            ->add('fechaEnSistema', TextType::class,
//                [
//                    'label' => $this->display('fechaEnSistema'),
//                    'attr' => [
//                        'class' => 'form-control',
//                        'value' => $this->getDateText($this->get('fechaEnSistema'))
//                    ]
//                ]
//            )
//            ->add('fechaExcel', TextType::class,
//                [
//                    'label' => $this->display('fechaExcel'),
//                    'attr' => [
//                        'class' => 'form-control',
//                        'value' => $this->getDateText($this->get('fechaExcel'))
//                    ]
//                ]
//            )
            ->add('excelUrl', TextType::class,
                [
                    'label' => $this->display('excelUrl'),
                    'attr' => [
                        'class' => 'form-control',
                        'value' => $this->get('excelUrl')
                    ]
                ]
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix() {
        return 'inv_commonbundle_revision';
    }
}
