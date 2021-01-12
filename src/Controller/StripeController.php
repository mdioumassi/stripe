<?php

namespace App\Controller;

use App\Stripe\StripeService;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    /**
     * @Route("/payment/{amount}", name="payment-stripe")
     */
    public function showCardForm(StripeService $stripeService, $amount): Response
    {
        $intent = $stripeService->getPaymentIntent($amount);
        return $this->render('stripe/paiement.html.twig', [
            'clientSecret' => $intent->client_secret,
            'stripePublicKey' => $stripeService->getPublicKey()
        ]);
    }

    /**
     * @Route("/confirm", name="confirm-payment")
     */
    public function confirm()
    {
        return $this->render('stripe/confirm.html.twig');
    }
}
