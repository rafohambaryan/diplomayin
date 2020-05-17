<?php


namespace App\Repository\Backend;


use App\Repository\Backend\Interfaces\PostRepositoryInterface;
use App\Services\Backend\PostService;

class PostRepository implements PostRepositoryInterface
{
    private $post;

    public function __construct(PostService $postService)
    {
        $this->post = $postService;
    }

    public function get($post_id)
    {
        return $this->post->getFind($post_id);
    }


    public function all($paginate = 5)
    {
        return $this->post->getAll($paginate);
    }


    public function delete($posts_id)
    {
        foreach ($posts_id as $present) {
            $this->post->deletePresent($present);
        }
        return ['deleted'];
    }


    public function create($data, $id)
    {
        return $this->post->create($data['name'], $id);
    }
}
