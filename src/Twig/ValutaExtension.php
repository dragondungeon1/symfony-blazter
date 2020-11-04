<?php

namespace App\Twig;

use Monolog\Handler\IFTTTHandler;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class ValutaExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('price', [$this, 'formatPrice']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('valuta', [$this, 'calculate']),

        ];
    }

    public function calculate($country, $Tuitition)
    {
//        $Tuitition = 100 ;
        $courseUSA = 1.17;
        $courseUK = 1.11;
        $courseEU = 1;
        $course = $courseUSA;

        switch ($country){
            case 'USA':
                 $course = $courseUSA;
                break;
            case 'UK':
                 $course = $courseUK;
                break;
            case 'EU':
                 $course = $courseEU;
                break;
                   }
        $CalcTuitition = $Tuitition * $course;
        return $CalcTuitition;
    }


//
//    public function formatPrice($number, $decimals = 0, $decPoint = '.', $thousandsSep = ',')
//    {
//        $price = number_format($number,$decimals, $decPoint, $thousandsSep);
//        $price = '$'.$price;
//        return $price;
//    }


}
