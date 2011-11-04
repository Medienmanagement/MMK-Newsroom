<?php

namespace Newsroom\Entity\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class NewsroomEntityContactInformationProxy extends \Newsroom\Entity\ContactInformation implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }
    
    
    public function getTitle()
    {
        $this->__load();
        return parent::getTitle();
    }

    public function setTitle($title)
    {
        $this->__load();
        return parent::setTitle($title);
    }

    public function getFirstname()
    {
        $this->__load();
        return parent::getFirstname();
    }

    public function setFirstname($firstname)
    {
        $this->__load();
        return parent::setFirstname($firstname);
    }

    public function getLastname()
    {
        $this->__load();
        return parent::getLastname();
    }

    public function setLastname($lastname)
    {
        $this->__load();
        return parent::setLastname($lastname);
    }

    public function getEmail()
    {
        $this->__load();
        return parent::getEmail();
    }

    public function setEmail($email)
    {
        $this->__load();
        return parent::setEmail($email);
    }

    public function getPhone()
    {
        $this->__load();
        return parent::getPhone();
    }

    public function setPhone($phone)
    {
        $this->__load();
        return parent::setPhone($phone);
    }

    public function getFax()
    {
        $this->__load();
        return parent::getFax();
    }

    public function setFax($fax)
    {
        $this->__load();
        return parent::setFax($fax);
    }

    public function getStreet()
    {
        $this->__load();
        return parent::getStreet();
    }

    public function setStreet($street)
    {
        $this->__load();
        return parent::setStreet($street);
    }

    public function getZipcode()
    {
        $this->__load();
        return parent::getZipcode();
    }

    public function setZipcode($zipcode)
    {
        $this->__load();
        return parent::setZipcode($zipcode);
    }

    public function getCity()
    {
        $this->__load();
        return parent::getCity();
    }

    public function setCity($city)
    {
        $this->__load();
        return parent::setCity($city);
    }

    public function getWebsite()
    {
        $this->__load();
        return parent::getWebsite();
    }

    public function setWebsite($website)
    {
        $this->__load();
        return parent::setWebsite($website);
    }

    public function getXing()
    {
        $this->__load();
        return parent::getXing();
    }

    public function setXing($xing)
    {
        $this->__load();
        return parent::setXing($xing);
    }

    public function getFacebook()
    {
        $this->__load();
        return parent::getFacebook();
    }

    public function setFacebook($facebook)
    {
        $this->__load();
        return parent::setFacebook($facebook);
    }

    public function getImage()
    {
        $this->__load();
        return parent::getImage();
    }

    public function setImage($image)
    {
        $this->__load();
        return parent::setImage($image);
    }

    public function __get($name)
    {
        $this->__load();
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        $this->__load();
        return parent::__set($name, $value);
    }

    public function setFromArray(array $values)
    {
        $this->__load();
        return parent::setFromArray($values);
    }

    public function toArray()
    {
        $this->__load();
        return parent::toArray();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'email', 'title', 'firstname', 'lastname', 'phone', 'fax', 'street', 'zipcode', 'city', 'website', 'xing', 'facebook', 'image');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields AS $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}