<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setting
 *
 * @ORM\Table(name="setting")
 * @ORM\Entity
 */
class Setting
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
     * @var integer
     *
     * @ORM\Column(name="allow_registration", type="integer", nullable=true)
     */
    private $allowRegistration;

    /**
     * @var string
     *
     * @ORM\Column(name="paypal_email", type="string", length=128, nullable=true)
     */
    private $paypalEmail;

    /**
     * @var string
     *
     * @ORM\Column(name="redirect_location", type="string", length=128, nullable=true)
     */
    private $redirectLocation;

    /**
     * @var string
     *
     * @ORM\Column(name="App_Version", type="string", length=50, nullable=false)
     */
    private $appVersion;

    /**
     * @var integer
     *
     * @ORM\Column(name="No_of_Attempts", type="integer", nullable=false)
     */
    private $noOfAttempts;

    /**
     * @var string
     *
     * @ORM\Column(name="Site_Name", type="string", length=50, nullable=false)
     */
    private $siteName;

    /**
     * @var string
     *
     * @ORM\Column(name="Admin_Email", type="string", length=50, nullable=false)
     */
    private $adminEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Bank_Holidays", type="date", nullable=false)
     */
    private $bankHolidays;



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
     * Set allowRegistration
     *
     * @param integer $allowRegistration
     * @return Setting
     */
    public function setAllowRegistration($allowRegistration)
    {
        $this->allowRegistration = $allowRegistration;

        return $this;
    }

    /**
     * Get allowRegistration
     *
     * @return integer 
     */
    public function getAllowRegistration()
    {
        return $this->allowRegistration;
    }

    /**
     * Set paypalEmail
     *
     * @param string $paypalEmail
     * @return Setting
     */
    public function setPaypalEmail($paypalEmail)
    {
        $this->paypalEmail = $paypalEmail;

        return $this;
    }

    /**
     * Get paypalEmail
     *
     * @return string 
     */
    public function getPaypalEmail()
    {
        return $this->paypalEmail;
    }

    /**
     * Set redirectLocation
     *
     * @param string $redirectLocation
     * @return Setting
     */
    public function setRedirectLocation($redirectLocation)
    {
        $this->redirectLocation = $redirectLocation;

        return $this;
    }

    /**
     * Get redirectLocation
     *
     * @return string 
     */
    public function getRedirectLocation()
    {
        return $this->redirectLocation;
    }

    /**
     * Set appVersion
     *
     * @param string $appVersion
     * @return Setting
     */
    public function setAppVersion($appVersion)
    {
        $this->appVersion = $appVersion;

        return $this;
    }

    /**
     * Get appVersion
     *
     * @return string 
     */
    public function getAppVersion()
    {
        return $this->appVersion;
    }

    /**
     * Set noOfAttempts
     *
     * @param integer $noOfAttempts
     * @return Setting
     */
    public function setNoOfAttempts($noOfAttempts)
    {
        $this->noOfAttempts = $noOfAttempts;

        return $this;
    }

    /**
     * Get noOfAttempts
     *
     * @return integer 
     */
    public function getNoOfAttempts()
    {
        return $this->noOfAttempts;
    }

    /**
     * Set siteName
     *
     * @param string $siteName
     * @return Setting
     */
    public function setSiteName($siteName)
    {
        $this->siteName = $siteName;

        return $this;
    }

    /**
     * Get siteName
     *
     * @return string 
     */
    public function getSiteName()
    {
        return $this->siteName;
    }

    /**
     * Set adminEmail
     *
     * @param string $adminEmail
     * @return Setting
     */
    public function setAdminEmail($adminEmail)
    {
        $this->adminEmail = $adminEmail;

        return $this;
    }

    /**
     * Get adminEmail
     *
     * @return string 
     */
    public function getAdminEmail()
    {
        return $this->adminEmail;
    }

    /**
     * Set bankHolidays
     *
     * @param \DateTime $bankHolidays
     * @return Setting
     */
    public function setBankHolidays($bankHolidays)
    {
        $this->bankHolidays = $bankHolidays;

        return $this;
    }

    /**
     * Get bankHolidays
     *
     * @return \DateTime 
     */
    public function getBankHolidays()
    {
        return $this->bankHolidays;
    }
}
