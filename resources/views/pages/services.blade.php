@php
    $services = config('site.services');
    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'ItemList',
        'itemListElement' => array_values(array_map(fn ($service, $index) => [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'item' => [
                '@type' => 'Service',
                'name' => $service['title'],
                'description' => $service['summary'],
                'provider' => ['@id' => url('/').'#organization'],
                'areaServed' => 'Bihar, India',
            ],
        ], $services, array_keys(array_values($services)))),
    ];
@endphp

<x-layouts.site
    title="Our Services"
    description="Micro business support, women group support, livelihood and agriculture support, and financial literacy from Finaza Microcare in Patna, Bihar. Simple process, clear guidance."
    :crumbs="['Services' => route('services')]"
    :schema="[$serviceSchema]"
>
    <x-page-hero
        eyebrow="Our services"
        title="Support that fits <span class='text-gradient-gold'>the way you earn</span>"
        subtitle="Every business and family is different. Explore our focus areas below, then talk to our team to find what suits you best."
        :crumbs="['Services' => route('services')]"
    >
        <div class="mt-8 flex flex-wrap gap-2" data-reveal style="--reveal-delay:240ms">
            @foreach ($services as $key => $service)
                <a href="#{{ $key }}" class="inline-flex items-center gap-2 rounded-full bg-white/10 px-4 py-2 text-sm font-medium text-white ring-1 ring-white/15 transition hover:bg-white/20">
                    <i data-lucide="{{ $service['icon'] }}" class="size-4 text-gold-300"></i> {{ $service['title'] }}
                </a>
            @endforeach
        </div>
    </x-page-hero>

    <section class="py-20 sm:py-28">
        <div class="container-x space-y-24 sm:space-y-32">
            @foreach ($services as $key => $service)
                <article id="{{ $key }}" class="grid scroll-mt-28 items-center gap-10 lg:grid-cols-2 lg:gap-20">
                    <div @class(['relative', 'lg:order-2' => $loop->odd]) data-reveal="{{ $loop->odd ? 'right' : 'left' }}">
                        <div class="absolute -inset-3 -z-10 rounded-[2.25rem] bg-gradient-to-br from-gold-100 to-navy-50"></div>
                        <img src="{{ asset($service['image']) }}" alt="{{ $service['title'] }} by Finaza Microcare" loading="lazy" class="aspect-[4/3] w-full rounded-[2rem] object-cover">
                        <span class="absolute -bottom-6 left-6 grid size-16 place-items-center rounded-2xl bg-navy-900 text-gold-300 shadow-xl"><i data-lucide="{{ $service['icon'] }}" class="size-7"></i></span>
                    </div>
                    <div data-reveal>
                        <span class="eyebrow">0{{ $loop->iteration }} &middot; Service</span>
                        <h2 class="mt-4 text-3xl font-semibold tracking-tight sm:text-4xl">{{ $service['title'] }}</h2>
                        <p class="mt-4 text-lg leading-relaxed text-slate-600">{{ $service['summary'] }}</p>
                        <ul class="mt-7 space-y-3">
                            @foreach ($service['points'] as $point)
                                <li class="flex items-start gap-3 text-navy-900"><span class="mt-0.5 grid size-6 shrink-0 place-items-center rounded-full bg-emerald-50 text-emerald-600"><i data-lucide="check" class="size-3.5"></i></span>{{ $point }}</li>
                            @endforeach
                        </ul>
                        <div class="mt-9 flex flex-col gap-3 sm:flex-row">
                            <a href="{{ route('contact', ['service' => $key]) }}#enquiry" class="btn btn-navy group">Enquire about this <i data-lucide="arrow-right" class="size-4 transition group-hover:translate-x-1"></i></a>
                            <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="btn btn-outline"><x-whatsapp-icon class="size-5 text-[#25D366]" /> Ask on WhatsApp</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </section>

    {{-- Eligibility & documents --}}
    <section class="bg-cream py-20 sm:py-28">
        <div class="container-x">
            <x-section-heading eyebrow="Before you apply" title="Who can apply and what you need" subtitle="The exact requirements depend on the service. Here is a general idea so you can be ready." />
            <div class="mt-14 grid gap-6 lg:grid-cols-2">
                <div class="card" data-reveal="left">
                    <div class="flex items-center gap-3">
                        <span class="grid size-12 place-items-center rounded-xl bg-navy-900 text-gold-300"><i data-lucide="user-check" class="size-5"></i></span>
                        <h3 class="text-xl font-semibold">Who can apply</h3>
                    </div>
                    <ul class="mt-6 space-y-3 text-slate-600">
                        @foreach (['Indian residents aged 18 years and above', 'Owners of small shops, stalls or home-based businesses', 'Members of women self-help groups or joint liability groups', 'Farmers and people engaged in allied rural activities', 'Anyone who wants guidance on managing money better'] as $item)
                            <li class="flex items-start gap-3"><i data-lucide="circle-check" class="mt-0.5 size-5 shrink-0 text-emerald-600"></i>{{ $item }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card" data-reveal="right">
                    <div class="flex items-center gap-3">
                        <span class="grid size-12 place-items-center rounded-xl bg-navy-900 text-gold-300"><i data-lucide="folder-open" class="size-5"></i></span>
                        <h3 class="text-xl font-semibold">Documents usually needed</h3>
                    </div>
                    <ul class="mt-6 grid gap-3 text-slate-600 sm:grid-cols-2">
                        @foreach (['Aadhaar card' => 'id-card', 'PAN card' => 'credit-card', 'Address proof' => 'house', 'Passport-size photo' => 'image', 'Bank account details' => 'landmark', 'Business details (if any)' => 'store'] as $doc => $icon)
                            <li class="flex items-center gap-3 rounded-xl bg-slate-50 px-4 py-3"><i data-lucide="{{ $icon }}" class="size-5 shrink-0 text-gold-600"></i>{{ $doc }}</li>
                        @endforeach
                    </ul>
                    <p class="mt-5 flex items-start gap-2 text-sm text-slate-500"><i data-lucide="info" class="mt-0.5 size-4 shrink-0"></i> Our team will confirm the final list for your case. Never share OTPs or PINs with anyone.</p>
                </div>
            </div>
        </div>
    </section>

    <x-cta-band />
</x-layouts.site>
