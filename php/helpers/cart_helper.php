<?php
namespace helpers;

class CartHelper {
     
    /**
     * 
    */
    public static function getSubtotal($price): float {
        return $price > 0 ? number_format($price, 2) : 0;
    }
    
    /**
     * 
    */
    public static function getTotal(array $cartItems) {
        $total = 0;
        foreach($cartItems as $cart) {
            $total += ( $cart['subtotal'] * $cart['qty']);
        }
        $result = ($total > 0) ? number_format($total, 2): 0;

        return $result;
    }

    /**
     * calcular intereses con el 10% anual
     * @return float
    */
    public static function calculateMonthly($price, $months, $interesAnual = 10.00) : float {
        $r = ($interesAnual / 100) / 12;
        $n = $months <= 0 ? 1 : $months;
        if ($r == 0) return $price / $n;

        $monthly = $price * ($r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);

        return round($monthly, 2);
    }
    
}