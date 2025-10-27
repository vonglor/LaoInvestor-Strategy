
<?php


if (! function_exists('format_percent')) {
    function format_percent($value, $total)
    {

        if ($total == 0) {
            // ໃຊ້ number_format ເພື່ອຮັບປະກັນວ່າ 0 ຖືກ format ຖືກຕ້ອງ
            return number_format(0, 2, '.', ',') . '%';
        }
        // 1. ຄູນດ້ວຍ 100
        $percentage = ($value/$total) * 100;

        // 2. Format ດ້ວຍ number_format()
        $formatted = number_format($percentage, 2, '.', ',');

        // 3. ເພີ່ມເຄື່ອງໝາຍ %
        return $formatted . '%';
    }
}

if (! function_exists('format_currency')) {
    function format_currency($value)
    {


        // 2. Format ດ້ວຍ number_format()
        $formatted = number_format($value, 2, '.', ',');

        // 3. ເພີ່ມເຄື່ອງໝາຍ %
        return "$".$formatted;
    }
}

if (! function_exists('format_risk_per_trade')) {
    function format_risk_per_trade($value)
    {


        // 2. Format ດ້ວຍ number_format()
        $formatted = number_format($value, 2, '.', ',');

        // 3. ເພີ່ມເຄື່ອງໝາຍ %
        return $formatted."%";
    }
}