<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 18/02/2017
 * Time: 21:07
 */

namespace Album\Controller;


use Album\Entity\Album;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Model\JsonModel;
use Doctrine\ORM;
use Doctrine\ORM\EntityManager;

class AlbumRestController extends AbstractRestfulController
{
    protected $collectionOptions = ['GET', 'POST'];
    protected $resourceOptions = ['GET', 'PUT', 'DELETE'];

    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getList()
    {
        $data = [];
        foreach ($this->entityManager->getRepository('Album\\Entity\\Album')->findAll() as $item) {
            array_push($data, ["id" => $item->getId(), "title" => $item->getTitle(), "artist" => $item->getArtist()]);
        }
        return new JsonModel(["response" => $data]);
    }

    public function get($id) {
        $item = $this->entityManager->find('Album\\Entity\\Album', $id);
        if ($item) {
            return new JsonModel(["response" => ["id" => $item->getId(), "title" => $item->getTitle(), "artist" => $item->getArtist()]]);
        } else {
            return new JsonModel(["response" => "Item not found"]);
        }
    }

    public function create($data)
    {
        $album = new Album();
        $album->setTitle($data['title']);
        $album->setArtist($data['artist']);

        $this->entityManager->persist($album);
        $this->entityManager->flush();

        return new JsonModel(["response" => "Item created successfully."]);
    }

    public function update($id, $data)
    {
        $album = $this->entityManager->find('Album\\Entity\\Album', $id);

        $album->setTitle($data['title']);
        $album->setArtist($data['artist']);

        $this->entityManager->flush();

        return new JsonModel(["response" => "Item updated successfully."]);
    }

    public function delete($id)
    {
        $album = $this->entityManager->find('Album\\Entity\\Album', $id);
        $this->entityManager->remove($album);
        $this->entityManager->flush();

        return new JsonModel(["response" => "Item deleted successfully."]);
    }
}