<?php

namespace Newsroom\Entity\Proxy;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class NewsroomEntityNewsProxy extends \Newsroom\Entity\News implements \Doctrine\ORM\Proxy\Proxy
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
    
    
    public function getId()
    {
        $this->__load();
        return parent::getId();
    }

    public function setId($id)
    {
        $this->__load();
        return parent::setId($id);
    }

    public function getHeadline()
    {
        $this->__load();
        return parent::getHeadline();
    }

    public function setHeadline($headline)
    {
        $this->__load();
        return parent::setHeadline($headline);
    }

    public function getUrl()
    {
        $this->__load();
        return parent::getUrl();
    }

    public function getContent()
    {
        $this->__load();
        return parent::getContent();
    }

    public function setContent($content)
    {
        $this->__load();
        return parent::setContent($content);
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

    public function getPublish($format = 'd.m.Y')
    {
        $this->__load();
        return parent::getPublish($format);
    }

    public function setPublish($date)
    {
        $this->__load();
        return parent::setPublish($date);
    }

    public function getTags()
    {
        $this->__load();
        return parent::getTags();
    }

    public function setTags($tags)
    {
        $this->__load();
        return parent::setTags($tags);
    }

    public function getComments()
    {
        $this->__load();
        return parent::getComments();
    }

    public function getUser()
    {
        $this->__load();
        return parent::getUser();
    }

    public function setUser($user)
    {
        $this->__load();
        return parent::setUser($user);
    }

    public function getCreate($format = 'd.m.Y')
    {
        $this->__load();
        return parent::getCreate($format);
    }

    public function setCreate($create)
    {
        $this->__load();
        return parent::setCreate($create);
    }

    public function getUpdate($format = 'd.m.Y')
    {
        $this->__load();
        return parent::getUpdate($format);
    }

    public function setUpdate($update)
    {
        $this->__load();
        return parent::setUpdate($update);
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

    public function __isset($name)
    {
        $this->__load();
        return parent::__isset($name);
    }

    public function __unset($name)
    {
        $this->__load();
        return parent::__unset($name);
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
        return array('__isInitialized__', 'id', 'headline', 'url', 'content', 'image', 'publish', 'tags', 'comments', 'user', 'create', 'update');
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