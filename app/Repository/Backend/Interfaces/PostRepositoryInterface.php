<?php


namespace App\Repository\Backend\Interfaces;

interface PostRepositoryInterface
{

    public function get($post_id);


    public function all($paginate = 5);


    public function delete($posts_id);


    public function create($data, $id);
}
