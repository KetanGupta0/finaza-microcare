@props(['eyebrow' => null, 'title', 'subtitle' => null, 'crumbs' => []])
<section class="relative isolate overflow-hidden bg-navy-950 pt-36 pb-20 sm:pt-44 sm:pb-28">
    <div class="absolute inset-0 -z-10 bg-[radial-gradient(900px_480px_at_80%_0%,rgba(63,101,178,.55),transparent_60%),radial-gradient(700px_400px_at_0%_100%,rgba(217,154,43,.18),transparent_60%)]"></div>
    <div class="grid-pattern absolute inset-0 -z-10"></div>
    <div class="absolute -top-24 -right-24 -z-10 size-96 rounded-full border border-gold-300/20"></div>
    <div class="absolute -top-8 -right-8 -z-10 size-64 animate-float-slow rounded-full border border-gold-300/15"></div>

    <div class="container-x">
        @if ($crumbs)
            <nav aria-label="Breadcrumb" class="mb-6" data-reveal>
                <ol class="flex flex-wrap items-center gap-1.5 text-sm text-navy-200">
                    <li><a href="{{ route('home') }}" class="transition hover:text-white">Home</a></li>
                    @foreach ($crumbs as $label => $url)
                        <li aria-hidden="true"><i data-lucide="chevron-right" class="size-4"></i></li>
                        <li>
                            @if ($loop->last)
                                <span aria-current="page" class="text-gold-300">{{ $label }}</span>
                            @else
                                <a href="{{ $url }}" class="transition hover:text-white">{{ $label }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </nav>
        @endif
        <div class="max-w-3xl">
            @if ($eyebrow)
                <span class="eyebrow-dark" data-reveal>{{ $eyebrow }}</span>
            @endif
            <h1 class="mt-5 text-4xl font-semibold tracking-tight text-balance text-white sm:text-5xl lg:text-6xl" data-reveal style="--reveal-delay:80ms">{!! $title !!}</h1>
            @if ($subtitle)
                <p class="mt-5 max-w-2xl text-lg leading-relaxed text-pretty text-navy-100/80" data-reveal style="--reveal-delay:160ms">{{ $subtitle }}</p>
            @endif
            {{ $slot }}
        </div>
    </div>
</section>
