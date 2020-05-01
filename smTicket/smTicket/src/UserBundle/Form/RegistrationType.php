<?php



namespace UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
class RegistrationType extends AbstractType
{



    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom', 'text',array("label"=>"Prenom", "attr" => array("class" => 'form-control input--withBorder ct-u-marginBottom10 input-focusMotive')))
            ->add('adresse', 'text',array("label"=>"Adresse", "attr" => array("class" => 'form-control input--withBorder ct-u-marginBottom10 input-focusMotive')))
            ->add('tel', 'number',array("label"=>"Téléphone", "attr" => array("class" => 'form-control input--withBorder ct-u-marginBottom10 input-focusMotive')))



        ;
    }



    public function getParent()
    {
        return 'fos_user_registration';
    }
    public function getName()
    {
        return 'user_registration';
    }
}
