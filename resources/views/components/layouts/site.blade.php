@props([
    'title' => null,
    'description' => 'Finaza Microcare (Finaza Micro Care Federation of India) supports small businesses, women groups and families in Patna, Bihar with micro business support, livelihood support and financial literacy.',
    'image' => null,
    'crumbs' => [],
    'schema' => [],
])
@php
    $siteName = config('site.name');
    $company = config('site.company');
    $address = config('site.address_parts');
    $pageTitle = $title ? $title.' | '.$siteName : $siteName.' | Micro Business & Livelihood Support in Patna, Bihar';
    $canonical = url()->current();
    $ogImage = asset($image ?? 'images/brand/og-image.jpg');

    $organization = array_filter([
        '@context' => 'https://schema.org',
        '@type' => 'FinancialService',
        '@id' => url('/').'#organization',
        'name' => $siteName,
        'legalName' => $company['legal_name'],
        'url' => url('/'),
        'logo' => asset('images/brand/logo.png'),
        'image' => asset('images/brand/og-image.jpg'),
        'description' => $description,
        'telephone' => $contact['phoneIntl'],
        'email' => config('site.email'),
        'foundingDate' => $company['incorporated_on'],
        'identifier' => ['@type' => 'PropertyValue', 'propertyID' => 'CIN', 'value' => $company['cin']],
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => $address['street'],
            'addressLocality' => $address['locality'],
            'addressRegion' => $address['region'],
            'postalCode' => $address['postal_code'],
            'addressCountry' => $address['country'],
        ],
        'areaServed' => [['@type' => 'City', 'name' => 'Patna'], ['@type' => 'State', 'name' => 'Bihar']],
        'hasMap' => $contact['mapsUrl'],
        'contactPoint' => [[
            '@type' => 'ContactPoint',
            'telephone' => $contact['phoneIntl'],
            'contactType' => 'customer service',
            'areaServed' => 'IN',
            'availableLanguage' => ['Hindi', 'English'],
        ]],
    ]);

    $jsonLd = [$organization, ...$schema];

    if ($crumbs) {
        $items = [['@type' => 'ListItem', 'position' => 1, 'name' => 'Home', 'item' => route('home')]];
        foreach (array_keys($crumbs) as $index => $label) {
            $items[] = ['@type' => 'ListItem', 'position' => $index + 2, 'name' => $label, 'item' => $crumbs[$label]];
        }
        $jsonLd[] = ['@context' => 'https://schema.org', '@type' => 'BreadcrumbList', 'itemListElement' => $items];
    }

    $navigation = [
        'Home' => route('home'),
        'About' => route('about'),
        'Services' => route('services'),
        'Contact' => route('contact'),
    ];
@endphp
<!DOCTYPE html>
<html lang="en-IN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <title>{{ $pageTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <meta name="theme-color" content="#13254f">
    <meta name="geo.region" content="IN-BR">
    <meta name="geo.placename" content="Patna">

    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_IN">
    <meta property="og:site_name" content="{{ $siteName }}">
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ $ogImage }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ $ogImage }}">

    <link rel="icon" href="{{ asset('favicon.ico') }}" sizes="48x48">
    <link rel="icon" href="{{ asset('images/brand/icon.svg') }}" type="image/svg+xml">
    <link rel="apple-touch-icon" href="{{ asset('images/brand/apple-touch-icon.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    {{ $head ?? '' }}

    <script>document.documentElement.classList.add('js')</script>
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script type="application/ld+json">{!! json_encode($jsonLd, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) !!}</script>
</head>
<body class="min-h-screen overflow-x-hidden">
    <a href="#main" class="sr-only z-[60] rounded-lg bg-white px-4 py-2 font-medium text-navy-900 focus:not-sr-only focus:fixed focus:top-3 focus:left-3">Skip to content</a>

    <header class="site-header fixed inset-x-0 top-0 z-50 transition duration-300" data-header>
        <div class="container-x flex h-20 items-center justify-between gap-4">
            <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ $siteName }} home">
                <x-brand-icon id="hdr" class="size-11 drop-shadow-md" />
                <span class="brand-name leading-none text-white transition">
                    <span class="block font-display text-xl font-bold tracking-[.06em]">FINAZA</span>
                    <span class="mt-1 block font-display text-[.62rem] font-semibold tracking-[.48em] text-gold-400">MICROCARE</span>
                </span>
            </a>

            <nav class="hidden items-center gap-1 lg:flex" aria-label="Main">
                @foreach ($navigation as $label => $url)
                    <a href="{{ $url }}" @class([
                        'nav-link relative rounded-full px-4 py-2 text-sm font-medium transition after:absolute after:inset-x-4 after:-bottom-0.5 after:h-0.5 after:origin-left after:rounded-full after:bg-gold-400 after:transition hover:after:scale-x-100',
                        'text-white after:scale-x-0' => url()->current() !== $url,
                        'text-gold-300 after:scale-x-100' => url()->current() === $url,
                    ]) @if (url()->current() === $url) aria-current="page" @endif>{{ $label }}</a>
                @endforeach
            </nav>

            <div class="flex items-center gap-2">
                <a href="tel:{{ $contact['phoneIntl'] }}" class="nav-link hidden items-center gap-2 rounded-full px-3 py-2 text-sm font-semibold text-white transition xl:inline-flex">
                    <i data-lucide="phone-call" class="size-4 text-gold-400"></i> {{ $contact['phoneDisplay'] }}
                </a>
                <a href="{{ route('contact') }}#enquiry" class="btn btn-gold hidden px-5 py-2.5 text-sm sm:inline-flex">Enquire Now</a>
                <button type="button" class="nav-link grid size-11 place-items-center rounded-full text-white lg:hidden" data-nav-toggle aria-expanded="false" aria-controls="mobile-nav" aria-label="Open menu">
                    <i data-lucide="menu" class="size-6"></i>
                </button>
            </div>
        </div>

        <div id="mobile-nav" class="fixed inset-0 top-0 z-50 hidden bg-navy-950/98 backdrop-blur-xl lg:hidden" data-nav-panel>
            <div class="container-x flex h-20 items-center justify-between">
                <span class="flex items-center gap-3">
                    <x-brand-icon id="mnav" class="size-11" />
                    <span class="font-display text-xl font-bold tracking-[.06em] text-white">FINAZA</span>
                </span>
                <button type="button" class="grid size-11 place-items-center rounded-full text-white" data-nav-toggle-close onclick="document.querySelector('[data-nav-toggle]').click()" aria-label="Close menu">
                    <i data-lucide="x" class="size-6"></i>
                </button>
            </div>
            <nav class="container-x mt-6 flex flex-col gap-1" aria-label="Mobile">
                @foreach ($navigation as $label => $url)
                    <a href="{{ $url }}" class="flex items-center justify-between border-b border-white/10 py-4 font-display text-2xl font-semibold text-white">
                        {{ $label }} <i data-lucide="arrow-up-right" class="size-5 text-gold-400"></i>
                    </a>
                @endforeach
                <div class="mt-8 grid gap-3">
                    <a href="{{ route('contact') }}#enquiry" class="btn btn-gold">Enquire Now</a>
                    <a href="tel:{{ $contact['phoneIntl'] }}" class="btn btn-ghost-light"><i data-lucide="phone" class="size-4"></i> {{ $contact['phoneDisplay'] }}</a>
                </div>
            </nav>
        </div>
    </header>

    <main id="main">
        {{ $slot }}
    </main>

    <footer class="relative overflow-hidden bg-navy-950 text-navy-100/75">
        <div class="absolute -top-40 left-1/2 size-[36rem] -translate-x-1/2 rounded-full bg-navy-700/30 blur-3xl"></div>
        <div class="container-x relative grid gap-12 py-16 sm:grid-cols-2 lg:grid-cols-12 lg:py-20">
            <div class="lg:col-span-4">
                <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ $siteName }} home">
                    <x-brand-icon id="ftr" class="size-12" />
                    <span class="leading-none">
                        <span class="block font-display text-2xl font-bold tracking-[.06em] text-white">FINAZA</span>
                        <span class="mt-1 block font-display text-[.66rem] font-semibold tracking-[.48em] text-gold-400">MICROCARE</span>
                    </span>
                </a>
                <p class="mt-5 max-w-sm text-sm leading-relaxed">{{ $company['legal_name'] }} supports small businesses, women groups and families with practical financial support and guidance, from our office in Patna, Bihar.</p>
                <div class="mt-6 flex gap-3">
                    <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-full bg-white/5 text-white ring-1 ring-white/10 transition hover:bg-[#25D366]" aria-label="Chat on WhatsApp"><x-whatsapp-icon class="size-5" /></a>
                    <a href="tel:{{ $contact['phoneIntl'] }}" class="grid size-10 place-items-center rounded-full bg-white/5 text-white ring-1 ring-white/10 transition hover:bg-gold-500 hover:text-navy-950" aria-label="Call us"><i data-lucide="phone" class="size-4"></i></a>
                    <a href="{{ $contact['mapsUrl'] }}" target="_blank" rel="noopener" class="grid size-10 place-items-center rounded-full bg-white/5 text-white ring-1 ring-white/10 transition hover:bg-gold-500 hover:text-navy-950" aria-label="Get directions"><i data-lucide="map-pin" class="size-4"></i></a>
                </div>
            </div>

            <div class="lg:col-span-2">
                <h2 class="font-display text-sm font-semibold tracking-[.14em] text-white uppercase">Company</h2>
                <ul class="mt-5 space-y-3 text-sm">
                    @foreach ($navigation as $label => $url)
                        <li><a href="{{ $url }}" class="transition hover:text-gold-300">{{ $label }}</a></li>
                    @endforeach
                    <li><a href="{{ route('privacy') }}" class="transition hover:text-gold-300">Privacy Policy</a></li>
                    <li><a href="{{ route('terms') }}" class="transition hover:text-gold-300">Terms of Use</a></li>
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h2 class="font-display text-sm font-semibold tracking-[.14em] text-white uppercase">What we do</h2>
                <ul class="mt-5 space-y-3 text-sm">
                    @foreach (config('site.services') as $key => $service)
                        <li><a href="{{ route('services') }}#{{ $key }}" class="transition hover:text-gold-300">{{ $service['title'] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <div class="lg:col-span-3">
                <h2 class="font-display text-sm font-semibold tracking-[.14em] text-white uppercase">Reach us</h2>
                <ul class="mt-5 space-y-4 text-sm">
                    <li class="flex gap-3"><i data-lucide="map-pin" class="mt-0.5 size-4 shrink-0 text-gold-400"></i><address class="not-italic leading-relaxed">{{ config('site.address') }}</address></li>
                    <li class="flex gap-3"><i data-lucide="phone" class="mt-0.5 size-4 shrink-0 text-gold-400"></i><a href="tel:{{ $contact['phoneIntl'] }}" class="hover:text-gold-300">{{ $contact['phoneDisplay'] }}</a></li>
                    @if (config('site.email'))
                        <li class="flex gap-3"><i data-lucide="mail" class="mt-0.5 size-4 shrink-0 text-gold-400"></i><a href="mailto:{{ config('site.email') }}" class="break-all hover:text-gold-300">{{ config('site.email') }}</a></li>
                    @endif
                    @if (config('site.hours'))
                        <li class="flex gap-3"><i data-lucide="clock" class="mt-0.5 size-4 shrink-0 text-gold-400"></i><span>{{ config('site.hours') }}</span></li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="relative border-t border-white/10">
            <div class="container-x flex flex-col gap-3 py-6 text-xs sm:flex-row sm:items-center sm:justify-between">
                <p>&copy; {{ now()->year }} {{ $company['legal_name'] }}. All rights reserved.</p>
                <p>CIN: <span class="font-medium text-navy-100">{{ $company['cin'] }}</span> &middot; {{ $company['registrar'] }}</p>
            </div>
        </div>
    </footer>

    <div class="fixed right-4 bottom-4 z-40 flex flex-col items-end gap-3 sm:right-6 sm:bottom-6">
        <a href="tel:{{ $contact['phoneIntl'] }}" class="grid size-13 place-items-center rounded-full bg-navy-900 text-white shadow-xl shadow-navy-900/30 transition hover:-translate-y-0.5 sm:hidden" aria-label="Call {{ $siteName }}">
            <i data-lucide="phone" class="size-5"></i>
        </a>
        <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="group relative grid size-14 place-items-center rounded-full bg-[#25D366] text-white shadow-xl shadow-emerald-900/25 transition hover:-translate-y-0.5" aria-label="Chat with us on WhatsApp">
            <span class="absolute inset-0 animate-pulse-ring rounded-full bg-[#25D366]"></span>
            <x-whatsapp-icon class="relative size-7" />
            <span class="pointer-events-none absolute right-full mr-3 hidden rounded-full bg-white px-3 py-1.5 text-xs font-semibold whitespace-nowrap text-navy-900 opacity-0 shadow-lg transition group-hover:opacity-100 sm:block">Chat on WhatsApp</span>
        </a>
    </div>

</body>
</html>
