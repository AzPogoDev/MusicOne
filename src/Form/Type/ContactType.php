<?php

namespace App\Form\Type;

use Misd\PhoneNumberBundle\Form\Type\PhoneNumberType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Model\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
            ])
            ->add('name', null, [
                'label' => 'Nom',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
            ])
            ->add('phone', PhoneNumberType::class, [
                'label' => 'Téléphone',
                'default_region' => 'FR'
            ])
            ->add('topic', ChoiceType::class, [
                'choices' => Contact::TOPIC,
                'label' => 'Sujet',
            ])
            ->add('envoyer', SubmitType::class, [
            'attr' => ['class' => 'btn'],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
