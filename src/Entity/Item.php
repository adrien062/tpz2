<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 27/11/17
 * Time: 14:19
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="items")
 **/
class Item
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
     * @var string
     *
     * @ORM\Column(name="type_item", type="string", length=255)
     */
    private $typeItem;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
     * @return string
     */
    public function getTypeItem()
    {
        return $this->typeItem;
    }

    /**
     * @param string $typeItem
     */
    public function setTypeItem(string $typeItem)
    {
        $this->typeItem = $typeItem;
    }

    function __toString()
    {
        return $this->getName();
        // TODO: Implement __toString() method.
    }


}