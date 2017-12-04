<?php
/**
 * Created by PhpStorm.
 * User: adrien.lambersens
 * Date: 27/11/17
 * Time: 14:05
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity
 * @ORM\Table(name="players")
 * @UniqueEntity(fields="name", message="Hey choose another one")
 **/
class Player
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
     * @ORM\Column(name="name", type="string", length=255)
     *
     * @Assert\NotBlank()
     * @Assert\Length(
     *     min="4",
     *     max="20",
     *     minMessage="Trop petit {{ limit }} ",
     *     maxMessage="Trop grand {{ limit }} "
     * )
     * @Assert\Type("alpha")
     */
    private $name;

    /**
     * @var integer
     * @ORM\Column(name="age", type="integer")
     *
     * @Assert\NotBlank()
     * @Assert\Range(
     *     min="18",
     *     max="99",
     *     minMessage="Trop petit",
     *     maxMessage="Trop grand"
     * )
     */
    private $age;

    /**
     * @var string
     * @ORM\Column(name="country", type="string")
     *
     * @Assert\Choice({"France", "Belgique"})
     */
    private $country;

    /**
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param int $age
     */
    public function setAge(int $age)
    {
        $this->age = $age;
    }

    /**
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param string $country
     */
    public function setCountry(string $country)
    {
        $this->country = $country;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    public function __toString()
    {
        return $this->getName();
        // TODO: Implement __toString() method.
    }
}