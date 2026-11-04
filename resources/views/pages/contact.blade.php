<x-layouts.site
    title="Contact Us"
    description="Contact Finaza Microcare in Patna. Call or WhatsApp +91 80098 77918, send an enquiry online, or visit our office at Parmeshwar Sadan, Krishna Chowk, Main Gola Road, Patna 801503."
    :crumbs="['Contact' => route('contact')]"
>
    <x-page-hero
        eyebrow="Contact us"
        title="We are just a <span class='text-gradient-gold'>call away</span>"
        subtitle="Call, WhatsApp, visit our office, or send us an enquiry. Our team will get back to you quickly."
        :crumbs="['Contact' => route('contact')]"
    />

    <section class="relative z-10 -mt-12 pb-6">
        <div class="container-x grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            <a href="tel:{{ $contact['phoneIntl'] }}" class="card group flex items-center gap-4 !p-6" data-reveal>
                <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-navy-900 text-gold-300 transition group-hover:scale-110"><i data-lucide="phone-call" class="size-6"></i></span>
                <span><span class="block text-sm text-slate-500">Call us</span><span class="font-display text-xl font-semibold text-navy-900">{{ $contact['phoneDisplay'] }}</span></span>
            </a>
            <a href="{{ $contact['whatsappUrl'] }}" target="_blank" rel="noopener" class="card group flex items-center gap-4 !p-6" data-reveal style="--reveal-delay:90ms">
                <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-[#25D366] text-white transition group-hover:scale-110"><x-whatsapp-icon class="size-7" /></span>
                <span><span class="block text-sm text-slate-500">WhatsApp</span><span class="font-display text-xl font-semibold text-navy-900">Message us</span></span>
            </a>
            @if (config('site.email'))
                <a href="mailto:{{ config('site.email') }}" class="card group flex items-center gap-4 !p-6 sm:col-span-2 lg:col-span-1" data-reveal style="--reveal-delay:180ms">
                    <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-gold-100 text-gold-700 transition group-hover:scale-110"><i data-lucide="mail" class="size-6"></i></span>
                    <span class="min-w-0"><span class="block text-sm text-slate-500">Email</span><span class="block truncate font-display text-lg font-semibold text-navy-900">{{ config('site.email') }}</span></span>
                </a>
            @else
                <a href="{{ $contact['mapsUrl'] }}" target="_blank" rel="noopener" class="card group flex items-center gap-4 !p-6 sm:col-span-2 lg:col-span-1" data-reveal style="--reveal-delay:180ms">
                    <span class="grid size-14 shrink-0 place-items-center rounded-2xl bg-gold-100 text-gold-700 transition group-hover:scale-110"><i data-lucide="navigation" class="size-6"></i></span>
                    <span><span class="block text-sm text-slate-500">Visit us</span><span class="font-display text-xl font-semibold text-navy-900">Get directions</span></span>
                </a>
            @endif
        </div>
    </section>

    <section id="enquiry" class="scroll-mt-24 py-16 sm:py-24">
        <div class="container-x grid gap-12 lg:grid-cols-[1.15fr_.85fr] lg:gap-14">
            <div data-reveal="left">
                <x-enquiry-form heading="Tell us how we can help" />
            </div>
            <div class="flex flex-col gap-6">
                <div class="rounded-[1.75rem] bg-navy-950 p-7 text-white" data-reveal="right">
                    <h2 class="text-xl font-semibold text-white">Our office</h2>
                    <address class="mt-4 flex gap-3 leading-relaxed not-italic text-navy-100/85">
                        <i data-lucide="map-pin" class="mt-1 size-5 shrink-0 text-gold-300"></i>
                        {{ config('site.address') }}
                    </address>
                    @if (config('site.hours'))
                        <p class="mt-4 flex gap-3 text-navy-100/85"><i data-lucide="clock" class="mt-0.5 size-5 shrink-0 text-gold-300"></i>{{ config('site.hours') }}</p>
                    @endif
                    <div class="mt-6 border-t border-white/10 pt-5 text-sm text-navy-100/70">
                        <p class="font-medium text-white">{{ config('site.company.legal_name') }}</p>
                        <p class="mt-1">CIN: {{ config('site.company.cin') }}</p>
                    </div>
                </div>
                <div class="min-h-80 flex-1 overflow-hidden rounded-[1.75rem] ring-1 ring-slate-200" data-reveal="right" style="--reveal-delay:120ms">
                    <iframe src="{{ $contact['mapsEmbedUrl'] }}" title="Map showing the Finaza Microcare office in Patna" class="size-full min-h-80" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </section>
</x-layouts.site>
