<?php

namespace AdminBundle\Form;

        use Symfony\Component\Form\AbstractType;
        use Symfony\Component\Form\Extension\Core\Type\CollectionType;
        use Symfony\Component\Form\FormBuilderInterface;
        use Symfony\Component\OptionsResolver\OptionsResolver;
        use AdminBundle\Entity\EntityRepository;
        use Doctrine\DBAL\Types\TextType;
        use Symfony\Bridge\Doctrine\Form\Type\EntityType;
        use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
        use Symfony\Component\Form\Extension\Core\Type\FileType;
        use Symfony\Component\Form\Extension\Core\Type\SubmitType;
        use Symfony\Component\Form\Extension\Core\Type\DateType;
        use AdminBundle\Form\ClassebilletType;
        use AdminBundle\Entity\Classebillet;



        class evenementType extends AbstractType {

        /**
         * {@inheritdoc}
         */
        public function buildForm(FormBuilderInterface $builder, array $options) {
     
            $builder
            ->add('titreEvenement', 'text',array("label"=>"Titre de l'événement"))
            ->add('file')
            ->add('lieuEvenement', 'text',array("label"=>"Lieu"))
           
            ->add('dateDebutEvenement', 'date', array("label"=>"Date de début", 'widget' => 'single_text'))
            ->add('heureDebutEvenement', 'time', array("label"=>"Heure de début", 'widget' => 'single_text'))        
            ->add('dateFinEvenement', 'date', array("label"=>"Date de Fin", 'widget' => 'single_text'))
            ->add('heureFinEvenement', 'time', array("label"=>"heure de fin", 'widget' => 'single_text'))        
            ->add('descriptionEvenement', 'textarea',array("label"=>"Description de l'événement",'required'   => false))
            ->add('ville', ChoiceType::class, array(
                    'placeholder' => 'Choose Ville',

                    'choices' => array(
                        'Ariana' => 'Ariana',
                        'Ben Arous' => 'Ben Arous',
                        'Béja' => 'Béja',
                        'Bizerte' => 'Bizerte',
                        'Gabes' => 'Gabes',
                        'Jendouba' => 'Jendouba',
                        'Kairouan' => 'Kairouan',
                        'Kesserine' => 'Kesserine',
                        'Kebili' => 'Kebili',
                        'La Manouba' => 'La Manouba',
                        'Le Kef' => 'Le Kef',
                        'Mahdia' => 'Mahdia',
                        'Sfax' => 'Sfax',
                        'Sidi Bouzid' => 'pub_cote',
                        'Silana' => 'Sidi Bouzid',
                        'Sousse' => 'Sousse',
                        'Jendouba' => 'Jendouba',
                        'Tataouine' => 'Tataouine',
                        'Tozer' => 'Tozer',
                        'Tunis' => 'Tunis',
                        'Zaghouan' => 'Zaghouan',
                        'Nabeul' => 'Nabeul',
                    ),

                )
            );

            $builder->add('categorie', 'entity', array(
                "label"=>"Categorie",
                'required' => true,
                'class'    => 'AppBundle:Categorie',
                'property' => 'libelleCategorie',
                'multiple' => false,
                'query_builder' => function(\AppBundle\Repository\CategorieRepository $r) {
                    return $r->getSelectList();
                },
                         ))
            ->add('Classebillets', 'collection', array(
                'label' => false ,
                'type' => new ClassebilletType(),
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false))
            ;

        }

        /**
         * {@inheritdoc}
         */
        public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
        'data_class' => 'AdminBundle\Entity\Evenement'
        ));
        }

        /**
         * {@inheritdoc}
         */
        public function getBlockPrefix() {
        return 'adminbundle_evenement';
        }

        }
