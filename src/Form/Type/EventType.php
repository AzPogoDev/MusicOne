<?php

namespace App\Form\Type;

use App\Entity\Category;
use App\Entity\Event;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description', TextareaType::class)
            ->add('startAt', DateTimeType::class, [
                'input' => 'datetime_immutable'
            ])
            ->add('endAt', DateTimeType::class,[
                'input' => 'datetime_immutable'
            ])
            ->add('capacity', IntegerType::class)
            ->add('price', IntegerType::class)
            ->add('category', null, [

                'choice_label' => 'name'
            ])
            ->add('place', null, [
                'choice_label' => 'label'
            ])
            ->add('picture', UrlType::class)
            ->add('envoyer', SubmitType::class, [
                'attr' => ['class' => 'btn'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Event::class,
        ]);
    }
}
