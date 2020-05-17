<?php


namespace App\Repository\Backend\Interfaces;


interface MainSlideRepositoryInterface
{
    public function update($request);

    public function get($present_id);
}
