<?php

namespace App\Controller\ApiKey;

use App\Controller\Website\HomeAction;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConfirmAction extends AbstractController
{
    #[
        Route(
            path: '/key/confirm',
            name: 'app_apikey_confirm',
            methods: 'GET'
        )
    ]
    public function __invoke(Request $request, ManagerRegistry $doctrine): Response
    {
        // @todo
        return $this->forward(HomeAction::class);
    }
}
