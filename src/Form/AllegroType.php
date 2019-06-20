<?php

namespace App\Form;

use App\Entity\AllegroCSV;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AllegroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'PLEASE CHOOSE NAME OF THAT FILE',
                'attr'=>[
                    'placeholder'=>'SELECT NAME',
                    'class'=>'form_control'
                ]
            ])
            ->add('allegro', FileType::class,[
                'mapped'=>false,
                'label'=>'Please upload a favorite image'
            ])
            ->add('Submit', SubmitType::class,[
                'attr'=>[
                    'class'=>'btn btn-success'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AllegroCSV::class,
        ]);
    }
}
