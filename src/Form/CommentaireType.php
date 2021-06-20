<?php

namespace App\Form;

use App\Entity\Commentaire;
use Doctrine\DBAL\Types\TextType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('contenu', CKEditorType::class,
                ['label' => 'Votre commentaire',
                    'attr' => ['class' => 'form-control']
                ])
            ->add('date_creation')
            ->add('article', TextType::class,
                ['label' => 'Article',
                    'attr' => ['class' => 'form-control']
                ])
            ->add('id_utilisateur', TextType::class,
                ['label' => 'Utilisateur',
                    'attr' => ['class' => 'form-control']
                ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commentaire::class,
        ]);
    }
}
