<?php
/**
 * Created by PhpStorm.
 * User: MY
 * Date: 24.01.2018
 * Time: 20:37
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
* @ORM\Entity
* @ORM\Table(name="post")
*/
class Post
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \DateTime
     * @ORM\Column(type="datetime")
     *
     */
    private $dataPost;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=250)
     */
    private $heading;

    /**
     * @var string
     *
     * @ORM\Column(type="text")
     */
    private $textPost;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Post
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }


    /**
     * @return \DateTime
     */
    public function getDataPost(): ? \DateTime
    {
        return $this->dataPost;
    }

    /**
     * @param \DateTime $dataPost
     * @return Post
     */
    public function setDataPost(\DateTime $dataPost): Post
    {
        $this->dataPost = $dataPost;
        return $this;
    }

    /**
     * @return string
     */
    public function getHeading(): ? string
    {
        return $this->heading;
    }

    /**
     * @param string $heading
     * @return Post
     */
    public function setHeading(string $heading): Post
    {
        $this->heading = $heading;
        return $this;
    }

    /**
     * @return string
     */
    public function getTextPost(): ? string
    {
        return $this->textPost;
    }

    /**
     * @param string $textPost
     * @return Post
     */
    public function setTextPost(string $textPost): Post
    {
        $this->textPost = $textPost;
        return $this;
    }


}