<?php


namespace App\Repository\Backend\Interfaces;


use App\Services\Backend\PostService;

interface SubheadingRepositoryInterface
{
    public function get($present_id, $sub_id);

}
