<?php
namespace App\PostFactory;
interface PostFactoryInterface
{
    public function validation($data);
    public function createPost($data);
    public function likePost($post_id);
    public function getPost($post_id);

}