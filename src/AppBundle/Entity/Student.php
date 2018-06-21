<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 05.06.2018
 * Time: 18:26
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Student
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Student extends User
{

    /**
     * @var string|null
     * @ORM\Column(type="integer")
     */
    protected $age;

    /**
     * @var University|null
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\University")
     */
    protected $university;

    public function __toString()
    {
        return $this->name.', '.$this->surname.', '.$this->age;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }

    /**
     * @return University|null
     */
    public function getUniversity()
    {
        return $this->university;
    }

    /**
     * @param University|null $university
     */
    public function setUniversity(?University $university)
    {
        $this->university = $university;
    }


}