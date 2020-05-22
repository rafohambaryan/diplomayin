<?php


namespace App\Repository\Backend\Interfaces;


interface SubheadingManyRepositoryInterface
{
    public function get($data, $sub_id);

    public function createSubMany($data, $img);

    public function update($data, $img, $id);

    public function delete($present_id, $main_slide_id, $id);
}
