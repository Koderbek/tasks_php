<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21.06.2018
 * Time: 17:13
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Lecture
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Lecture
{

    /**
     * @var integer|null
     *
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection|Student[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Student")
     */
    protected $students;

    /**
     * @var ArrayCollection|Employee
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Employee")
     */
    protected $lecturer;

    /**
     * @var integer|null
     * @ORM\Column(type="string")
     */
    protected $status;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     */
    protected $date;

    public function __construct()
    {
        $this->students = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Student[]|ArrayCollection
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param Student[]|ArrayCollection $students
     */
    public function setStudents($students)
    {
        $this->students = $students;
    }

    /**
     * @return Employee|ArrayCollection
     */
    public function getLecturer()
    {
        return $this->lecturer;
    }

    /**
     * @param Employee|ArrayCollection $lecturer
     */
    public function setLecturer($lecturer)
    {
        $this->lecturer = $lecturer;
    }

    /**
     * @return int|null
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param int|null $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param \DateTime $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }
}