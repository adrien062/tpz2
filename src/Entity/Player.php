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

    public const PLAYER_ROLES = array("ADC" => "ADC", "JUNG" => "JUNG", "TOP" => "TOP", "MID" => "MID", "SUP" => "SUP");
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
     * @ORM\Column(name="role", type="string")
     *
     * @Assert\Choice({"ADC", "JUNG", "TOP", "MID", "SUP"})
     */
    private $role;

    /**
     * @ORM\Column(name="experience", type="integer", nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(name="money", type="integer", nullable=true)
     */
    private $money;

    /**
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updateAt;

    /**
     * @return string
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @param string $money
     */
    public function setMoney(string $money)
    {
        $this->money = $money;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getExperience()
    {
        return $this->experience;
    }

    /**
     * @param string $experience
     */
    public function setExperience(string $experience)
    {
        $this->experience = $experience;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param mixed $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return mixed
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }

    /**
     * @param mixed $updateAt
     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    }

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