<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="personnes")
 **/
class Personne
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="max_weight", type="integer")
     */
    private $maxWeight;

    /**
     * @ORM\OneToMany(targetEntity="Inventory", mappedBy="personne")
     */
    private $inventories;


    public function __construct()
    {
        $this->inventories = new ArrayCollection();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getMaxWeight()
    {
        return $this->maxWeight;
    }

    /**
     * @param int $max_weight
     */
    public function setMaxWeight(int $max_weight)
    {
        $this->maxWeight = $max_weight;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getInventories()
    {
        return $this->inventories;
    }


    public function __toString()
    {
        return $this->getId() . " " . $this->getName() . " " . $this->getMaxWeight() . PHP_EOL;
        // TODO: Implement __toString() method.
    }


}