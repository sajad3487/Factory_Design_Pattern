<?php


namespace App;

require_once __DIR__ . "/PostFactory/PostFactory.php";

use App\PostFactory\PostFactory;
use PHPUnit\Framework\TestCase;

class TestFactory extends TestCase
{
    public function testCreateTextPost()
    {
        $post = new PostFactory('text');

        $text_data['title'] = 'This is a test title';
        $text_data['body'] = 'This is a test body for a text post';
        $text_data['keywords'] = 'test, factory_design_pattern, text_post';
        $text_data['tags'] = 'test, factory_design_pattern, text_post';
        $text_data['likes'] = 5;
        $text_data['views'] = 1000;
        $text_data['status'] = 1;
        $text_post = $post->createPost($text_data);
        $this->assertEquals($text_post,$post->getPost($text_post['id']));
    }
    public function testCreateMediaPost()
    {
        $post = new PostFactory('media');

        $media_data['caption'] = 'This is a test caption';
        $media_data['path'] = '/images/test_image.jpg';
        $media_data['tags'] = 'test, factory_design_pattern, media_post';
        $media_data['likes'] = 5;
        $media_data['views'] = 1000;
        $media_data['status'] = 1;
        $media_post = $post->createPost($media_data);
        $this->assertEquals($media_post,$post->getPost($media_post['id']));
    }
    public function testCreatePollsPost()
    {
        $post = new PostFactory('polls');

        $polls_data['title'] = 'This is a test caption';
        $polls_data['question_one'] = 'Question 1';
        $polls_data['question_two'] = 'Question 2';
        $polls_data['question_three'] = 'Question 3';
        $polls_data['question_four'] = 'Question 4';
        $polls_data['likes'] = 5;
        $polls_data['views'] = 1000;
        $polls_data['status'] = 1;
        $media_post = $post->createPost($polls_data);
        $this->assertEquals($media_post,$post->getPost($media_post['id']));
    }
    public function testLikePost()
    {
        $post = new PostFactory('text');
        $text_post = $post->getPost(1);
        $post->likePost($text_post['id']);
        $updated_post = $post->getPost($text_post['id']);
        $this->assertEquals($updated_post['likes'],$text_post['likes']+1);
    }

}