<?php

namespace Application\Controller;

class DefaultController extends AbstractController {

    public function indexAction()
    {
        $this->setTitle('SimpleMvcSkeletonApp');
        $this->setViewData(['greetings' => 'Welcome to SimpleMvc']);
    }

    public function notFoundAction()
    {
        header("HTTP/1.0 404 Not Found");
        $this->setTitle('404 - Not Found');
    }

}