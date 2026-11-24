<?php

return [
    // Nomor WhatsApp admin untuk tombol "Hubungi Admin" (format internasional tanpa +, mis. 628123456789).
    // Kosong = tombol disembunyikan. Isi di .env masing-masing, jangan di-commit.
    'admin_whatsapp' => preg_replace('/\D/', '', (string) env('TANIMART_ADMIN_WHATSAPP', '')),
];
