<?php
namespace App\Form;

use App\Entity\PlayerItem;

use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;

class PlayerItemType extends AbstractType
{
    private $nbItem;

    public function __construct($nbItem)
    {
        $this->nbItem = intval($nbItem);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => PlayerItem::class,]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $tabItem = [];
        for($i = 1; $i <= $this->nbItem; $i++){
            $tabItem[$i] = $i;
        }

        $builder->add('player')
            ->add('items')
            ->add('position', ChoiceType::class, array("choices" => $tabItem))
            ->add('save', SubmitType::class, array("label" => 'Créer'))->getForm();
    }
}