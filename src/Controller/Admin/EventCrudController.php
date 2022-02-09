<?php

namespace App\Controller\Admin;

use App\Entity\Event;
use App\Entity\Place;
use App\Form\AddressType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class EventCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Event::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('Name'),
            AssociationField::new('category'),
            AssociationField::new('place'),
            DateField::new('startAt'),
            DateField::new('endAt'),
            NumberField::new('price'),
            NumberField::new('capacity'),
            ImageField::new('picture')->setUploadDir("/"),
            TextEditorField::new('description'),
            AssociationField::new('owner')
        ];
    }

}
