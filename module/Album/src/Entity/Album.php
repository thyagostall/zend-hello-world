<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 19/02/2017
 * Time: 15:15
 */

namespace Album\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity Table(name="album")
 */
class Album
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $title;

    /**
     * @ORM\Column(type="string", nullable=false)
     */
    protected $artist;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getArtist()
    {
        return $this->artist;
    }

    /**
     * @param mixed $artist
     */
    public function setArtist($artist)
    {
        $this->artist = $artist;
    }

    public function exchangeArray(array $data)
    {
        $this->id = !empty($data['id']) ? $data['id'] : null;
        $this->artist = !empty($data['artist']) ? $data['artist'] : null;
        $this->title = !empty($data['title']) ? $data['title'] : null;
    }
    public function getArrayCopy()
    {
        return [
            'id' => $this->id,
            'artist' => $this->artist,
            'title' => $this->title,
        ];
    }

}