<?php

use Phalcon\Mvc\Controller;

session_start();
class IndexController extends Controller
{
    public function indexAction()
    {
        $_SESSION['token'] = $this->apiUrl->api()->access_token;
    }
}
