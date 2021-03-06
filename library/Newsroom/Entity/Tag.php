<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity;

use Newsroom;

/**
 * @Entity (repositoryClass="Newsroom\Entity\Repository\TagRepository")
 * @Table (name="tag")
 */

class Tag extends Newsroom\EntityAbstract
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="tag_id")
     */
    protected $id;

    /**
     * @Column(type="string", name="tag_name", length=50)
     */
    protected $name;

    /**
     * @ManyToMany(targetEntity="News", mappedBy="tags")
     */
    protected $news;

    /**
     * @ManyToMany(targetEntity="Event", mappedBy="tags")
     */
    protected $events;

    /**
     * @ManyToMany(targetEntity="Project", mappedBy="tags")
     */
    protected $projects;

    /**
     * @ManyToMany(targetEntity="Announcement", mappedBy="tags")
     */
    protected $announcements;

    /**
     * @ManyToMany(targetEntity="Material", mappedBy="tags")
     */
    protected $materials;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getNews()
    {
        return $this->news;
    }

    public function getEvents()
    {
        return $this->events;
    }

    public function getProjects()
    {
        return $this->projects;
    }

    public function getAnnouncements()
    {
        return $this->announcements;
    }

    public function getMaterials()
    {
        return $this->materials;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
