<?php
namespace App\Form;

use App\Entity\Player;
use Doctrine\DBAL\Types\FloatType;
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
            ->add('role', ChoiceType::class, array(
                'choices' => Player::PLAYER_ROLES
            ))
            ->add('ajouterMoney', null, array("mapped" => false))
            ->add('ajouterExperience', null, array("mapped" => false))
            ->addEventListener(FormEvents::PRE_SET_DATA, array($this, 'onPreSetData'))
            ->addEventListener(FormEvents::PRE_SUBMIT, array($this, 'onPreSubmitData'))
            ->add('save', SubmitType::class, array("label" => 'Créer'))->getForm();
    }

    public function onPreSetData(FormEvent $event){
        $form = $event->getForm();
        $player = $event->getData();

        if($player->getId() !== null){
            $form->remove("name");
            $form->remove("age");
            $form->remove("role");
        }
        else{
            $form->remove("money");
            $form->remove("experience");
        }
    }

    public function onPreSubmitData(FormEvent $event){
        $form = $event->getForm();
        $playerValue = $form->getData();
        $dataForm = $event->getData();

        $playerValue->setMoney($playerValue->getMoney() + $dataForm["ajouterMoney"]);
        $playerValue->setExperience($playerValue->getExperience() + $dataForm["ajouterExperience"]);
    }
}