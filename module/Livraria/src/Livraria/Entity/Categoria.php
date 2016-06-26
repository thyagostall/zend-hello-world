<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 6/25/16
 * Time: 11:23 PM
 */

namespace Livraria\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="categorias")
 */
class Categoria
{
    protected $id;
    protected $nome;
}