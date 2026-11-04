<?php

return [
    'name' => env('SITE_NAME', 'Finaza Microcare'),
    'tagline' => 'Grow · Save · Prosper',

    /*
     * When true, "/" shows the Diwali countdown page until "launch_at" passes.
     */
    'coming_soon' => (bool) env('SITE_COMING_SOON', false),

    // Launch moment shown on the countdown (Diwali 2026). ISO-8601 with offset.
    'launch_at' => env('SITE_LAUNCH_AT', '2026-11-08T00:00:00+05:30'),
    'timezone' => env('SITE_TIMEZONE', 'Asia/Kolkata'),

    // 10-digit Indian mobile numbers, without country code.
    'phone' => env('SITE_PHONE', '8009877918'),
    'whatsapp' => env('SITE_WHATSAPP', '8009877918'),
    'country_code' => env('SITE_COUNTRY_CODE', '+91'),

    // Optional: shown on the site and in search-engine data only when set.
    'email' => env('SITE_EMAIL'),
    'hours' => env('SITE_HOURS'),

    'address' => env('SITE_ADDRESS', "302, Third Floor, Parmeshwar Sadan, Opp. V Mart, Inden Gas Godam Gali, Krishna Chowk, Near Sant Karen's School, Main Gola Road, Patna – 801503"),
    'address_parts' => [
        'street' => '302, Third Floor, Parmeshwar Sadan, Opp. V Mart, Inden Gas Godam Gali, Krishna Chowk, Main Gola Road',
        'locality' => 'Patna',
        'region' => 'Bihar',
        'postal_code' => '801503',
        'country' => 'IN',
    ],
    'maps_query' => env('SITE_MAPS_QUERY', 'Parmeshwar Sadan Krishna Chowk Gola Road Patna 801503'),

    /*
     * Registered company details (Ministry of Corporate Affairs records).
     */
    'company' => [
        'legal_name' => 'Finaza Micro Care Federation of India',
        'cin' => 'U65100BR2022NPL057169',
        'incorporated_on' => '2022-03-30',
        'registrar' => 'Registrar of Companies, Patna',
        'category' => 'Company limited by shares',
        'class' => 'Private, Non-government company',
        'activity' => 'Monetary intermediation (NIC 651)',
    ],

    /*
     * Services shown on the website and offered in the enquiry form.
     * The array key is stored with each lead.
     */
    'services' => [
        'micro-business-loan' => [
            'title' => 'Micro Business Support',
            'icon' => 'store',
            'image' => 'images/photos/shopkeeper-beverage-stall.webp',
            'summary' => 'Small-ticket financial support for kirana stores, street vendors, artisans and home-based businesses to buy stock and grow.',
            'points' => ['Working capital for daily business needs', 'Simple documentation', 'Repayment planned around your income'],
        ],
        'women-group-support' => [
            'title' => 'Women Group Support',
            'icon' => 'users-round',
            'image' => 'images/photos/rural-woman-portrait.webp',
            'summary' => 'Support for women entrepreneurs and self-help groups, so that every member can build income and confidence together.',
            'points' => ['Group-based model with shared support', 'Regular group meetings and guidance', 'Focus on women-led livelihoods'],
        ],
        'livelihood-support' => [
            'title' => 'Livelihood & Agri Support',
            'icon' => 'sprout',
            'image' => 'images/photos/fruit-cart-vendor.webp',
            'summary' => 'Support for farming, dairy, livestock and other rural livelihood activities that keep families moving forward.',
            'points' => ['For seasonal and allied activities', 'Guidance from people who know the region', 'Plans that respect harvest cycles'],
        ],
        'financial-literacy' => [
            'title' => 'Financial Literacy & Guidance',
            'icon' => 'graduation-cap',
            'image' => 'images/photos/woman-entrepreneur-tablet.webp',
            'summary' => 'Easy, practical sessions on budgeting, savings habits, digital payments and responsible borrowing.',
            'points' => ['Budgeting and saving habits', 'Safe use of digital payments', 'Understanding credit before you borrow'],
        ],
    ],
];
