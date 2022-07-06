<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiKeyController extends AbstractController
{
    #[
        Route(
            path: '/key',
            methods: 'POST'
        )
    ]
    public function __invoke(): Response
    {
        // TEST

        return $this->forward(WebsiteController::class);
    }
}
