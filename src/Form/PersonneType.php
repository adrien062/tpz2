<?php
namespace App\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

use App\Entity\Personne;
use Symfony\Component\Validator\Tests\Fixtures\Entity;

class PersonneType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefault(['data_class' => Personne::class,]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('age', TextType::class)
            ->add('createdAt', DateType::class)
            ->add('visible')
            ->add('save', SubmitType::class, array("label" => 'Créer'))->getForm();
    }
}