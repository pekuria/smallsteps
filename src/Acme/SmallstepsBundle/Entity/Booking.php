<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Booking
 *
 * @ORM\Table(name="booking", indexes={@ORM\Index(name="child_id_3", columns={"child_id"}), @ORM\Index(name="room_id", columns={"room_id"}), @ORM\Index(name="payment_id", columns={"payment_id"}), @ORM\Index(name="IDX_E00CEDDED614C7E7", columns={"price_id"})})
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 */
class Booking
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
     * @var \DateTime
     *
     * @ORM\Column(name="booking_date", type="date", nullable=false)
     */
    private $bookingDate;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=10, nullable=false)
     */
    private $status;

    /**
     * @var \Payment
     *
     * @ORM\ManyToOne(targetEntity="Payment")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_id", referencedColumnName="id")
     * })
     */
    private $payment;

    /**
     * @var \Room
     *
     * @ORM\ManyToOne(targetEntity="Room")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="room_id", referencedColumnName="id")
     * })
     */
    private $room;

    /**
     * @var \Price
     *
     * @ORM\ManyToOne(targetEntity="Price")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="price_id", referencedColumnName="id")
     * })
     */
    private $price;

    /**
     * @var \Child
     *
     * @ORM\ManyToOne(targetEntity="Child")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="child_id", referencedColumnName="id")
     * })
     */
    private $child;
    
    
     /**
     * @ORM\OneToMany(targetEntity="BookingDetail", mappedBy="booked", cascade={"persist"})
     */
    private $bookingDetail;
    
    

    public function __construct() {
        $this->bookingDetail = new ArrayCollection();
       
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

    /**
     * Set bookingDate
     *
     * @param \DateTime $bookingDate
     * @return Booking
     */
    public function setBookingDate($bookingDate)
    {
        $this->bookingDate = $bookingDate;

        return $this;
    }

    /**
     * Get bookingDate
     *
     * @return \DateTime 
     */
    public function getBookingDate()
    {
        return $this->bookingDate;
    }

    /**
     * Set status
     *
     * @param string $status
     * @return Booking
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set payment
     *
     * @param \App\Entity\Payment $payment
     * @return Booking
     */
    public function setPayment(\App\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \App\Entity\Payment 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set room
     *
     * @param \App\Entity\Room $room
     * @return Booking
     */
    public function setRoom(\App\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \App\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set price
     *
     * @param \App\Entity\Price $price
     * @return Booking
     */
    public function setPrice(\App\Entity\Price $price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return \App\Entity\Price 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set child
     *
     * @param \App\Entity\Child $child
     * @return Booking
     */
    public function setChild(\App\Entity\Child $child = null)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return \App\Entity\Child 
     */
    public function getChild()
    {
        return $this->child;
    }
    
   
     /**
     * Get bookingDetail
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBookingDetail() {
        return $this->bookingDetail;
    }

     /**
     * Set bookingDetail
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function setBookingDetail($bookingDetail) {
        $this->bookingDetail = $bookingDetail;
        return $this;
    }
    
    /**
     * Add bookingDetail
     *
     * @param \App\Entity\NurseryDetail $bookingDetail
     * @return Booking
     */
    public function addBookingDetail(\App\Entity\bookingDetail $bookingDetail)
    {
        $bookingDetail->setBooked($this);
        $this->bookingDetail->add($bookingDetail);

        return $this;
    }
   

        /**
     * Remove bookingDetail
     *
     * @param \App\Entity\NurseryDetail $bookingDetail
     */
    public function removeBookingDetail(\App\Entity\BookingDetail $bookingDetail)
    {
        $this->bookingDetail->removeElement($bookingDetail);
    }


}
