<?php

namespace App\Controller\Website;

use App\Entity\Address;
use App\Form\Type\ApiRegistrationType;
use App\Form\Type\MailNotificationRegistrationType;
use App\Form\Type\SearchType;
use App\Service\GarbageInformationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiAction extends AbstractController
{
    #[
        Route(
            path: '/api-access',
            name: 'app_website_api',
            methods: ['GET']
        )
    ]
    public function __invoke(Request $request, GarbageInformationService $garbageInformationService): Response
    {

        return $this->render('website/api.html.twig');
    }
}
