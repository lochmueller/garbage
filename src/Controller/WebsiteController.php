<?php

namespace App\Controller;

use App\Entity\Address;
use App\Entity\ApiKey;
use App\Entity\Reminder;
use App\Form\Type\ApiRegistrationType;
use App\Form\Type\MailNotificationRegistrationType;
use App\Form\Type\SearchType;
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
        $params = [
            'apiKeyForm' => $this->createForm(ApiRegistrationType::class, new ApiKey())->createView(),
            'reminderForm' => $this->createForm(MailNotificationRegistrationType::class, new Reminder())->createView(),
            'searchForm' => $this->createForm(SearchType::class, new Address())->createView(),
        ];

        return $this->render('website.html.twig', $params);
    }
}
