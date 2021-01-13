<?php


namespace App\Stripe;


class StripeService
{
    protected $secretKey;
    protected $publicKey;

    /**
     * StripeService constructor.
     * @param string $secretKey
     * @param string $publicKey
     */
    public function __construct(string $secretKey, string $publicKey)
    {
        $this->secretKey = $secretKey;
        $this->publicKey = $publicKey;
    }

    /**
     * @return string
     */
    public function getPublicKey() :string
    {
        return $this->publicKey;
    }

    /**
     * @param $amount
     * @return \Stripe\PaymentIntent
     * @throws \Stripe\Exception\ApiErrorException
     */
    public function getPaymentIntent($amount)
    {
        \Stripe\Stripe::setApiKey($this->secretKey);

        return \Stripe\PaymentIntent::create([
            'amount' => $amount * 100,
            'currency' => 'eur'
        ]);
    }

    public function cancelPayment($amount)
    {
        \Stripe\Stripe::setApiKey($this->secretKey);

        $intent = \Stripe\PaymentIntent::retrieve('pi_570etAgFdjhYz9568rFG');
        return $intent->cancel();
    }
}