<?php

namespace Livraria\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Helper\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $name = "Thyago Stall";
        return array("name" => $name);
    }
}