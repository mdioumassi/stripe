<?php

namespace App\Controller;

use App\Stripe\StripeService;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    /**
     * @Route("/payment", name="payment-stripe")
     */
    public function showCardForm(StripeService $stripeService, SessionInterface $session): Response
    {
        $session->start();
        $amount = $session->get('amount');
        $intent = $stripeService->getPaymentIntent($amount);
        return $this->render('stripe/paiement.html.twig', [
            'clientSecret' => $intent->client_secret,
            'amount' => $amount,
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

    /**
     * @Route("/cancel", name="confirm-payment")
     */
   /* public function cancelPayment (StripeService $stripeService)
    {
        if ($stripeService->cancelPayment()) {
            $this->redirectToRoute("command");
        }
    }*/
}
