<?php

/**
 * @author      Patrick Kromeyer
 * @license     please view LICENSE file
 */

namespace Newsroom\Entity;

use Newsroom;

/**
 * @Entity (repositoryClass="Newsroom\Entity\Repository\LecturerRepository")
 * @Table (name="lecturer")
 */

class Lecturer extends Newsroom\EntityAbstract
{
    /**
     * @Id
     * @GeneratedValue
     * @Column(type="integer", name="lecturer_id")
     */
    protected $id;

    /**
     * @Column(type="string", name="lecturer_title", length=30)
     */
    protected $title;

    /**
     * @Column(type="string", name="lecturer_firstname", length=30)
     */
    protected $firstname;

    /**
     * @Column(type="string", name="lecturer_lastname", length=30)
     */
    protected $lastname;

    /**
     * @Column(type="string", name="lecturer_url", length=90)
     */
    protected $url;

    /**
     * @Column(type="string", name="lecturer_email", length=90)
     */
    protected $email;

    /**
     * @Column(type="string", name="lecturer_website", length=90)
     */
    protected $website;

    /**
     * @Column(type="string", name="lecturer_subject", length=90)
     */
    protected $subject;

    /**
     * @Column(type="text", name="lecturer_content")
     */
    protected $content;

    /**
     * @Column(type="text", name="lecturer_interview")
     */
    protected $interview;

    /**
     * @OneToOne(targetEntity="File", cascade={"persist", "remove"}, orphanRemoval=true)
     * @JoinColumn(name="image_id", referencedColumnName="file_id", nullable=true)
     */
    protected $image;

    /**
     * @Column(type="date", name="lecturer_publish")
     */
    protected $publish;

    /**
     * @ManyToOne(targetEntity="User")
     * @JoinColumn(name="user_id", referencedColumnName="user_id")
     */
    protected $user;

    /**
     * @Column(type="datetime", name="lecturer_create")
     */
    protected $create;

    /**
     * @Column(type="datetime", name="lecturer_update")
     */
    protected $update;

    public function __construct()
    {
        $this->create = new \DateTime();
        $this->update = $this->create;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

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

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getWebsite()
    {
        return $this->website;
    }

    public function setWebsite($website)
    {
        $this->website = $website;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getContent()
    {
        return $this->content;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function getInterview()
    {
        return $this->interview;
    }

    public function setInterview($interview)
    {
        $this->interview = $interview;
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
