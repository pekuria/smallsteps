<?php

namespace Acme\SmallstepsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Booking
 *
 * @ORM\Table(name="booking", indexes={@ORM\Index(name="child_id_3", columns={"child_id"}), @ORM\Index(name="room_id", columns={"room_id"}), @ORM\Index(name="payment_id", columns={"payment_id"}), @ORM\Index(name="IDX_E00CEDDED614C7E7", columns={"price_id"})})
 * @ORM\Entity(repositoryClass="Acme\SmallstepsBundle\Repository\BookingRepository")
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
     * @param \Acme\SmallstepsBundle\Entity\Payment $payment
     * @return Booking
     */
    public function setPayment(\Acme\SmallstepsBundle\Entity\Payment $payment = null)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return \Acme\SmallstepsBundle\Entity\Payment 
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set room
     *
     * @param \Acme\SmallstepsBundle\Entity\Room $room
     * @return Booking
     */
    public function setRoom(\Acme\SmallstepsBundle\Entity\Room $room = null)
    {
        $this->room = $room;

        return $this;
    }

    /**
     * Get room
     *
     * @return \Acme\SmallstepsBundle\Entity\Room 
     */
    public function getRoom()
    {
        return $this->room;
    }

    /**
     * Set price
     *
     * @param \Acme\SmallstepsBundle\Entity\Price $price
     * @return Booking
     */
    public function setPrice(\Acme\SmallstepsBundle\Entity\Price $price = null)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return \Acme\SmallstepsBundle\Entity\Price 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set child
     *
     * @param \Acme\SmallstepsBundle\Entity\Child $child
     * @return Booking
     */
    public function setChild(\Acme\SmallstepsBundle\Entity\Child $child = null)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return \Acme\SmallstepsBundle\Entity\Child 
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
     * @param \Acme\SmallstepsBundle\Entity\NurseryDetail $bookingDetail
     * @return Booking
     */
    public function addBookingDetail(\Acme\SmallstepsBundle\Entity\bookingDetail $bookingDetail)
    {
        $bookingDetail->setBooked($this);
        $this->bookingDetail->add($bookingDetail);

        return $this;
    }
   

        /**
     * Remove bookingDetail
     *
     * @param \Acme\SmallstepsBundle\Entity\NurseryDetail $bookingDetail
     */
    public function removeBookingDetail(\Acme\SmallstepsBundle\Entity\BookingDetail $bookingDetail)
    {
        $this->bookingDetail->removeElement($bookingDetail);
    }


}
