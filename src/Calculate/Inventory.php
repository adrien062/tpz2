<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 20/11/17
 * Time: 15:56
 */

namespace App\Calculate;

class Inventory
{
    private $em;
    private $person;
    private $inventory;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $em, $my_parameter)
    {
        $this->my_parameter = $my_parameter;
        $this->em = $em;
    }

    public function calcul(){
        die($this->my_parameter);
        $poidsTotal = 0;

        foreach($this->person->getInventories() as $a_inventory){
            $poidsTotal += $a_inventory->getMaterial()->getWeight() * $a_inventory->getNumberOfItem();
        }

        $poidsTotal += $this->inventory->getMaterial()->getWeight() * $this->inventory->getNumberOfItem();

        return $this->person->getMaxWeight() >= $poidsTotal;
    }

    /**
     * @return mixed
     */
    public function getPerson()
    {
        return $this->person;
    }

    /**
     * @param mixed $person
     */
    public function setPerson($person)
    {
        $this->person = $person;
    }

    /**
     * @return mixed
     */
    public function getInventory()
    {
        return $this->inventory;
    }

    /**
     * @param mixed $inventory
     */
    public function setInventory($inventory)
    {
        $this->inventory = $inventory;
    }


}