<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>{{ config('site.name') }} — Launching This Diwali</title>
<meta name="description" content="Finaza Microcare is launching this Diwali. Next-generation financial empowerment and micro-care solutions designed for your growth journey.">
<meta name="theme-color" content="#120a24">
<meta property="og:title" content="Finaza Microcare — Launching This Diwali">
<meta property="og:description" content="Next-generation financial empowerment and micro-care solutions designed for your growth journey.">
<meta property="og:url" content="{{ url('/') }}">
<link rel="icon" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'><defs><linearGradient id='g' x1='0' y1='0' x2='1' y2='1'><stop offset='0' stop-color='%23ffd77a'/><stop offset='1' stop-color='%23e89a2c'/></linearGradient></defs><rect width='64' height='64' rx='16' fill='%23120a24'/><path d='M22 46V18h22v6H29v6h12v6H29v10z' fill='url(%23g)'/></svg>">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,500;0,600;0,700;1,500;1,600&family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/coming-soon.css') }}?v={{ filemtime(public_path('css/coming-soon.css')) }}">
</head>
<body data-launch-at="{{ $launchAt->toIso8601String() }}">
<div class="bgfix" aria-hidden="true"></div>

<canvas id="sky" aria-hidden="true"></canvas>

<!-- Rangoli mandalas -->
<svg class="mandala m1" viewBox="0 0 200 200" aria-hidden="true"><g fill="none" stroke="#ffd77a" stroke-width=".6" id="mand">
  <circle cx="100" cy="100" r="96"/><circle cx="100" cy="100" r="80"/><circle cx="100" cy="100" r="60"/><circle cx="100" cy="100" r="34"/><circle cx="100" cy="100" r="14"/>
</g></svg>
<svg class="mandala m2" viewBox="0 0 200 200" aria-hidden="true"><g fill="none" stroke="#e8792c" stroke-width=".6" id="mand2">
  <circle cx="100" cy="100" r="96"/><circle cx="100" cy="100" r="72"/><circle cx="100" cy="100" r="48"/><circle cx="100" cy="100" r="20"/>
</g></svg>

<!-- Hanging lanterns -->
<div class="lanterns" aria-hidden="true" id="lanterns"></div>

<div class="wrap">
  <header class="reveal">
    <a class="brand" href="{{ url('/') }}" aria-label="{{ config('site.name') }} home">
      <div class="brand-mark">
        <svg width="24" height="24" viewBox="0 0 24 24" aria-hidden="true"><defs><linearGradient id="bg1" x1="0" y1="0" x2="1" y2="1"><stop offset="0" stop-color="#ffe7a3"/><stop offset="1" stop-color="#e8792c"/></linearGradient></defs><path d="M5 21V3h14v4H9.5v4H17v4H9.5v6z" fill="url(#bg1)"/></svg>
      </div>
      <div class="brand-name">{{ config('site.name') }}<span>Grow · Save · Prosper</span></div>
    </a>
    <a class="header-call" href="tel:{{ $phoneIntl }}"><span class="dot"></span><span class="txt">Call us</span><span class="num-txt">{{ $phoneDisplay }}</span><svg class="ph" width="18" height="18" viewBox="0 0 24 24" fill="#ffd77a" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2a1 1 0 011-.25c1.1.37 2.3.57 3.6.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1z"/></svg></a>
  </header>

  <main>
    <div class="badge reveal d1">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="#ffd77a" aria-hidden="true"><path d="M12 2l2.4 7.2H22l-6 4.6 2.3 7.2L12 16.6 5.7 21l2.3-7.2-6-4.6h7.6z"/></svg>
      Launching this Diwali
    </div>

    <h1 class="reveal d2">Something <em>golden</em><br>is on its way</h1>

    <p class="lead reveal d3">
      <strong>{{ config('site.name') }}</strong> brings next-generation financial empowerment and micro-care solutions designed for your growth journey. Like the first diya of Diwali, we're lighting the way to a brighter tomorrow.
    </p>

    <div class="diya-row reveal d3" aria-hidden="true">
      <div class="diya"><div class="flame"></div>
        <svg viewBox="0 0 80 40"><defs><linearGradient id="dy" x1="0" y1="0" x2="0" y2="1"><stop offset="0" stop-color="#f4a340"/><stop offset="1" stop-color="#9c3b12"/></linearGradient></defs><path d="M2 8 Q40 22 78 8 Q72 36 40 38 Q8 36 2 8z" fill="url(#dy)"/><path d="M2 8 Q40 22 78 8" stroke="#ffd77a" stroke-width="2" fill="none"/><circle cx="24" cy="26" r="2" fill="#ffd77a"/><circle cx="40" cy="29" r="2" fill="#ffd77a"/><circle cx="56" cy="26" r="2" fill="#ffd77a"/></svg>
      </div>
      <div class="diya big"><div class="flame"></div>
        <svg viewBox="0 0 80 40"><path d="M2 8 Q40 22 78 8 Q72 36 40 38 Q8 36 2 8z" fill="url(#dy)"/><path d="M2 8 Q40 22 78 8" stroke="#ffd77a" stroke-width="2" fill="none"/><path d="M18 24 l4 4 l4 -4 M36 27 l4 4 l4 -4 M54 24 l4 4 l4 -4" stroke="#ffd77a" stroke-width="1.5" fill="none"/></svg>
      </div>
      <div class="diya"><div class="flame"></div>
        <svg viewBox="0 0 80 40"><path d="M2 8 Q40 22 78 8 Q72 36 40 38 Q8 36 2 8z" fill="url(#dy)"/><path d="M2 8 Q40 22 78 8" stroke="#ffd77a" stroke-width="2" fill="none"/><circle cx="24" cy="26" r="2" fill="#ffd77a"/><circle cx="40" cy="29" r="2" fill="#ffd77a"/><circle cx="56" cy="26" r="2" fill="#ffd77a"/></svg>
      </div>
    </div>

    <div class="count-label reveal d4">The countdown to launch</div>
    <div class="countdown reveal d4" role="timer" aria-live="off">
      <div class="unit"><span class="num" id="d">00</span><span class="lbl">Days</span></div>
      <div class="unit"><span class="num" id="h">00</span><span class="lbl">Hours</span></div>
      <div class="unit"><span class="num" id="m">00</span><span class="lbl">Minutes</span></div>
      <div class="unit"><span class="num" id="s">00</span><span class="lbl">Seconds</span></div>
    </div>
    <p class="launch-date reveal d5">Grand launch on <b>Diwali · {{ $launchAt->format('l, j F Y') }}</b></p>

    <div class="live" id="live">
      <h2>✨ Happy Diwali — We're Live!</h2>
      <p>Thank you for waiting. Call us now to get started with {{ config('site.name') }}.</p>
    </div>

    <div class="ctas reveal d5">
      <a class="btn btn-gold" href="tel:{{ $phoneIntl }}">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2a1 1 0 011-.25c1.1.37 2.3.57 3.6.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1z"/></svg>
        Call {{ $phone }}
      </a>
      <a class="btn btn-ghost" href="https://wa.me/{{ ltrim($phoneIntl, '+') }}?text=Hello%20Finaza%20Microcare%2C%20I%27d%20like%20to%20know%20more%20about%20your%20services." target="_blank" rel="noopener">
        <svg width="18" height="18" viewBox="0 0 24 24" fill="#25D366" aria-hidden="true"><path d="M12 2a10 10 0 00-8.6 15.1L2 22l5-1.3A10 10 0 1012 2zm0 18.2a8.2 8.2 0 01-4.2-1.15l-.3-.18-3 .78.8-2.9-.2-.3A8.2 8.2 0 1112 20.2zm4.5-6.1c-.25-.12-1.47-.72-1.7-.8s-.39-.12-.56.12-.64.8-.78.97-.29.18-.54.06a6.7 6.7 0 01-3.33-2.9c-.25-.43.25-.4.72-1.34a.45.45 0 000-.43c-.06-.12-.56-1.34-.76-1.84s-.4-.42-.56-.42h-.48a.92.92 0 00-.67.31 2.8 2.8 0 00-.87 2.08 4.9 4.9 0 001 2.6 11.2 11.2 0 004.3 3.8c1.6.69 2.23.75 3.03.63a2.6 2.6 0 001.7-1.2 2.1 2.1 0 00.15-1.2c-.06-.11-.23-.17-.48-.29z"/></svg>
        Chat on WhatsApp
      </a>
    </div>

    <section class="features" aria-label="What to expect">
      <div class="feat reveal d6">
        <div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffd77a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M3 17l6-6 4 4 8-8"/><path d="M14 7h7v7"/></svg></div>
        <h3>Financial Empowerment</h3>
        <p>Simple, transparent solutions that help you take the next step forward.</p>
      </div>
      <div class="feat reveal d6">
        <div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffd77a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-4.5-9.5-9A5.5 5.5 0 0112 6a5.5 5.5 0 019.5 6c-2.5 4.5-9.5 9-9.5 9z"/></svg></div>
        <h3>Micro-Care Solutions</h3>
        <p>Thoughtfully designed support for individuals, families and small businesses.</p>
      </div>
      <div class="feat reveal d7">
        <div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffd77a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6z"/><path d="M9 12l2 2 4-4"/></svg></div>
        <h3>Trusted &amp; Secure</h3>
        <p>Built on honesty, clarity and care — every step of your journey.</p>
      </div>
      <div class="feat reveal d7">
        <div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#ffd77a" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="9"/><path d="M12 7v5l3 2"/></svg></div>
        <h3>24/7 Support</h3>
        <p>We're always a call away whenever you need guidance or assistance.</p>
      </div>
    </section>

    <section class="contact" aria-label="Contact information">
      <a class="card reveal d7" href="tel:{{ $phoneIntl }}">
        <div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="#2a1300" aria-hidden="true"><path d="M6.6 10.8a15.1 15.1 0 006.6 6.6l2.2-2.2a1 1 0 011-.25c1.1.37 2.3.57 3.6.57a1 1 0 011 1V20a1 1 0 01-1 1A17 17 0 013 4a1 1 0 011-1h3.5a1 1 0 011 1c0 1.25.2 2.45.57 3.57a1 1 0 01-.25 1z"/></svg></div>
        <div><small>Call us</small><div class="big">{{ $phoneDisplay }}</div></div>
      </a>
      <div class="card reveal d7">
        <div class="ico"><svg width="22" height="22" viewBox="0 0 24 24" fill="#2a1300" aria-hidden="true"><path d="M12 2a7 7 0 00-7 7c0 5.25 7 13 7 13s7-7.75 7-13a7 7 0 00-7-7zm0 9.5A2.5 2.5 0 1112 6.5a2.5 2.5 0 010 5z"/></svg></div>
        <div>
          <small>Visit our office</small>
          <address>{{ config('site.address') }}</address>
          <a class="map-link" href="{{ $mapsUrl }}" target="_blank" rel="noopener">Get directions →</a>
        </div>
      </div>
    </section>
  </main>
</div>

<footer>
  <span class="greet">Wishing you a bright &amp; prosperous Diwali</span>
  © <span id="yr">{{ now()->year }}</span> {{ config('site.name') }}. All rights reserved.
</footer>

<script src="{{ asset('js/coming-soon.js') }}?v={{ filemtime(public_path('js/coming-soon.js')) }}" defer></script>
</body>
</html>
