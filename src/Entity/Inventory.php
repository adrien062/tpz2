<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 20/11/17
 * Time: 14:01
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="inventory")
 **/
class Inventory
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
     * @ORM\ManyToOne(targetEntity="Personne", inversedBy="inventories")
     * @ORM\JoinColumn(name="personne_id", referencedColumnName="id")
     */
    private $personne;

    /**
     * @ORM\ManyToOne(targetEntity="Material")
     * @ORM\JoinColumn(name="material_id", referencedColumnName="id")
     */
    private $material;

    /**
     * @var int
     *
     * @ORM\Column(name="number_of_item", type="integer")
     */
    private $numberOfItem;

    /**
     * @return mixed
     */
    public function getPersonne()
    {
        return $this->personne;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @return int
     */
    public function getNumberOfItem()
    {
        return $this->numberOfItem;
    }

    /**
     * @param int $numberOfItem
     */
    public function setNumberOfItem(int $numberOfItem)
    {
        $this->numberOfItem = $numberOfItem;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $personne
     */
    public function setPersonne($personne)
    {
        $this->personne = $personne;
    }

    /**
     * @param mixed $material
     */
    public function setMaterial($material)
    {
        $this->material = $material;
    }
}