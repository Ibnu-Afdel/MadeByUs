<?php

return [
  'secret_key' => env('CHAPA_SECRET_KEY'),
  'public_key' => env('CHAPA_PUBLIC_KEY'),
  'base_url' => env('CHAPA_BASE_URL'),
  'callback_url' => env('CHAPA_CALLBACK_URL'),
  'premium_price' => env('PREMIUM_PRICE', 500)
];
