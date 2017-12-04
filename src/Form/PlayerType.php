<?php
namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PlayerType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Player::class,]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('age', IntegerType::class)
            ->add('country', ChoiceType::class, array(
                'choices' => array(
                    'Belgique' => "Belgique",
                    'France' => "France"
                )
            ))
            ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
            ->add('save', SubmitType::class, array("label" => 'Créer'))->getForm();
    }

    public function onPreSetData(FormEvent $event){
        $form = $event->getForm();
        $player = $event->getData();

        if($player->getId() !== null){
            $form->remove("name");
        }
    }
}