<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity;

use Newsroom;

/**
 * @Entity (repositoryClass="Newsroom\Entity\Repository\ContactInformationRepository")
 * @Table (name="contact_information")
 */

class ContactInformation extends Newsroom\EntityAbstract
{
    /**
     * @Id
     * @Column(type="string", name="contact_information_email", length=90)
     */
    protected $email;

    /**
     * @Column(type="string", name="contact_information_title", length=30)
     */
    protected $title;

    /**
     * @Column(type="string", name="contact_information_firstname", length=30)
     */
    protected $firstname;

    /**
     * @Column(type="string", name="contact_information_lastname", length=30)
     */
    protected $lastname;

    /**
     * @Column(type="string", name="contact_information_phone", length=20)
     */
    protected $phone;

    /**
     * @Column(type="string", name="contact_information_fax", length=20)
     */
    protected $fax;

    /**
     * @Column(type="string", name="contact_information_organization", length=90)
     */
    protected $organization;

    /**
     * @Column(type="string", name="contact_information_street", length=90)
     */
    protected $street;

    /**
     * @Column(type="string", name="contact_information_zipcode", length=10)
     */
    protected $zipcode;

    /**
     * @Column(type="string", name="contact_information_city", length=90)
     */
    protected $city;

    /**
     * @Column(type="string", name="contact_information_website", length=90)
     */
    protected $website;

    /**
     * @Column(type="string", name="contact_information_xing", length=90)
     */
    protected $xing;

    /**
     * @Column(type="string", name="contact_information_facebook", length=90)
     */
    protected $facebook;

    /**
     * @OneToOne(targetEntity="File", cascade={"persist", "remove"}, orphanRemoval=true)
     * @JoinColumn(name="image_id", referencedColumnName="file_id", nullable=true)
     */
    protected $image;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getFax()
    {
        return $this->fax;
    }

    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    public function getOrganization()
    {
        return $this->organization;
    }

    public function setOrganization($organization)
    {
        $this->organization = $organization;
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getXing()
    {
        return $this->xing;
    }

    public function setXing($xing)
    {
        $this->xing = $xing;
    }

    public function getFacebook()
    {
        return $this->facebook;
    }

    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }
}
