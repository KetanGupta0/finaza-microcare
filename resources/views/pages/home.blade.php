@php
    $faqs = [
        ['q' => 'What is Finaza Microcare?', 'a' => 'Finaza Microcare is the brand of '.config('site.company.legal_name').', a company registered with the '.config('site.company.registrar').' (CIN '.config('site.company.cin').'). We work with small businesses, women groups and families to support their livelihoods and financial well-being.'],
        ['q' => 'Who can contact Finaza Microcare?', 'a' => 'Shop owners, street vendors, artisans, home-based entrepreneurs, women self-help groups, farmers and families looking for financial support or guidance can reach out to us. Our team will understand your need and explain the options available.'],
        ['q' => 'How do I get started?', 'a' => 'Fill in the enquiry form, call us or send a WhatsApp message. A member of our team will call you back, understand your requirement and explain the next steps in simple language.'],
        ['q' => 'Which documents are usually needed?', 'a' => 'Typically, basic KYC documents such as Aadhaar card, PAN card, address proof, a passport-size photograph and bank account details are needed. The exact list depends on the service and will be shared by our team.'],
        ['q' => 'Is there any charge to make an enquiry?', 'a' => 'No. Sending an enquiry, calling or messaging us on WhatsApp is completely free.'],
        ['q' => 'How do I stay safe from fraud?', 'a' => 'Never share your OTP, ATM PIN or passwords with anyone, including people who claim to be from Finaza Microcare. If you are unsure about a call or message, call us directly on '.$contact['phoneDisplay'].' or visit our office.'],
    ];

    $faqSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => array_map(fn ($faq) => [
            '@type' => 'Question',
            'name' => $faq['q'],
            'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['a']],
        ], $faqs),
    ];

    $audiences = [
        ['title' => 'Shop owners', 'text' => 'Kirana, general and retail stores', 'image' => 'images/photos/shopkeeper-beverage-stall.webp', 'alt' => 'Shopkeeper arranging bottles at his roadside stall'],
        ['title' => 'Artisans & craftspeople', 'text' => 'Skilled work that deserves to grow', 'image' => 'images/photos/artisan-frame-shop.webp', 'alt' => 'Elderly artisan sitting in his photo frame shop'],
        ['title' => 'Street vendors', 'text' => 'Fruit, flower and food sellers', 'image' => 'images/photos/flower-stall-vendor.webp', 'alt' => 'Customer at a marigold flower stall in a market'],
        ['title' => 'Families', 'text' => 'Planning for a secure tomorrow', 'image' => 'images/photos/happy-family.webp', 'alt' => 'Smiling Indian family of four standing together'],
    ];
@endphp

<x-layouts.site
    title="Micro Business, Women Group & Livelihood Support in Patna"
    description="Finaza Microcare helps shop owners, vendors, artisans, women groups and families in Patna, Bihar grow with micro business support, livelihood support and financial literacy. Call +91 80098 77918."
    :schema="[$faqSchema]"
>
    {{-- Hero --}}
    <section class="relative isolate overflow-hidden bg-navy-950 pt-32 pb-20 sm:pt-40 lg:pt-44 lg:pb-32">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(1000px_560px_at_85%_-10%,rgba(63,101,178,.6),transparent_60%),radial-gradient(800px_500px_at_-10%_110%,rgba(217,154,43,.2),transparent_60%)]"></div>
        <div class="grid-pattern absolute inset-0 -z-10"></div>
        <div class="absolute top-1/3 -left-32 -z-10 size-96 animate-blob rounded-full bg-navy-600/30 blur-3xl"></div>

        <div class="container-x grid items-center gap-14 lg:grid-cols-[1.05fr_.95fr] lg:gap-10">
            <div>
                <span class="eyebrow-dark" data-reveal><i data-lucide="badge-check" class="size-4"></i> Registered company &middot; Patna, Bihar</span>
                <h1 class="mt-6 text-[2.6rem] leading-[1.05] font-semibold tracking-tight text-balance text-white sm:text-6xl lg:text-[4.25rem]" data-reveal style="--reveal-delay:80ms">
                    Small steps today. <span class="text-gradient-gold animate-shine">Stronger livelihoods</span> tomorrow.
                </h1>
                <p class="mt-6 max-w-xl text-lg leading-relaxed text-pretty text-navy-100/80" data-reveal style="--reveal-delay:160ms">
                    Finaza Microcare stands with shop owners, vendors, artisans, women groups and families with practical financial support and honest guidance, right here in Patna.
                </p>
                <div class="mt-9 flex flex-col gap-3 sm:flex-row" data-reveal style="--reveal-delay:240ms">
                    <a href="#enquiry" class="btn btn-gold group">Get a Call Back <i data-lucide="arrow-right" class="size-4 transition group-hover:translate-x-1"></i></a>
                    <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="btn btn-ghost-light"><x-whatsapp-icon class="size-5 text-[#25D366]" /> Chat on WhatsApp</a>
                </div>
                <ul class="mt-10 grid gap-3 text-sm text-navy-100/85 sm:grid-cols-3" data-reveal style="--reveal-delay:320ms">
                    <li class="flex items-center gap-2"><i data-lucide="shield-check" class="size-5 text-gold-400"></i> Registered with ROC</li>
                    <li class="flex items-center gap-2"><i data-lucide="map-pinned" class="size-5 text-gold-400"></i> Local office, Gola Road</li>
                    <li class="flex items-center gap-2"><i data-lucide="headset" class="size-5 text-gold-400"></i> Quick call back</li>
                </ul>
            </div>

            <div class="relative mx-auto w-full max-w-lg lg:max-w-none" data-reveal="right" style="--reveal-delay:200ms">
                <div class="absolute -inset-4 -z-10 rounded-[2.5rem] bg-gradient-to-br from-gold-400/30 via-transparent to-navy-500/30 blur-2xl"></div>
                <div class="relative overflow-hidden rounded-[2rem] ring-1 ring-white/15 transition duration-300" data-tilt>
                    <img src="{{ asset('images/photos/woman-entrepreneur-tablet.webp') }}" alt="Young Indian woman entrepreneur smiling while holding a tablet" width="1280" height="854" fetchpriority="high" class="aspect-[4/4.4] w-full object-cover sm:aspect-[4/3.6]">
                    <div class="absolute inset-0 bg-gradient-to-t from-navy-950/70 via-transparent to-transparent"></div>
                </div>

                <div class="absolute -bottom-6 -left-3 w-60 animate-float rounded-2xl bg-white p-4 shadow-2xl shadow-navy-950/30 sm:-left-8">
                    <div class="flex items-center gap-3">
                        <span class="grid size-10 place-items-center rounded-xl bg-emerald-50 text-emerald-600"><i data-lucide="trending-up" class="size-5"></i></span>
                        <div>
                            <p class="text-xs text-slate-500">Focus</p>
                            <p class="font-display font-semibold text-navy-900">Growth that lasts</p>
                        </div>
                    </div>
                    <div class="mt-3 flex h-10 items-end gap-1.5">
                        @foreach ([30, 45, 38, 60, 52, 75, 90] as $height)
                            <span class="flex-1 rounded-t bg-gradient-to-t from-navy-700 to-navy-400" style="height: {{ $height }}%"></span>
                        @endforeach
                    </div>
                </div>

                <div class="absolute -top-5 -right-2 animate-float-slow rounded-2xl bg-white/95 px-4 py-3 shadow-2xl shadow-navy-950/30 backdrop-blur sm:-right-6 [animation-delay:-3s]">
                    <div class="flex items-center gap-3">
                        <x-brand-icon id="hero" class="size-9" />
                        <div>
                            <p class="text-xs text-slate-500">Incorporated</p>
                            <p class="font-display font-semibold text-navy-900">March 2022</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Marquee --}}
    <div class="relative overflow-hidden border-y border-gold-200/60 bg-gold-50 py-4" aria-hidden="true">
        <div class="flex w-max animate-marquee gap-10 whitespace-nowrap">
            @foreach (range(1, 2) as $loopIndex)
                @foreach (['Micro Business Support', 'Women Self-Help Groups', 'Livelihood & Agriculture', 'Financial Literacy', 'Patna, Bihar', 'Grow · Save · Prosper'] as $word)
                    <span class="flex items-center gap-10 font-display text-lg font-semibold text-navy-900">{{ $word }} <i data-lucide="sparkle" class="size-4 text-gold-500"></i></span>
                @endforeach
            @endforeach
        </div>
    </div>

    {{-- About intro --}}
    <section class="py-20 sm:py-28">
        <div class="container-x grid items-center gap-14 lg:grid-cols-2 lg:gap-20">
            <div class="relative" data-reveal="left">
                <div class="grid grid-cols-5 gap-4">
                    <img src="{{ asset('images/photos/shopkeeper-beverage-stall.webp') }}" alt="Shopkeeper at his roadside beverage stall" width="1280" height="848" loading="lazy" class="col-span-3 h-72 w-full rounded-3xl object-cover sm:h-96">
                    <div class="col-span-2 flex flex-col gap-4">
                        <img src="{{ asset('images/photos/rural-woman-portrait.webp') }}" alt="Woman in a colourful saree standing outdoors" width="853" height="1280" loading="lazy" class="h-44 w-full rounded-3xl object-cover sm:h-60">
                        <div class="flex flex-1 flex-col justify-center rounded-3xl bg-navy-900 p-5 text-white">
                            <p class="font-display text-3xl font-bold text-gold-300"><span data-count="{{ count(config('site.services')) }}">{{ count(config('site.services')) }}</span></p>
                            <p class="mt-1 text-sm text-navy-100/80">focus areas of support</p>
                        </div>
                    </div>
                </div>
                <div class="absolute -top-5 left-4 hidden rounded-2xl bg-white px-4 py-3 shadow-xl ring-1 ring-slate-100 sm:block">
                    <p class="text-xs tracking-wider text-slate-500 uppercase">CIN</p>
                    <p class="font-display text-sm font-semibold text-navy-900">{{ config('site.company.cin') }}</p>
                </div>
            </div>

            <div>
                <x-section-heading align="left" eyebrow="Who we are" title="Built in Bihar, for the people who keep Bihar moving" />
                <div class="mt-6 space-y-4 text-lg leading-relaxed text-slate-600" data-reveal>
                    <p>{{ config('site.company.legal_name') }} was incorporated in 2022 with a simple belief: small businesses and hard-working families deserve financial support that is easy to understand and close to home.</p>
                    <p>From our office on Main Gola Road, Patna, we listen first, explain clearly, and work with you to find a path that fits your income and your goals.</p>
                </div>
                <ul class="mt-8 grid gap-4 sm:grid-cols-2" data-reveal>
                    @foreach (['Clear explanation before any decision', 'Respectful, people-first approach', 'Support for women-led livelihoods', 'Your data kept private and secure'] as $point)
                        <li class="flex items-start gap-3 text-navy-900"><span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-gold-100 text-gold-700"><i data-lucide="check" class="size-3.5"></i></span>{{ $point }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('about') }}" class="btn btn-outline group mt-10" data-reveal>Know more about us <i data-lucide="arrow-right" class="size-4 transition group-hover:translate-x-1"></i></a>
            </div>
        </div>
    </section>

    {{-- Services --}}
    <section class="relative bg-cream py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="What we do" title="Support designed around <span class='text-gold-600'>real lives</span>" subtitle="Whether you run a small shop, work with your hands, or lead a women's group, we offer support that fits the way you earn." />
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach (config('site.services') as $key => $service)
                    <article class="card group relative flex flex-col overflow-hidden" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <div class="absolute -top-16 -right-16 size-40 rounded-full bg-gold-100/0 transition duration-500 group-hover:bg-gold-100/70"></div>
                        <span class="relative grid size-14 place-items-center rounded-2xl bg-navy-900 text-gold-300 shadow-lg shadow-navy-900/20 transition duration-300 group-hover:scale-110 group-hover:rotate-3">
                            <i data-lucide="{{ $service['icon'] }}" class="size-6"></i>
                        </span>
                        <h3 class="relative mt-6 text-xl font-semibold">{{ $service['title'] }}</h3>
                        <p class="relative mt-3 flex-1 text-[.95rem] leading-relaxed text-slate-600">{{ $service['summary'] }}</p>
                        <a href="{{ route('services') }}#{{ $key }}" class="relative mt-6 inline-flex items-center gap-1.5 text-sm font-semibold text-navy-700 transition group-hover:gap-2.5 group-hover:text-gold-600">Learn more <i data-lucide="arrow-right" class="size-4"></i></a>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- How it works --}}
    <section class="py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="How it works" title="Four simple steps to get started" subtitle="No confusing forms, no running around. We keep the process short and clear." />
            <ol class="relative mt-16 grid gap-10 md:grid-cols-2 lg:grid-cols-4 lg:gap-6">
                <div class="absolute top-8 right-[12%] left-[12%] hidden h-px bg-gradient-to-r from-transparent via-gold-300 to-transparent lg:block" aria-hidden="true"></div>
                @foreach ([
                    ['icon' => 'message-circle-more', 'title' => 'Share your need', 'text' => 'Fill the enquiry form, call us or message us on WhatsApp.'],
                    ['icon' => 'phone-incoming', 'title' => 'Talk to our team', 'text' => 'We call you back, understand your situation and explain options.'],
                    ['icon' => 'file-check-2', 'title' => 'Simple documentation', 'text' => 'Share basic KYC documents. We guide you at every step.'],
                    ['icon' => 'rocket', 'title' => 'Start growing', 'text' => 'Your support begins, with our team available whenever you need us.'],
                ] as $step)
                    <li class="relative text-center" data-reveal style="--reveal-delay: {{ $loop->index * 110 }}ms">
                        <div class="relative mx-auto grid size-16 place-items-center rounded-2xl bg-white text-navy-900 shadow-xl ring-1 shadow-navy-900/10 ring-slate-100">
                            <i data-lucide="{{ $step['icon'] }}" class="size-7"></i>
                            <span class="absolute -top-2.5 -right-2.5 grid size-7 place-items-center rounded-full bg-gold-400 font-display text-sm font-bold text-navy-950">{{ $loop->iteration }}</span>
                        </div>
                        <h3 class="mt-6 text-lg font-semibold">{{ $step['title'] }}</h3>
                        <p class="mx-auto mt-2 max-w-xs text-slate-600">{{ $step['text'] }}</p>
                    </li>
                @endforeach
            </ol>
        </div>
    </section>

    {{-- Why choose us --}}
    <section class="relative isolate overflow-hidden bg-navy-950 py-20 sm:py-28">
        <div class="absolute inset-0 -z-10 bg-[radial-gradient(800px_500px_at_100%_0%,rgba(63,101,178,.45),transparent_60%)]"></div>
        <div class="grid-pattern absolute inset-0 -z-10"></div>
        <div class="container-x grid items-center gap-14 lg:grid-cols-[.9fr_1.1fr] lg:gap-20">
            <div class="relative" data-reveal="left">
                <img src="{{ asset('images/photos/happy-family.webp') }}" alt="Happy Indian family smiling together" width="1280" height="854" loading="lazy" class="aspect-[4/4.2] w-full rounded-[2rem] object-cover ring-1 ring-white/10">
                <div class="absolute right-4 bottom-4 left-4 rounded-2xl bg-navy-950/80 p-5 text-white ring-1 ring-white/15 backdrop-blur-md sm:right-auto sm:max-w-xs">
                    <p class="font-display text-lg font-semibold">"Grow &middot; Save &middot; Prosper"</p>
                    <p class="mt-1 text-sm text-navy-100/80">Our promise to every family and business we work with.</p>
                </div>
            </div>
            <div>
                <x-section-heading align="left" :dark="true" eyebrow="Why Finaza" title="Trust is built in small, honest steps" subtitle="We know that financial decisions are personal. That is why we focus on clarity, respect and staying close to the people we serve." />
                <div class="mt-10 grid gap-5 sm:grid-cols-2">
                    @foreach ([
                        ['icon' => 'landmark', 'title' => 'Registered company', 'text' => 'Incorporated under the Companies Act with ROC Patna.'],
                        ['icon' => 'eye', 'title' => 'Transparent process', 'text' => 'Every term explained in simple language before you decide.'],
                        ['icon' => 'map-pin-house', 'title' => 'Local presence', 'text' => 'Visit us any time at our office on Main Gola Road, Patna.'],
                        ['icon' => 'heart-handshake', 'title' => 'Women-first focus', 'text' => 'Special attention to women entrepreneurs and groups.'],
                        ['icon' => 'languages', 'title' => 'Hindi & English', 'text' => 'Talk to us in the language you are comfortable with.'],
                        ['icon' => 'lock', 'title' => 'Privacy respected', 'text' => 'Your details are used only to serve you, never sold.'],
                    ] as $feature)
                        <div class="group rounded-2xl border border-white/10 bg-white/[.04] p-5 transition duration-300 hover:-translate-y-1 hover:border-gold-300/40 hover:bg-white/[.07]" data-reveal style="--reveal-delay: {{ $loop->index * 70 }}ms">
                            <i data-lucide="{{ $feature['icon'] }}" class="size-6 text-gold-300 transition group-hover:scale-110"></i>
                            <h3 class="mt-4 font-semibold text-white">{{ $feature['title'] }}</h3>
                            <p class="mt-1.5 text-sm leading-relaxed text-navy-100/70">{{ $feature['text'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- Who we serve --}}
    <section class="py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="Who we serve" title="For every hard-working dream" subtitle="Our support is built for the people at the heart of local business and community life." />
            <div class="mt-14 grid grid-cols-2 gap-3 sm:gap-5 lg:grid-cols-4">
                @foreach ($audiences as $audience)
                    <figure class="group relative h-60 overflow-hidden rounded-3xl sm:h-96" data-reveal style="--reveal-delay: {{ $loop->index * 90 }}ms">
                        <img src="{{ asset($audience['image']) }}" alt="{{ $audience['alt'] }}" loading="lazy" class="size-full object-cover transition duration-700 group-hover:scale-110">
                        <div class="absolute inset-0 bg-gradient-to-t from-navy-950/90 via-navy-950/20 to-transparent"></div>
                        <figcaption class="absolute inset-x-0 bottom-0 p-4 sm:p-6">
                            <h3 class="text-base font-semibold text-white sm:text-xl">{{ $audience['title'] }}</h3>
                            <p class="mt-1 text-xs text-navy-100/80 sm:text-sm">{{ $audience['text'] }}</p>
                        </figcaption>
                    </figure>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section class="bg-cream py-20 sm:py-28">
        <div class="container-x grid gap-12 lg:grid-cols-[.8fr_1.2fr] lg:gap-20">
            <div>
                <x-section-heading align="left" eyebrow="FAQ" title="Questions people often ask us" subtitle="Can't find what you are looking for? Call or WhatsApp us, we are happy to help." />
                <div class="mt-8 flex flex-col gap-3 sm:flex-row lg:flex-col xl:flex-row" data-reveal>
                    <a href="tel:{{ $contact['phoneIntl'] }}" class="btn btn-navy"><i data-lucide="phone" class="size-4"></i> Call us</a>
                    <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="btn btn-outline"><x-whatsapp-icon class="size-5 text-[#25D366]" /> WhatsApp</a>
                </div>
            </div>
            <div class="space-y-3">
                @foreach ($faqs as $faq)
                    <details class="group rounded-2xl border border-slate-200 bg-white p-5 transition open:shadow-lg open:shadow-navy-900/5 sm:p-6" data-reveal style="--reveal-delay: {{ $loop->index * 60 }}ms" @if ($loop->first) open @endif>
                        <summary class="flex cursor-pointer list-none items-center justify-between gap-4 font-display text-lg font-semibold text-navy-900">
                            {{ $faq['q'] }}
                            <span class="faq-icon grid size-8 shrink-0 place-items-center rounded-full bg-navy-50 text-navy-700 transition duration-300"><i data-lucide="plus" class="size-4"></i></span>
                        </summary>
                        <p class="mt-3 leading-relaxed text-slate-600">{{ $faq['a'] }}</p>
                    </details>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Enquiry --}}
    <section id="enquiry" class="scroll-mt-24 py-20 sm:py-28">
        <div class="container-x grid gap-12 lg:grid-cols-[.85fr_1.15fr] lg:gap-16">
            <div>
                <x-section-heading align="left" eyebrow="Get in touch" title="Let's talk about your next step" subtitle="Share a few details and our team will call you back. Prefer to talk right away? Reach us directly." />
                <div class="mt-8 space-y-4" data-reveal>
                    <a href="tel:{{ $contact['phoneIntl'] }}" class="group flex items-center gap-4 rounded-2xl border border-slate-200 p-4 transition hover:border-navy-300 hover:shadow-lg">
                        <span class="grid size-12 place-items-center rounded-xl bg-navy-900 text-gold-300"><i data-lucide="phone" class="size-5"></i></span>
                        <span><span class="block text-sm text-slate-500">Call us</span><span class="font-display text-lg font-semibold text-navy-900">{{ $contact['phoneDisplay'] }}</span></span>
                    </a>
                    <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="group flex items-center gap-4 rounded-2xl border border-slate-200 p-4 transition hover:border-emerald-300 hover:shadow-lg">
                        <span class="grid size-12 place-items-center rounded-xl bg-[#25D366] text-white"><x-whatsapp-icon class="size-6" /></span>
                        <span><span class="block text-sm text-slate-500">WhatsApp</span><span class="font-display text-lg font-semibold text-navy-900">Chat with our team</span></span>
                    </a>
                    <a href="{{ $contact['mapsUrl'] }}" target="_blank" rel="noopener" class="group flex items-start gap-4 rounded-2xl border border-slate-200 p-4 transition hover:border-gold-300 hover:shadow-lg">
                        <span class="grid size-12 shrink-0 place-items-center rounded-xl bg-gold-100 text-gold-700"><i data-lucide="map-pin" class="size-5"></i></span>
                        <span><span class="block text-sm text-slate-500">Visit our office</span><span class="text-sm leading-relaxed text-navy-900">{{ config('site.address') }}</span></span>
                    </a>
                </div>
            </div>
            <div data-reveal="right">
                <x-enquiry-form />
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
