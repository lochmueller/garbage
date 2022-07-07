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

class HomeAction extends AbstractController
{
    #[
        Route(
            path: '/',
            name: 'app_website_home',
            methods: ['GET', 'POST']
        )
    ]
    public function __invoke(Request $request, GarbageInformationService $garbageInformationService): Response
    {
        // TEST
        $data = new Address();
        $form = $this->createForm(SearchType::class, $data);
        $form->handleRequest($request);

        $showResults = false;
        $result = [];
        if ($form->isSubmitted() && $form->isValid()) {
            $result = $garbageInformationService->fetchGarbageInformation($data);
            $showResults = true;
        }

        $params = [
            'showResults' => $showResults,
            'result' => $result,
            'searchForm' => $form->createView(),
            'apiKeyForm' => $this->createForm(ApiRegistrationType::class)->createView(),
            'reminderForm' => $this->createForm(MailNotificationRegistrationType::class)->createView(),
        ];

        return $this->render('website/home.html.twig', $params);
    }
}
