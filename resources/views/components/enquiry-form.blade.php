@props(['heading' => 'Send us an enquiry'])
<div {{ $attributes->merge(['class' => 'relative rounded-[1.75rem] border border-slate-200 bg-white p-6 shadow-2xl shadow-navy-900/10 sm:p-9']) }}>
    <div class="flex items-center gap-3">
        <span class="grid size-11 place-items-center rounded-2xl bg-navy-900 text-gold-300"><i data-lucide="message-square-text" class="size-5"></i></span>
        <div>
            <h3 class="text-xl font-semibold">{{ $heading }}</h3>
            <p class="text-sm text-slate-500">We usually call back within one working day.</p>
        </div>
    </div>

    @if (session('lead_submitted'))
        <div role="status" class="mt-6 flex items-start gap-3 rounded-2xl border border-emerald-200 bg-emerald-50 p-4 text-emerald-800">
            <i data-lucide="circle-check-big" class="mt-0.5 size-5 shrink-0"></i>
            <p class="text-sm font-medium">{{ session('lead_submitted') }}</p>
        </div>
    @endif

    <form method="POST" action="{{ route('leads.store') }}" class="mt-6 grid gap-5 sm:grid-cols-2" data-enquiry-form novalidate>
        @csrf
        <div class="hidden" aria-hidden="true">
            <label for="website">Leave this field empty</label>
            <input type="text" id="website" name="website" tabindex="-1" autocomplete="off">
        </div>

        <div>
            <label for="name" class="field-label">Full name <span class="text-rose-500">*</span></label>
            <input id="name" name="name" type="text" required maxlength="120" autocomplete="name" value="{{ old('name') }}" class="field" placeholder="Your name" @error('name') aria-invalid="true" aria-describedby="name-error" @enderror>
            @error('name')<p id="name-error" class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="phone" class="field-label">Mobile number <span class="text-rose-500">*</span></label>
            <div class="relative">
                <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-sm text-slate-500">+91</span>
                <input id="phone" name="phone" type="tel" required inputmode="numeric" maxlength="14" autocomplete="tel-national" value="{{ old('phone') }}" class="field pl-12" placeholder="10-digit number" @error('phone') aria-invalid="true" aria-describedby="phone-error" @enderror>
            </div>
            @error('phone')<p id="phone-error" class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="email" class="field-label">Email <span class="font-normal text-slate-400">(optional)</span></label>
            <input id="email" name="email" type="email" maxlength="255" autocomplete="email" value="{{ old('email') }}" class="field" placeholder="you@example.com">
            @error('email')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div>
            <label for="city" class="field-label">City / Village <span class="font-normal text-slate-400">(optional)</span></label>
            <input id="city" name="city" type="text" maxlength="120" autocomplete="address-level2" value="{{ old('city') }}" class="field" placeholder="e.g. Patna">
            @error('city')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <label for="service" class="field-label">I am interested in</label>
            <select id="service" name="service" class="field">
                <option value="">Not sure yet, please guide me</option>
                @foreach (config('site.services') as $key => $service)
                    <option value="{{ $key }}" @selected(old('service', request('service')) === $key)>{{ $service['title'] }}</option>
                @endforeach
            </select>
            @error('service')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <label for="message" class="field-label">Message <span class="font-normal text-slate-400">(optional)</span></label>
            <textarea id="message" name="message" rows="3" maxlength="2000" class="field resize-none" placeholder="Tell us a little about your need">{{ old('message') }}</textarea>
            @error('message')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <label class="flex items-start gap-3 text-sm text-slate-600">
                <input type="checkbox" name="consent" value="1" @checked(old('consent')) class="mt-0.5 size-4 shrink-0 rounded border-slate-300 accent-navy-900">
                <span>I agree that {{ config('site.name') }} may call or WhatsApp me about this enquiry. Read our <a href="{{ route('privacy') }}" class="font-medium text-navy-700 underline underline-offset-2">Privacy Policy</a>.</span>
            </label>
            @error('consent')<p class="field-error">{{ $message }}</p>@enderror
            @error('website')<p class="field-error">{{ $message }}</p>@enderror
        </div>
        <div class="sm:col-span-2">
            <button type="submit" class="btn btn-navy group w-full">
                <span data-label>Submit Enquiry</span>
                <i data-lucide="arrow-right" class="size-4 transition group-hover:translate-x-1"></i>
            </button>
            <p class="mt-3 flex items-center justify-center gap-1.5 text-xs text-slate-500"><i data-lucide="lock-keyhole" class="size-3.5"></i> Your details are kept private and never sold.</p>
        </div>
    </form>
</div>
