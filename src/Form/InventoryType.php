<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 20/11/17
 * Time: 14:32
 */

namespace App\Form;

use App\Entity\Inventory;
use App\Entity\Material;
use App\Entity\Personne;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

use Symfony\Component\Validator\Tests\Fixtures\Entity;

class InventoryType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Inventory::class,]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('personne')
            ->add('material')
            ->add('numberOfItem')
            ->add('save', SubmitType::class, array("label" => 'Créer'))->getForm();
    }
}