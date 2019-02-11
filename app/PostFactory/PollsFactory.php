<?php
namespace App\PostFactory;

require_once __DIR__ . "/PostFactoryInterface.php";
require_once __DIR__ . "/../Models/polls.php";
class PollsFactory implements PostFactoryInterface
{
    /**
     * @var \App\Models\polls
     */
    public $model;

    public function __construct()
    {
        $this->model = new \App\Models\polls();
    }
    public function createPost($data)
    {
        // If you have same method, you can use abstract class instead of Interface to avoid duplication.
        $data = $this->validation($data);
        return $this->model->createPoll($data);
    }

    public function likePost($post_id)
    {
        // If you have same method, you can use abstract class instead of Interface to avoid duplication.
        $post = $this->model->getPoll($post_id);
        $data['likes'] = $post['likes']+1;
        $result = $this->model->updatePoll($data,$post_id);
        return $result;
    }

    public function getPost($post_id)
    {
        // If you have same method, you can use abstract class instead of Interface to avoid duplication.
        return $this->model->getPoll($post_id);
    }

    public function validation($data)
    {
        // You can create dedicated validation for the Polls here.
        return $data;
    }
}