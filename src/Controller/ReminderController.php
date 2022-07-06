<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReminderController extends AbstractController
{
    #[
        Route(
            path: '/reminder',
            methods: 'POST'
        )
    ]
    public function __invoke(): Response
    {
        // TEST

        return $this->forward(WebsiteController::class);
    }
}
