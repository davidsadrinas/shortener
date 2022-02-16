<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index() {
        $products = [
            ['Milk', '1.25', 2],
            ['Eggs', '4.99', 1],
            ['Granulated sugar', '1.25', 1],
            ['Broccoli', '2.34', 3],
            ['Chocolate bar', '1.25', 5],
            ['Organic All-purpose flour', '4.99', 2]
        ];
        return $this->orderByPrice($products);
    }
    private function orderByPrice($products)
    {
        $productsCount = count($products);//6
        for($i = 0; $i < $productsCount; $i++){
            for($j = 0; $j < $productsCount-1; $j++){
                if($products[$i][1] < $products[$j+1][1]) {
                    $arr = $products[$j];
                    $products[$j] = $products[$j+1];
                    $products[$j+1] = $arr;
                }elseif($products[$i][1] == $products[$j+1][1]){
                    if($products[$i][2] < $products[$j+1][2]) {
                        $arr = $products[$j];
                        $products[$j] = $products[$j+1];
                        $products[$j+1] = $arr;
                    }
                }
            }
        }
        return array_reverse($products);
    }
}
