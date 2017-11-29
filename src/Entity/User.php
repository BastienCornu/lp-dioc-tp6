<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=70)
     */
    private $email;
    /**
     * @ORM\Column(type="string", length=55)
     */
    private $firstname;
    /**
     * @ORM\Column(type="string", length=55)
     */
    private $lastname;
    /**
     * @ORM\Column(type="string", length=70)
     */
    private $password;
    /**
     * @ORM\Column(type="boolean")
     */
    private $isAuthor = false;
    /**
     * @ORM\OneToMany(targetEntity="Article",mappedBy="author",cascade={"persist"})
     */
    private $articles;

    /**
     * User constructor.
     * @param $articles
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @param mixed $isAuthor
     */
    public function setIsAuthor($isAuthor)
    {
        $this->isAuthor = $isAuthor;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }


    /**
     * @return mixed
     */
    public function getIsAuthor()
    {
        return $this->isAuthor;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }
    // Fixme



    public function getRoles()
    {
        $roles = ['ROLE_USER'];

        if ($this->getIsAuthor()) {
            $roles[] = 'ROLE_AUTHOR';
        }

        return $roles;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        return;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->firstname,
            $this->lastname,
            $this->isAuthor,
            $this->password,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->firstname,
            $this->lastname,
            $this->isAuthor,
            $this->password,
        ) = unserialize($serialized);
    }

    public function getPassword()
    {
        return $this->password;
    }
}
