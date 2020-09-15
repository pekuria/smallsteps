<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BookingDetail
 *
 * @ORM\Table(name="booking_detail", uniqueConstraints={@ORM\UniqueConstraint(name="booked_id", columns={"booked_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\BookingDetailRepository")
 */
class BookingDetail {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="booked_date", type="date", nullable=false)
     */
    private $bookedDate;
    /**
     * @var Boolean
     *
     * @ORM\Column(name="breakfast_club", type="boolean", nullable=false)
     */
    private $breakfastClub;

    /**
     * @var Boolean
     *
     * @ORM\Column(name="afterday_club", type="boolean", nullable=false)
     */
    private $afterdayClub;
    
    
    /**
     * @var \Booking
     *
     * @ORM\ManyToOne(targetEntity="Booking")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="booked_id", referencedColumnName="id")
     * })
     */
    private $booked;
    
    

   /**
     * @var \dayslot
     *
     * @ORM\ManyToOne(targetEntity="Timeslot")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="dayslot", referencedColumnName="id")
     * })
     */
    private $dayslot;
    
    

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set bookedDate
     *
     * @param \DateTime $bookedDate
     * @return BookingDetail
     */
    public function setBookedDate($bookedDate) {
        $this->bookedDate = $bookedDate;

        return $this;
    }

    /**
     * Get bookedDate
     *
     * @return \DateTime 
     */
    public function getBookedDate() {
        return $this->bookedDate;
    }

   
    /**
     * Set booked
     *
     * @param \App\Entity\Booking $booked
     * @return BookingDetail
     */
    public function setBooked(\App\Entity\Booking $booked = null) {
        $this->booked = $booked;

        return $this;
    }

    /**
     * Get booked
     *
     * @return \App\Entity\Booking
     */
    public function getBooked() {
        return $this->booked;
    }

    public function __toString() {
        return 'booking Detail';
    }

  


    /**
     * Set breakfastClub
     *
     * @param boolean $breakfastClub
     *
     * @return BookingDetail
     */
    public function setBreakfastClub($breakfastClub)
    {
        $this->breakfastClub = $breakfastClub;

        return $this;
    }

    /**
     * Get breakfastClub
     *
     * @return boolean
     */
    public function getBreakfastClub()
    {
        return $this->breakfastClub;
    }

    /**
     * Set afterdayClub
     *
     * @param boolean $afterdayClub
     *
     * @return BookingDetail
     */
    public function setAfterdayClub($afterdayClub)
    {
        $this->afterdayClub = $afterdayClub;

        return $this;
    }

    /**
     * Get afterdayClub
     *
     * @return boolean
     */
    public function getAfterdayClub()
    {
        return $this->afterdayClub;
    }

    /**
     * Set dayslot
     *
     * @param \App\Entity\Timeslot $dayslot
     *
     * @return BookingDetail
     */
    public function setDayslot(\App\Entity\Timeslot $dayslot = null)
    {
        $this->dayslot = $dayslot;

        return $this;
    }

    /**
     * Get dayslot
     *
     * @return \App\Entity\Timeslot
     */
    public function getDayslot()
    {
        return $this->dayslot;
    }
}
