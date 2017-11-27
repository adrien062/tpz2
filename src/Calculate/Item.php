<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 27/11/17
 * Time: 16:40
 */

namespace App\Calculate;


class Item
{
    private $em;
    private $person;
    private $playerItem;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $em)
    {
        $this->em = $em;
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
    public function getPlayerItem()
    {
        return $this->playerItem;
    }

    /**
     * @param mixed $inventory
     */
    public function setInventory($playerItem)
    {
        $this->playerItem = $playerItem;
    }


}