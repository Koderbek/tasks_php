<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 21.06.2018
 * Time: 15:50
 */

namespace AppBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Subject
 * @package AppBundle\Entity
 * @ORM\Entity()
 */
class Subject
{
    /**
     * @var integer
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var ArrayCollection|Student[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Student")
     */
    protected $students;

    /**
     * @var ArrayCollection|Employee[]
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Employee")
     */
    protected $lecturers;

    /**
     * @var integer|null
     * @ORM\Column(type="integer")
     */
    protected $countHours;

    public function __construct()
    {
        $this->students = new ArrayCollection();
        $this->lecturers = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
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
     * @return Employee[]|ArrayCollection
     */
    public function getLecturers()
    {
        return $this->lecturers;
    }

    /**
     * @param Employee[]|ArrayCollection $lecturers
     */
    public function setLecturers($lecturers)
    {
        $this->lecturers = $lecturers;
    }

    /**
     * @return int|null
     */
    public function getCountHours()
    {
        return $this->countHours;
    }

    /**
     * @param int|null $countHours
     */
    public function setCountHours($countHours)
    {
        $this->countHours = $countHours;
    }
}
