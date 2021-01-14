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
    public function getPublicKey(): string
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

    public function refundPayment()
    {
        \Stripe\Stripe::setApiKey($this->secretKey);

        return \Stripe\Refund::create([
            'amount' => 100,
            'payment_intent' => 'pi_1I8kefI9xYefOdXp1r2B7R3M',
        ]);
    }
}
