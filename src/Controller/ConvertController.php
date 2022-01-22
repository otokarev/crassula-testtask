<?php

namespace App\Controller;

use App\Model\ConvertorService;
use Brick\Money\Money;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ConvertController
{
    public function __construct(private ConvertorService $convertor) {}
   /**
    * @Route("/convert/{from}/{to}/{amount}")
    */
    public function number($from, $to, $amount): Response
    {
        return new Response(
            (string)$this->convertor->convert(Money::of($amount, $from), $to)->getAmount()
        );
    }
}
