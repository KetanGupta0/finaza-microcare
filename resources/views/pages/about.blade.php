@php
    $company = config('site.company');
    $companyFacts = [
        'Legal name' => $company['legal_name'],
        'Brand name' => config('site.name'),
        'Corporate Identification Number (CIN)' => $company['cin'],
        'Date of incorporation' => \Illuminate\Support\Carbon::parse($company['incorporated_on'])->format('j F Y'),
        'Registrar of Companies' => $company['registrar'],
        'Company class' => $company['class'],
        'Business activity' => $company['activity'],
        'Registered office' => config('site.address'),
    ];
@endphp

<x-layouts.site
    title="About Us"
    description="Learn about Finaza Micro Care Federation of India (CIN {{ $company['cin'] }}), incorporated in 2022 and registered with ROC Patna. Our mission, values and office on Main Gola Road, Patna."
    :crumbs="['About Us' => route('about')]"
>
    <x-page-hero
        eyebrow="About us"
        title="Rooted in Patna. <span class='text-gradient-gold'>Committed to people.</span>"
        subtitle="Finaza Microcare is the brand of {{ $company['legal_name'] }}, working to make financial support simple, respectful and accessible for small businesses and families."
        :crumbs="['About Us' => route('about')]"
    />

    {{-- Story --}}
    <section class="py-20 sm:py-28">
        <div class="container-x grid items-center gap-14 lg:grid-cols-2 lg:gap-20">
            <div>
                <x-section-heading align="left" eyebrow="Our story" title="Why we started Finaza" />
                <div class="mt-6 space-y-4 text-lg leading-relaxed text-slate-600" data-reveal>
                    <p>Across Bihar, millions of people run small shops, sell at local markets, stitch, weave, farm and build businesses from their homes. They work hard, but often find financial services confusing, distant or out of reach.</p>
                    <p>{{ $company['legal_name'] }} was incorporated on {{ \Illuminate\Support\Carbon::parse($company['incorporated_on'])->format('j F Y') }} to change that, by bringing support closer to the community, explaining things clearly and building relationships based on trust.</p>
                    <p>Today, our team works from Main Gola Road, Patna, and every conversation starts the same way: by listening.</p>
                </div>
            </div>
            <div class="relative" data-reveal="right">
                <img src="{{ asset('images/photos/artisan-frame-shop.webp') }}" alt="Elderly artisan at work in his frame shop" width="1280" height="1008" loading="lazy" class="aspect-[5/4] w-full rounded-[2rem] object-cover">
                <img src="{{ asset('images/photos/fruit-cart-vendor.webp') }}" alt="Fruit vendor's cart at a local market" width="1280" height="854" loading="lazy" class="absolute -bottom-10 -left-4 hidden w-56 rounded-2xl border-4 border-white object-cover shadow-2xl sm:block lg:-left-10">
            </div>
        </div>
    </section>

    {{-- Mission / Vision / Values --}}
    <section class="bg-cream py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="What drives us" title="Our mission, vision and values" />
            <div class="mt-14 grid gap-6 lg:grid-cols-3">
                @foreach ([
                    ['icon' => 'target', 'title' => 'Mission', 'text' => 'To empower small businesses, women and families with accessible financial support and practical knowledge, so they can earn more, save better and live with dignity.'],
                    ['icon' => 'telescope', 'title' => 'Vision', 'text' => 'A Bihar where every hard-working person has a fair chance to grow, with a trusted partner to rely on when they need it most.'],
                    ['icon' => 'gem', 'title' => 'Values', 'text' => 'Honesty in every conversation, respect for every customer, clarity before commitment, and care for the community we belong to.'],
                ] as $item)
                    <div class="card" data-reveal style="--reveal-delay: {{ $loop->index * 100 }}ms">
                        <span class="grid size-14 place-items-center rounded-2xl bg-gradient-to-br from-gold-300 to-gold-500 text-navy-950 shadow-lg shadow-gold-500/25"><i data-lucide="{{ $item['icon'] }}" class="size-6"></i></span>
                        <h3 class="mt-6 text-2xl font-semibold">{{ $item['title'] }}</h3>
                        <p class="mt-3 leading-relaxed text-slate-600">{{ $item['text'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Company information --}}
    <section class="py-20 sm:py-28">
        <div class="container-x grid gap-12 lg:grid-cols-[.8fr_1.2fr] lg:gap-16">
            <div>
                <x-section-heading align="left" eyebrow="Company information" title="Registered and verifiable" subtitle="We believe trust begins with transparency. Our registration details are public and can be verified on the Ministry of Corporate Affairs (MCA) portal." />
                <a href="https://www.mca.gov.in/" target="_blank" rel="noopener" class="btn btn-outline group mt-8" data-reveal>Verify on MCA portal <i data-lucide="external-link" class="size-4"></i></a>
            </div>
            <div class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-xl shadow-navy-900/5" data-reveal="right">
                <div class="flex items-center gap-3 bg-navy-900 px-6 py-5 text-white">
                    <i data-lucide="building-2" class="size-5 text-gold-300"></i>
                    <h3 class="font-display text-lg font-semibold text-white">{{ $company['legal_name'] }}</h3>
                </div>
                <dl class="divide-y divide-slate-100">
                    @foreach ($companyFacts as $label => $value)
                        <div class="grid gap-1 px-6 py-4 sm:grid-cols-[14rem_1fr] sm:gap-4">
                            <dt class="text-sm font-medium text-slate-500">{{ $label }}</dt>
                            <dd class="text-sm font-medium break-words text-navy-900">{{ $value }}</dd>
                        </div>
                    @endforeach
                </dl>
            </div>
        </div>
    </section>

    {{-- Office --}}
    <section class="bg-cream py-20 sm:py-28">
        <div class="container-x grid items-stretch gap-10 lg:grid-cols-2">
            <div class="flex flex-col justify-center">
                <x-section-heading align="left" eyebrow="Visit us" title="Our office in Patna" subtitle="Walk in to meet our team in person. We are easy to find, opposite V Mart in Krishna Chowk." />
                <address class="mt-8 flex gap-4 rounded-2xl bg-white p-5 not-italic shadow-sm ring-1 ring-slate-200" data-reveal>
                    <i data-lucide="map-pin" class="mt-1 size-5 shrink-0 text-gold-600"></i>
                    <span class="leading-relaxed text-navy-900">{{ config('site.address') }}</span>
                </address>
                <div class="mt-6 flex flex-col gap-3 sm:flex-row" data-reveal>
                    <a href="{{ $contact['mapsUrl'] }}" target="_blank" rel="noopener" class="btn btn-navy"><i data-lucide="navigation" class="size-4"></i> Get directions</a>
                    <a href="tel:{{ $contact['phoneIntl'] }}" class="btn btn-outline"><i data-lucide="phone" class="size-4"></i> {{ $contact['phoneDisplay'] }}</a>
                </div>
            </div>
            <div class="min-h-80 overflow-hidden rounded-[2rem] ring-1 ring-slate-200" data-reveal="right">
                <iframe src="{{ $contact['mapsEmbedUrl'] }}" title="Map showing the Finaza Microcare office in Patna" class="size-full min-h-80" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
