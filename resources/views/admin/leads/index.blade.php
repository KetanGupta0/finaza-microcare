<x-layouts.admin title="Leads">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <h1 class="text-2xl font-semibold sm:text-3xl">Leads &amp; Enquiries</h1>
            <p class="mt-1 text-sm text-slate-500">All enquiries submitted from the website.</p>
        </div>
        <a href="{{ route('admin.leads.export', request()->query()) }}" class="btn btn-outline px-4 py-2 text-sm"><i data-lucide="download" class="size-4"></i> Export CSV</a>
    </div>

    <div class="mt-6 grid grid-cols-2 gap-4 lg:grid-cols-4">
        @foreach ([
            ['label' => 'Total leads', 'value' => $stats['total'], 'icon' => 'users', 'tone' => 'bg-navy-900 text-gold-300'],
            ['label' => 'New (not contacted)', 'value' => $stats['new'], 'icon' => 'bell-ring', 'tone' => 'bg-sky-100 text-sky-700'],
            ['label' => 'Today', 'value' => $stats['today'], 'icon' => 'calendar-check', 'tone' => 'bg-emerald-100 text-emerald-700'],
            ['label' => 'This week', 'value' => $stats['week'], 'icon' => 'calendar-range', 'tone' => 'bg-gold-100 text-gold-700'],
        ] as $card)
            <div class="flex items-center gap-4 rounded-2xl border border-slate-200 bg-white p-4 sm:p-5">
                <span class="grid size-11 shrink-0 place-items-center rounded-xl {{ $card['tone'] }}"><i data-lucide="{{ $card['icon'] }}" class="size-5"></i></span>
                <div>
                    <p class="font-display text-2xl font-semibold text-navy-900">{{ number_format($card['value']) }}</p>
                    <p class="text-xs text-slate-500 sm:text-sm">{{ $card['label'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

    <form method="GET" action="{{ route('admin.leads.index') }}" class="mt-6 grid gap-3 rounded-2xl border border-slate-200 bg-white p-4 sm:grid-cols-2 lg:grid-cols-[2fr_1fr_1fr_1fr_1fr_auto]">
        <div class="relative">
            <i data-lucide="search" class="pointer-events-none absolute top-1/2 left-3.5 size-4 -translate-y-1/2 text-slate-400"></i>
            <input type="search" name="search" value="{{ $filters['search'] }}" placeholder="Search name, phone, email, city" class="field py-2.5 pl-10 text-sm" aria-label="Search leads">
        </div>
        <select name="status" class="field py-2.5 text-sm" aria-label="Filter by status">
            <option value="">All statuses</option>
            @foreach ($statuses as $status)
                <option value="{{ $status->value }}" @selected($filters['status'] === $status->value)>{{ $status->label() }}</option>
            @endforeach
        </select>
        <select name="service" class="field py-2.5 text-sm" aria-label="Filter by service">
            <option value="">All services</option>
            @foreach (config('site.services') as $key => $service)
                <option value="{{ $key }}" @selected($filters['service'] === $key)>{{ $service['title'] }}</option>
            @endforeach
        </select>
        <input type="date" name="from" value="{{ $filters['from'] }}" class="field py-2.5 text-sm" aria-label="From date">
        <input type="date" name="to" value="{{ $filters['to'] }}" class="field py-2.5 text-sm" aria-label="To date">
        <div class="flex gap-2">
            <button type="submit" class="btn btn-navy flex-1 px-4 py-2.5 text-sm">Filter</button>
            @if (array_filter($filters))
                <a href="{{ route('admin.leads.index') }}" class="btn btn-outline px-4 py-2.5 text-sm" aria-label="Clear filters"><i data-lucide="x" class="size-4"></i></a>
            @endif
        </div>
    </form>

    <div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white">
        @if ($leads->isEmpty())
            <div class="flex flex-col items-center px-6 py-16 text-center">
                <span class="grid size-14 place-items-center rounded-2xl bg-slate-100 text-slate-400"><i data-lucide="inbox" class="size-7"></i></span>
                <p class="mt-4 font-semibold text-navy-900">No leads found</p>
                <p class="mt-1 text-sm text-slate-500">New enquiries from the website will appear here.</p>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-slate-200 text-sm">
                    <thead class="bg-slate-50 text-left text-xs font-semibold tracking-wider text-slate-500 uppercase">
                        <tr>
                            <th scope="col" class="px-5 py-3">Lead</th>
                            <th scope="col" class="px-5 py-3">Phone</th>
                            <th scope="col" class="hidden px-5 py-3 md:table-cell">Service</th>
                            <th scope="col" class="hidden px-5 py-3 lg:table-cell">Message</th>
                            <th scope="col" class="px-5 py-3">Status</th>
                            <th scope="col" class="hidden px-5 py-3 sm:table-cell">Received</th>
                            <th scope="col" class="px-5 py-3"><span class="sr-only">Actions</span></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @foreach ($leads as $lead)
                            <tr class="transition hover:bg-slate-50">
                                <td class="px-5 py-4">
                                    <a href="{{ route('admin.leads.show', $lead) }}" class="font-semibold text-navy-900 hover:text-gold-600">{{ $lead->name }}</a>
                                    <p class="text-xs text-slate-500">{{ collect([$lead->city, $lead->email])->filter()->implode(' · ') ?: '—' }}</p>
                                </td>
                                <td class="px-5 py-4 whitespace-nowrap">
                                    <a href="tel:+91{{ $lead->phone }}" class="font-medium text-navy-700 hover:underline">{{ $lead->phone }}</a>
                                </td>
                                <td class="hidden px-5 py-4 text-slate-600 md:table-cell">{{ $lead->serviceTitle() ?? 'Not specified' }}</td>
                                <td class="hidden max-w-xs px-5 py-4 text-slate-600 lg:table-cell"><p class="line-clamp-2">{{ $lead->message ?: '—' }}</p></td>
                                <td class="px-5 py-4"><span class="inline-flex rounded-full px-2.5 py-1 text-xs font-semibold ring-1 ring-inset {{ $lead->status->badgeClasses() }}">{{ $lead->status->label() }}</span></td>
                                <td class="hidden px-5 py-4 whitespace-nowrap text-slate-500 sm:table-cell" title="{{ $lead->created_at->timezone(config('site.timezone'))->format('d M Y, h:i A') }}">{{ $lead->created_at->diffForHumans() }}</td>
                                <td class="px-5 py-4 text-right">
                                    <div class="flex items-center justify-end gap-1">
                                        <a href="https://wa.me/91{{ $lead->phone }}" target="_blank" rel="noopener" class="grid size-8 place-items-center rounded-lg text-emerald-600 hover:bg-emerald-50" aria-label="WhatsApp {{ $lead->name }}"><x-whatsapp-icon class="size-4" /></a>
                                        <a href="{{ route('admin.leads.show', $lead) }}" class="grid size-8 place-items-center rounded-lg text-slate-500 hover:bg-slate-100" aria-label="View {{ $lead->name }}"><i data-lucide="chevron-right" class="size-4"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @if ($leads->hasPages())
                <div class="border-t border-slate-200 px-5 py-4">{{ $leads->links() }}</div>
            @endif
        @endif
    </div>
</x-layouts.admin>
