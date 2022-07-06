<?php

namespace App\Controller\Reminder;

use App\Controller\Website\HomeAction;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateAction extends AbstractController
{
    #[
        Route(
            path: '/reminder',
            name: 'app_reminder_create',
            methods: 'POST'
        )
    ]
    public function __invoke(): Response
    {
        // TEST

        return $this->forward(HomeAction::class);
    }
}
