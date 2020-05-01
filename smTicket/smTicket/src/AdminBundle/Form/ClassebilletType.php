<?php

namespace AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ClassebilletType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tarif', 'number',array("label"=>"Tarif de billet","attr" => array("class" => 'form-control input--withBorder ct-u-marginBottom10 input-focusMotive' )))
            ->add('classe', 'text',array("label"=>"Classe de billet","attr" => array("class" => 'form-control input--withBorder ct-u-marginBottom10 input-focusMotive' )))
            ->add('qntbillet', 'number',array("label"=>"Quantité de billet", "attr" => array("class" => 'form-control input--withBorder ct-u-marginBottom10 input-focusMotive')));
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AdminBundle\Entity\Classebillet'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'adminbundle_classebillet';
    }


}
