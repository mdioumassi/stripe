<?php


namespace App\Stripe;


class StripeService
{
    protected $secretKey;
    protected $publicKey;

    public function __construct(string $secretKey, string $publicKey)
    {
        $this->secretKey = $secretKey;
        $this->publicKey = $publicKey;
    }

    public function getPublicKey() :string
    {
        return $this->publicKey;
    }

    public function getPaymentIntent($amount)
    {
        \Stripe\Stripe::setApiKey($this->secretKey);

        return \Stripe\PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur'
        ]);
    }
}