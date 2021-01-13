<?php

namespace App\Controller;

use App\Form\CommandType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommandController extends AbstractController
{
    /**
     * @Route("/", name="command", methods={"GET", "POST"})
     */
    public function index(Request $request, SessionInterface $session): Response
    {
        $session->start();
        $form = $this->createForm(CommandType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
           $amount = $form->getData()['amount'];
           $session->set('amount', $amount);
           return
              $this->redirectToRoute('payment-stripe');
        }
        return $this->render('command/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
