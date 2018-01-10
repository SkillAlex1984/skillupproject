<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 09.01.2018
 * Time: 20:50
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="feedbacks")
 */
class Feedback
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=250, options={"default": ""})
     *
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250, options={"default": ""})
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * Feedback constructor.
     */
    public function __construct($id)
    {
       $this->name = '';
       $this->email = '';
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Feedback
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Feedback
     */
    public function setName(string $name): Feedback
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     * @return Feedback
     */
    public function setEmail(string $email): Feedback
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string
     */
    public function getMessage(): ? string
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Feedback
     */
    public function setMessage(string $message): Feedback
    {
        $this->message = $message;
        return $this;
    }


}