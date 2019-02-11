<?php

namespace App\PostFactory;

require_once __DIR__ . "/TextFactory.php";
require_once __DIR__ . "/PollsFactory.php";
require_once __DIR__ . "/MediaFactory.php";
class PostFactory
{
    public $post;

    public function __construct($post_type)
    {
        if ($post_type == 'media'){
            $this->post = new MediaFactory();
        }elseif ($post_type == 'polls'){
            $this->post = new PollsFactory();
        }elseif ($post_type == 'texts'){
            $this->post = new TextFactory();
        }
    }

    public function createPost($data)
    {
        return $this->post->createPost($data);
    }

    public function getPost($post_id)
    {
        return $this->post->getPost($post_id);
    }

    public function likePost($post_id)
    {
        return $this->post->likePost($post_id);
    }
}