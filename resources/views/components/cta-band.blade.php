<section class="relative py-20 sm:py-24">
    <div class="container-x">
        <div class="relative isolate overflow-hidden rounded-[2rem] bg-gradient-to-br from-navy-800 via-navy-900 to-navy-950 px-6 py-14 text-center shadow-2xl shadow-navy-900/20 sm:px-16 sm:py-20" data-reveal="zoom">
            <div class="absolute -top-32 -left-24 -z-10 size-80 animate-blob rounded-full bg-gold-400/20 blur-3xl"></div>
            <div class="absolute -right-24 -bottom-32 -z-10 size-80 animate-blob rounded-full bg-navy-500/40 blur-3xl [animation-delay:-6s]"></div>
            <div class="grid-pattern absolute inset-0 -z-10"></div>
            <h2 class="mx-auto max-w-2xl text-3xl font-semibold tracking-tight text-balance text-white sm:text-4xl">Ready to take the next step for your <span class="text-gradient-gold animate-shine">family or business?</span></h2>
            <p class="mx-auto mt-4 max-w-xl text-navy-100/80">Talk to our team in Patna. Share your need and we will guide you through the right option, in simple words.</p>
            <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
                <a href="{{ route('contact') }}#enquiry" class="btn btn-gold w-full sm:w-auto"><i data-lucide="send" class="size-4"></i> Send an Enquiry</a>
                <a href="tel:{{ $contact['phoneIntl'] }}" class="btn btn-ghost-light w-full sm:w-auto"><i data-lucide="phone" class="size-4"></i> Call {{ $contact['phoneDisplay'] }}</a>
            </div>
        </div>
    </div>
</section>
