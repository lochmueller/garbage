<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;

class FetchAction extends AbstractController
{
    #[
        Route(
            name: 'ApiFetch',
            path: '/api/fetch',
            methods: 'POST',
            schemes: ['https']
        )
    ]
    public function __invoke(
        Request $request, // Move to listener for Address
        RateLimiterFactory $fairUseLimiter,
        CacheInterface $resultCache
    ) {
        // API Key here!
        // $limiter = $fairUseLimiter->create($request->getClientIp());
        // $limiter->consume(1)->ensureAccepted();

        // Handle reques
    }
}
