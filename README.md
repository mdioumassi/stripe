
#Module paiement Stripe

Pour le bon fonctionnement du module de paiement. Veuillez récupérer les clés sur votre compte stripe.com.

Nous avons deux clés:
- publicKey: testKey ou prodKey
- secretKey: testKey ou prodKey

Une fois les clés récupéres sur stripe.com, on les renseignent sur le fichier .env:

STRIPE_PUBLIC_KEY=publicKey

STRIPE_SECRET_KEY=secretKey