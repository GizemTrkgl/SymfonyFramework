<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\House;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

class HouseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class,[
                'class' => Category::class,
                'choice_label' => 'title',
            ])
            ->add('title')
            ->add('keywords')
            ->add('description')

            ->add('image', FileType::class,[
                'label' => 'House Main Image',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                       // 'mimeTypeMessage' => 'Please upload a valid Image File',
                    ])
                ],
            ])
            ->add('price')
            ->add('area')
            ->add('rooms')
            ->add('address')
            ->add('phone')
            ->add('fax')
            ->add('email')
            ->add('country', ChoiceType::class, [
                'choices' => [
                    'Turkiye' => 'Turkiye',
                    'Germany' => 'Germany',
                    'France' => 'France'],
    ])
            ->add('city', ChoiceType::class, [
              'choices' => [
        'Istanbul' => 'Istanbul',
        'Ankara' => 'Ankara',
        'Izmir' => 'Izmir'],
    ])
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'True' => 'True',
                    'False' => 'False'],
            ])
            ->add('location')
            ->add('detail', CKEditorType::class, array(
                'config' => array(
                    'uiColor' =>'#ffffff',
                    //...
                ),
            ))
           // ->add('created_at')
            //->add('updated_at')

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => House::class,
        ]);
    }
}
