<?php

namespace App\Form;

use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class,[
                'attr'=>[
                    'placeholder'=>'Enter The Title',
                    'class'=>'custom_class'
                ]
            ])
            ->add('description', TextareaType::class,[
                'attr'=>[
                    'placeholder'=>'Enter The Description Here',
                    'class'=>'custom_class'
                ]
            ])
            ->add('my_files', FileType::class,[
                'mapped'=>false,
                'label'=>'Please upload a favorite image',
                'multiple'=>true
            ])
            ->add('category',EntityType::class, [
                    'class' => 'App\Entity\Category',
            ])
            ->add('submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
