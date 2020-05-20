<?php


namespace App\Repository\Backend\Interfaces;


use App\Services\Backend\PostService;

interface SubheadingRepositoryInterface
{
    public function get($sub_id);

    public function delete($sub_id);

    public function createUpdate($data, $img);

}
