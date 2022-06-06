<?php

	// src/Controller/ApiController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Symfony\Component\RateLimiter\RateLimiterFactory;
use Symfony\Contracts\Cache\CacheInterface;

class ApiController extends AbstractController
{

	// @todo add route
    public function __invoke(
    	Request $request, // Move to listern for Address
    	RateLimiterFactory $fairUseLimiter, 
    	CacheInterface $resultCache
    ){

        // API Key here!
        $limiter = $fairUseLimiter->create($request->getClientIp());
		$limiter->consume(1)->ensureAccepted();

		// Handle reques
    }

    // ...
}