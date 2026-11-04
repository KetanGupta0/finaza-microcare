<?php

return [
    'name' => env('SITE_NAME', 'Finaza Microcare'),

    // Launch moment shown on the countdown (Diwali 2026). ISO-8601 with offset.
    'launch_at' => env('SITE_LAUNCH_AT', '2026-11-08T00:00:00+05:30'),
    'timezone' => env('SITE_TIMEZONE', 'Asia/Kolkata'),

    // 10-digit Indian mobile number, without country code.
    'phone' => env('SITE_PHONE', '8009877918'),
    'country_code' => env('SITE_COUNTRY_CODE', '+91'),

    'address' => env('SITE_ADDRESS', "302, Third Floor, Parmeshwar Sadan, Opp. V Mart, Inden Gas Godam Gali, Krishna Chowk, Near Sant Karen's School, Main Gola Road, Patna – 801503"),
    'maps_query' => env('SITE_MAPS_QUERY', 'Parmeshwar Sadan Krishna Chowk Gola Road Patna 801503'),
];
