<?php

return [
    'shipping_cost' => (int) env('TANIMART_SHIPPING_COST', 10000),

    'auto_complete_days' => (int) env('TANIMART_AUTO_COMPLETE_DAYS', 7),

    'admin_whatsapp' => preg_replace('/\D/', '', (string) env('TANIMART_ADMIN_WHATSAPP', '')),
];
