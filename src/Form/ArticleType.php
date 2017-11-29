<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Tag;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // FIXME: Ajouter les champs firstname, lastname, email, birthday

        $builder
            ->add('title',TextType::class)
            ->add('content',TextareaType::class)
            ->add('tags',
                EntityType::class,
                [
                    'class' => Tag::class,
                    'choice_label' => 'name',
                    'multiple' => true,
                    'expanded' => true,
                ])
            ->add(
                'save',
                SubmitType::class,
                array('label' => 'Créer')
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // FIXME: ajouter la configuration du for
        $resolver->setDefaults(array("data_class" => Article::class));

    }
}
