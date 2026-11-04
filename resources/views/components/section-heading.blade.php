@props(['eyebrow' => null, 'title', 'subtitle' => null, 'align' => 'center', 'dark' => false])
<div {{ $attributes->class(['max-w-3xl', 'mx-auto text-center' => $align === 'center']) }} data-reveal>
    @if ($eyebrow)
        <span @class(['eyebrow' => ! $dark, 'eyebrow-dark' => $dark])>{{ $eyebrow }}</span>
    @endif
    <h2 @class(['mt-4 text-3xl font-semibold tracking-tight text-balance sm:text-4xl lg:text-[2.75rem] lg:leading-[1.1]', 'text-white' => $dark])>{!! $title !!}</h2>
    @if ($subtitle)
        <p @class(['mt-4 text-base leading-relaxed text-pretty sm:text-lg', 'text-slate-600' => ! $dark, 'text-navy-100/80' => $dark])>{{ $subtitle }}</p>
    @endif
</div>
