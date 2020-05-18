<?php


namespace App\Repository\Backend\Interfaces;


interface OrderRepositoryInterface
{
    public function get($id, $sort = 'ASC');

}
