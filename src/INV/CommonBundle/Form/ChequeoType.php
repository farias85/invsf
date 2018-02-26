<?php

namespace INV\CommonBundle\Form;

use Doctrine\ORM\EntityRepository;
use INV\CommonBundle\Util\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class ChequeoType extends AbstractType {
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
        $builder
            ->add('asunto', TextType::class,
                [
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('tipoResultado', EntityType::class, array(
                'class' => Entity::TIPO_RESULTADO,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.id', 'ASC');
                },
                'attr' => [
                    'class' => 'form-control'
                ],
            ))
            ->add('observacion', TextareaType::class,
                [
                    'label' => 'Observación',
                    'required' => true,
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
        return 'inv_commonbundle_chequeo';
    }


}
