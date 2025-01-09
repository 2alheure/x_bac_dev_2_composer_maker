<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;

class ArticleType extends AbstractType {
    public function buildForm(FormBuilderInterface $builder, array $options): void {
        $builder
            ->add('titre', TextType::class, [
                'constraints' => [
                    new Assert\NotBlank,
                ],
            ])
            ->add('contenu', TextareaType::class, [
                'constraints' => [
                    new Assert\NotBlank,
                    new Assert\Length([
                        'min' => 10,
                    ]),
                ],
            ])
            ->add('date', DateType::class, [
                'widget' => 'single_text',
                'constraints' => [
                    new Assert\NotBlank,
                    new Assert\LessThanOrEqual('today'),
                    new Assert\Date,
                ],
            ])
            ->add('image', UrlType::class, [
                'constraints' => [
                    new Assert\NotBlank,
                    new Assert\Url,
                ],
            ])
            ->add('envoyer', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
