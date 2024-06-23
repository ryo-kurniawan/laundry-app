<?php

if (!function_exists('format_currency')) {
    function format_currency($amount, $currency = 'IDR')
    {
        $formatter = new NumberFormatter('id_ID', NumberFormatter::CURRENCY);

        // Format mata uang
        $formattedAmount = $formatter->formatCurrency($amount, $currency);

        // Menghapus dua angka 0 terakhir
        $formattedAmount = rtrim($formattedAmount, '0');

        // Jika perlu, juga hilangkan titik desimal terakhir jika hanya berisi desimal
        $formattedAmount = rtrim($formattedAmount, ',');

        // Menambahkan tanda titik setelah simbol mata uang "Rp"
        $formattedAmount = str_replace('Rp', 'Rp.', $formattedAmount);

        return $formattedAmount;
    }
}
