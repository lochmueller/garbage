<?php

namespace App\Controller\ApiKey;

use App\Controller\Website\HomeAction;
use App\Entity\ApiKey;
use App\Form\Type\ApiRegistrationType;
use Doctrine\Persistence\ManagerRegistry;
use Keygen\Keygen;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateAction extends AbstractController
{
    #[
        Route(
            path: '/key/create',
            name: 'app_apikey_create',
            methods: 'POST'
        )
    ]
    public function __invoke(Request $request, ManagerRegistry $doctrine): Response
    {
        // TEST
        $data = new ApiKey();
        $form = $this->createForm(ApiRegistrationType::class, $data);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data->key = Keygen::alphanum(64)->generate();

            $entityManager = $doctrine->getManager();
            $entityManager->persist($data);
            $entityManager->flush();

            // @todo Send E-Mail

            $this->addFlash(
                'notice',
                'Your changes were saved!'
            );

            return $this->forward(HomeAction::class);
        }

        return $this->forward(HomeAction::class);
    }
}
