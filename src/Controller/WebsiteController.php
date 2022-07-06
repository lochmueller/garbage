<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\Type\ApiRegistrationType;
use App\Form\Type\MailNotificationRegistrationType;
use App\Form\Type\SearchType;
use App\Service\GarbageInformationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormView;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WebsiteController extends AbstractController
{
    #[
        Route(
            path: '/',
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
            'searchForm' => $this->getForm(SearchType::class),
            'apiKeyForm' => $this->getForm(ApiRegistrationType::class),
            'reminderForm' => $this->getForm(MailNotificationRegistrationType::class),
        ];

        return $this->render('website.html.twig', $params);
    }

    protected function getForm(string $type): FormView
    {
        return $this->createForm($type)->createView();
    }
}
