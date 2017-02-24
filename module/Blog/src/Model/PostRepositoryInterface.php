<?php
/**
 * Created by PhpStorm.
 * User: thyago
 * Date: 23/02/2017
 * Time: 21:39
 */

namespace Blog\Model;


interface PostRepositoryInterface
{
    /**
     * @return Post[]
     */
    public function findAllPosts();

    /**
     * @param int $id
     * @return Post
     */
    public function findPost($id);
}