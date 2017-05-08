<?php

namespace Acme\SmallstepsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Child
 *
 * @ORM\Table(name="child", uniqueConstraints={@ORM\UniqueConstraint(name="nhs_no", columns={"nhs_no"}), @ORM\UniqueConstraint(name="UNIQ_22B35429F99EDABB", columns={"school"})}, indexes={@ORM\Index(name="parent_id", columns={"parent_id"})})
 * @ORM\Entity(repositoryClass="Acme\SmallstepsBundle\Repository\ChildRepository")
 */
class Child
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=100, nullable=false)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=false)
     */
    private $lastname;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dob", type="date", nullable=false)
     */
    private $dob;

    /**
     * @var string
     *
     * @ORM\Column(name="nhs_no", type="string", length=20, nullable=false)
     */
    private $nhsNo;

    /**
     * @var string
     *
     * @ORM\Column(name="additional", type="text", nullable=true)
     */
    private $additional;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    private $parent;

    /**
     * @var \School
     *
     * @ORM\ManyToOne(targetEntity="School")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="school", referencedColumnName="id")
     * })
     */
    private $school;
    
    /**
     * @var \Room
     *
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room", referencedColumnName="id")
     * })
     */
    private $room;

   

    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Child
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return Child
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set dob
     *
     * @param \DateTime $dob
     * @return Child
     */
    public function setDob($dob)
    {
        $this->dob = $dob;

        return $this;
    }

    /**
     * Get dob
     *
     * @return \DateTime 
     */
    public function getDob()
    {
        return $this->dob;
    }

    /**
     * Set nhsNo
     *
     * @param string $nhsNo
     * @return Child
     */
    public function setNhsNo($nhsNo)
    {
        $this->nhsNo = $nhsNo;

        return $this;
    }

    /**
     * Get nhsNo
     *
     * @return string 
     */
    public function getNhsNo()
    {
        return $this->nhsNo;
    }

    /**
     * Set additional
     *
     * @param string $additional
     * @return Child
     */
    public function setAdditional($additional)
    {
        $this->additional = $additional;

        return $this;
    }

    /**
     * Get additional
     *
     * @return string 
     */
    public function getAdditional()
    {
        return $this->additional;
    }

    /**
     * Set parent
     *
     * @param \Acme\SmallstepsBundle\Entity\User $parent
     * @return Child
     */
    public function setParent(\Acme\SmallstepsBundle\Entity\User $parent = null)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Acme\SmallstepsBundle\Entity\User 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set school
     *
     * @param \Acme\SmallstepsBundle\Entity\School $school
     * @return Child
     */
    public function setSchool(\Acme\SmallstepsBundle\Entity\School $school = null)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return \Acme\SmallstepsBundle\Entity\School 
     */
    public function getSchool()
    {
       
            return $this->school;
        
    }
    
    /**
     * Get room
     *
     * @return \Acme\SmallstepsBundle\Entity\Room
     */
     public function getRoom() {
        return $this->room;
    }

    /**
     * Set room
     *
     * @param \Acme\SmallstepsBundle\Entity\School $room
     * @return Child
     */
    public function setRoom(\Acme\SmallstepsBundle\Entity\Room $room = null) {
        $this->room = $room;
        return $this;
    }
}
