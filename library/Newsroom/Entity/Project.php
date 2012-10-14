<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity;

use Newsroom;

/**
 * @Entity (repositoryClass="Newsroom\Entity\Repository\ProjectRepository")
 * @Table (name="project")
 */

class Project extends Newsroom\EntityAbstract
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="project_id")
     */
    protected $id;

    /**
     * @Column(type="string", name="project_headline", length=90)
     */
    protected $headline;

    /**
     * @Column(type="string", name="project_url", length=90)
     */
    protected $url;

    /**
     * @Column(type="text", name="project_content")
     */
    protected $content;

    /**
     * @OneToOne(targetEntity="File", cascade={"persist", "remove"}, orphanRemoval=true)
     * @JoinColumn(name="image_id", referencedColumnName="file_id", nullable=true)
     */
    protected $image;

    /**
     * @Column(type="date", name="project_publish")
     */
    protected $publish;

    /**
     * @ManyToMany(targetEntity="Tag", inversedBy="projects")
     * @JoinTable(
     *  name="project_tag",
     *  joinColumns={
     *      @JoinColumn(name="project_id", referencedColumnName="project_id")
     *  },
     *  inverseJoinColumns={
     *      @JoinColumn(name="tag_id", referencedColumnName="tag_id")
     *  }
     * )
     */
    protected $tags;

    /**
     * @OneToMany(targetEntity="Comment", mappedBy="project", cascade={"persist", "remove"})
     */
    protected $comments;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;

    /**
     * @Column(type="datetime", name="project_create")
     */
    protected $create;

    /**
     * @Column(type="datetime", name="project_update")
     */
    protected $update;

    public function __construct()
    {
        $this->create = new \DateTime();
        $this->update = $this->create;
    }

    protected function _buildUrl($string)
    {
        $filter = new \Pkr_Filter_Url();

        return $filter->filter($string);
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getHeadline()
    {
        return $this->headline;
    }

    public function setHeadline($headline)
    {
        $this->headline = $headline;
        $this->url = $this->_buildUrl($headline);
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    public function getPublish($format = 'd.m.Y')
    {
        return $this->publish->format($format);
    }

    public function setPublish($date)
    {
        $this->publish = new \DateTime($date);
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function getComments()
    {
        return $this->comments;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setUser($user)
    {
        $this->user = $user;
    }

    public function getCreate($format = 'd.m.Y')
    {
        return $this->create->format($format);
    }

    public function setCreate($create)
    {
        $this->create = $create;
    }

    public function getUpdate($format = 'd.m.Y')
    {
        return $this->update->format($format);
    }

    public function setUpdate($update)
    {
        $this->update = $update;
    }
}
