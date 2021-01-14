<?php

namespace App\Controller;

use App\Stripe\StripeService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StripeController extends AbstractController
{
    /**
     * On affiche le formulaire de paiement sripe
     *
     * @Route("/payment", name="payment-stripe")
     * @param StripeService $stripeService
     * @param SessionInterface $session
     * @return Response
     * @throws \Stripe\Exception\ApiErrorException
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
     * Message de confirmation paiement
     *
     * @Route("/confirm", name="confirm-payment")
     */
    public function confirm()
    {
        return $this->render('stripe/confirm.html.twig');
    }
}
