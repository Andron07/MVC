<?php

class Pages extends Controller
{
    public function __construct()
    {
        $this->postModel = $this->model('Post');
    }

    public function index()
    {
        $data = [
            'title' => 'SharedPosts',
            'description' => 'Simple MVC framework built for Shared posts',
        ];
        $this->view('pages/index', $data);
    }

    public function about()
    {
        $data = [
            'title' => 'SharedPosts',
            'description' => 'App of Shared posts with other users.',
        ];
        $this->view('pages/about', $data);
    }
}
