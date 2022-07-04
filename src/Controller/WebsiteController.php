<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebsiteController extends AbstractController
{
    #[
        Route(
            path: '/',
            methods: 'GET'
        )
    ]
    public function __invoke(): Response
    {
        return $this->render('website.html.twig', []);
    }
}
