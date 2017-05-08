<?php

namespace Acme\SmallstepsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeslot
 *
 * @ORM\Table(name="timeslot")
 * @ORM\Entity
 */
class Timeslot
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
     * @ORM\Column(name="name", type="string", length=50, nullable=false)
     */
    private $name;

     


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Timeslot
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
}

