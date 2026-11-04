@props(['title' => 'Leads'])
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="noindex, nofollow">
    <title>{{ $title }} | {{ config('site.name') }} Admin</title>
    <link rel="icon" href="{{ asset('images/brand/icon.svg') }}" type="image/svg+xml">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Outfit:wght@500;600;700&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/lucide@0.460.0/dist/umd/lucide.min.js" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50">
    @auth
        <header class="sticky top-0 z-30 border-b border-slate-200 bg-white/90 backdrop-blur">
            <div class="container-x flex h-16 items-center justify-between gap-4">
                <a href="{{ route('admin.leads.index') }}" class="flex items-center gap-3">
                    <x-brand-icon id="adm" class="size-9" />
                    <span class="leading-none">
                        <span class="block font-display font-bold tracking-[.06em] text-navy-900">FINAZA</span>
                        <span class="mt-0.5 block text-[.65rem] font-semibold tracking-[.2em] text-gold-600 uppercase">Admin</span>
                    </span>
                </a>
                <div class="flex items-center gap-2">
                    <a href="{{ route('home') }}" target="_blank" class="hidden items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100 sm:inline-flex"><i data-lucide="external-link" class="size-4"></i> View site</a>
                    <span class="hidden text-sm text-slate-500 md:inline">{{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="inline-flex items-center gap-1.5 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 hover:bg-slate-100"><i data-lucide="log-out" class="size-4"></i> Logout</button>
                    </form>
                </div>
            </div>
        </header>
    @endauth

    <main class="container-x py-8 sm:py-10">
        @if (session('status'))
            <div role="status" class="mb-6 flex items-center gap-2 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">
                <i data-lucide="circle-check" class="size-4"></i> {{ session('status') }}
            </div>
        @endif
        {{ $slot }}
    </main>
</body>
</html>
