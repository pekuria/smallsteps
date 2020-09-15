<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payment
 *
 * @ORM\Table(name="payment", indexes={@ORM\Index(name="createdtime", columns={"createdtime"}), @ORM\Index(name="FK_65D29B32AD5DC05D", columns={"payment_type"})})
 * @ORM\Entity(repositoryClass="App\Repository\PaymentRepository")
 */
class Payment
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
     * @ORM\Column(name="total_hours", type="decimal", precision=10, scale=0, nullable=false)
     */
    private $totalHours;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="decimal", precision=7, scale=2, nullable=false)
     */
    private $amount;

    /**
     * @var integer
     *
     * @ORM\Column(name="status", type="integer", nullable=false)
     */
    private $status;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdtime", type="date", nullable=false)
     */
    private $createdtime;

    /**
     * @var \PaymentMethod
     *
     * @ORM\ManyToOne(targetEntity="PaymentMethod")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="payment_type", referencedColumnName="id")
     * })
     */
    private $paymentType;



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
     * Set totalHours
     *
     * @param string $totalHours
     * @return Payment
     */
    public function setTotalHours($totalHours)
    {
        $this->totalHours = $totalHours;

        return $this;
    }

    /**
     * Get totalHours
     *
     * @return string 
     */
    public function getTotalHours()
    {
        return $this->totalHours;
    }

    /**
     * Set amount
     *
     * @param string $amount
     * @return Payment
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Get amount
     *
     * @return string 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set status
     *
     * @param integer $status
     * @return Payment
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set createdtime
     *
     * @param \DateTime $createdtime
     * @return Payment
     */
    public function setCreatedtime($createdtime)
    {
        $this->createdtime = $createdtime;

        return $this;
    }

    /**
     * Get createdtime
     *
     * @return \DateTime 
     */
    public function getCreatedtime()
    {
        return $this->createdtime;
    }

    /**
     * Set paymentType
     *
     * @param \App\Entity\PaymentMethod $paymentType
     * @return Payment
     */
    public function setPaymentType(\App\Entity\PaymentMethod $paymentType = null)
    {
        $this->paymentType = $paymentType;

        return $this;
    }

    /**
     * Get paymentType
     *
     * @return \App\Entity\PaymentMethod 
     */
    public function getPaymentType()
    {
        return $this->paymentType;
    }
}
