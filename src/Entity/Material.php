<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 20/11/17
 * Time: 13:11
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="materials")
 **/
class Material
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
     * @var float
     *
     * @ORM\Column(name="max_weight", type="decimal", precision=2, scale=1)
     */
    private $weight;

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
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param float $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function __toString()
    {
        return $this->getId() . " " . $this->getName() . " " . $this->getWeight() . PHP_EOL;
        // TODO: Implement __toString() method.
    }

}