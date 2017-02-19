<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 18/02/2017
 * Time: 21:07
 */

namespace Album\Controller;


use Album\Model\Album;
use Album\Model\AlbumTable;
use Zend\Mvc\Controller\AbstractRestfulController;
use Zend\View\Helper\Json;
use Zend\View\Model\JsonModel;

class AlbumRestController extends AbstractRestfulController
{
    protected $collectionOptions = ['GET', 'POST'];
    protected $resourceOptions = ['GET', 'PUT', 'DELETE'];

    private $table;

    public function __construct(AlbumTable $table)
    {
        $this->table = $table;
    }

    public function options()
    {
        if ($this->params()->fromRoute('id', 0)) {
            return new JsonModel(["options" => $this->resourceOptions]);
        }

        return new JsonModel(["options" => $this->collectionOptions]);
    }

    public function getList()
    {
        $data = [];
        foreach ($this->table->fetchAll() as $item) {
            array_push($data, $item);
        }
        return new JsonModel(["response" => $data]);
    }

    public function get($id) {
        return new JsonModel(["response" => $this->table->getAlbum($id)]);
    }

    public function create($data)
    {
        $album = new Album();
        $album->exchangeArray($data);
        $this->table->saveAlbum($album);
        return new JsonModel(["response" => "Item created successfully."]);
    }

    public function update($id, $data)
    {
        $album = new Album();
        $album->exchangeArray($data);
        $album->id = $id;
        $this->table->saveAlbum($album);
        return new JsonModel(["response" => "Item updated successfully."]);
    }

    public function delete($id)
    {
        $this->table->deleteAlbum($id);
        return new JsonModel(["response" => "Item deleted successfully."]);
    }
}