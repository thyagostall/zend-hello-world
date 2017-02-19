<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 07/02/2017
 * Time: 22:49
 */

namespace Album\Controller;


use Album\Entity\Album;
use Album\Form\AlbumForm;
use Doctrine\ORM\EntityManager;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AlbumController extends AbstractActionController
{
    protected $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function indexAction()
    {
        $albums = [];
        foreach ($this->entityManager->getRepository('Album\\Entity\\Album')->findAll() as $item) {
            array_push($albums, $item);
        }

        return new ViewModel([
            'albums' => $albums,
        ]);
    }

    public function addAction()
    {
        $form = new AlbumForm();
        $form->get('submit')->setValue('Add');

        $request = $this->getRequest();

        if (!$request->isPost()) {
            return ['form' => $form];
        }

        $album = new Album();
        $form->setInputFilter($form->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return ['form' => $form];
        }

        $album->exchangeArray($form->getData());
        $this->entityManager->persist($album);
        $this->entityManager->flush();
        return $this->redirect()->toRoute('album');
    }

    public function editAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);

        if (0 === $id) {
            return $this->redirect()->toRoute('album', ['action' => 'add']);
        }

        try {
            $album = $this->entityManager->find('Album\\Entity\\Album', $id);
        } catch (\Exception $e) {
            return $this->redirect()->toRoute('album', ['action' => 'index']);
        }

        $form = new AlbumForm();
        $form->bind($album);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];

        if (!$request->isPost()) {
            return $viewData;
        }

        $form->setInputFilter($form->getInputFilter());
        $form->setData($request->getPost());

        if (!$form->isValid()) {
            return $viewData;
        }

        $this->entityManager->flush();
        return $this->redirect()->toRoute('album', ['action' => 'index']);
    }

    public function deleteAction()
    {
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('album');
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'No');

            if ($del == 'Yes') {
                $id = (int) $request->getPost('id');
                $album = $this->entityManager->find('Album\\Entity\\Album', $id);
                $this->entityManager->remove($album);
                $this->entityManager->flush();
            }

            return $this->redirect()->toRoute('album');
        }

        return [
            'id' => $id,
            'album' => $this->entityManager->find('Album\\Entity\\Album', $id),
        ];
    }
}