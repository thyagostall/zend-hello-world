<?php

namespace Livraria\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $categorias = array("primeira", "segunda", "terceira");
        return array("categorias" => $categorias);
    }
}