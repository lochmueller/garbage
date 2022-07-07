<?php

namespace App\Controller\Integration;

use App\Entity\Address;
use App\Form\Type\ApiRegistrationType;
use App\Form\Type\MailNotificationRegistrationType;
use App\Form\Type\SearchType;
use App\Service\GarbageInformationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OpenHabAction extends AbstractController
{
    #[
        Route(
            path: '/integration/openhab',
            name: 'app_integration_openhab',
            methods: ['GET']
        )
    ]
    public function __invoke(Request $request, GarbageInformationService $garbageInformationService): Response
    {

        return $this->render('integration/openhab.html.twig');
    }
}
