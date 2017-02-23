<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 23/02/2017
 * Time: 20:26
 */

namespace Blog;


class Module
{
    public function getConfig()
    {
        return include __DIR__  . '/../config/module.config.php';
    }
}