<x-layouts.admin :title="$lead->name">
    <a href="{{ route('admin.leads.index') }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-slate-500 hover:text-navy-900"><i data-lucide="arrow-left" class="size-4"></i> All leads</a>

    <div class="mt-4 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold sm:text-3xl">{{ $lead->name }}</h1>
            <p class="mt-1 text-sm text-slate-500">Lead #{{ $lead->id }} &middot; received {{ $lead->created_at->timezone(config('site.timezone'))->format('d M Y, h:i A') }}</p>
        </div>
        <div class="flex gap-2">
            <a href="tel:+91{{ $lead->phone }}" class="btn btn-navy px-4 py-2 text-sm"><i data-lucide="phone" class="size-4"></i> Call</a>
            <a href="https://wa.me/91{{ $lead->phone }}" target="_blank" rel="noopener" class="btn px-4 py-2 text-sm bg-[#25D366] text-white hover:-translate-y-0.5"><x-whatsapp-icon class="size-4" /> WhatsApp</a>
        </div>
    </div>

    <div class="mt-6 grid gap-6 lg:grid-cols-[1.4fr_1fr]">
        <div class="rounded-2xl border border-slate-200 bg-white">
            <h2 class="border-b border-slate-100 px-6 py-4 text-lg font-semibold">Enquiry details</h2>
            <dl class="divide-y divide-slate-100 text-sm">
                @foreach ([
                    'Phone' => $lead->phone,
                    'Email' => $lead->email,
                    'City / Village' => $lead->city,
                    'Interested in' => $lead->serviceTitle() ?? 'Not specified',
                    'Submitted from' => $lead->source_page,
                    'IP address' => $lead->ip_address,
                ] as $label => $value)
                    <div class="grid gap-1 px-6 py-3.5 sm:grid-cols-[10rem_1fr]">
                        <dt class="text-slate-500">{{ $label }}</dt>
                        <dd class="font-medium break-words text-navy-900">{{ $value ?: '—' }}</dd>
                    </div>
                @endforeach
                <div class="px-6 py-4">
                    <dt class="text-slate-500">Message</dt>
                    <dd class="mt-2 rounded-xl bg-slate-50 p-4 leading-relaxed whitespace-pre-line text-navy-900">{{ $lead->message ?: 'No message provided.' }}</dd>
                </div>
            </dl>
        </div>

        <div class="space-y-6">
            <form method="POST" action="{{ route('admin.leads.update', $lead) }}" class="rounded-2xl border border-slate-200 bg-white p-6">
                @csrf
                @method('PATCH')
                <h2 class="text-lg font-semibold">Follow-up</h2>
                <label for="status" class="field-label mt-5">Status</label>
                <select id="status" name="status" class="field">
                    @foreach ($statuses as $status)
                        <option value="{{ $status->value }}" @selected(old('status', $lead->status->value) === $status->value)>{{ $status->label() }}</option>
                    @endforeach
                </select>
                @error('status')<p class="field-error">{{ $message }}</p>@enderror
                <label for="notes" class="field-label mt-5">Internal notes</label>
                <textarea id="notes" name="notes" rows="6" class="field resize-y" placeholder="Call summary, next follow-up date...">{{ old('notes', $lead->notes) }}</textarea>
                @error('notes')<p class="field-error">{{ $message }}</p>@enderror
                <button type="submit" class="btn btn-navy mt-5 w-full"><i data-lucide="save" class="size-4"></i> Save changes</button>
                <p class="mt-3 text-center text-xs text-slate-400">Last updated {{ $lead->updated_at->diffForHumans() }}</p>
            </form>

            <form method="POST" action="{{ route('admin.leads.destroy', $lead) }}" onsubmit="return confirm('Delete this lead permanently?')" class="rounded-2xl border border-rose-200 bg-rose-50/50 p-6">
                @csrf
                @method('DELETE')
                <p class="text-sm text-rose-800">Delete spam or duplicate leads. This cannot be undone.</p>
                <button type="submit" class="mt-3 inline-flex items-center gap-1.5 text-sm font-semibold text-rose-700 hover:text-rose-900"><i data-lucide="trash-2" class="size-4"></i> Delete lead</button>
            </form>
        </div>
    </div>
</x-layouts.admin>
