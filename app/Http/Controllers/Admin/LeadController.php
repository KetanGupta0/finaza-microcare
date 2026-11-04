<?php

namespace App\Http\Controllers\Admin;

use App\Enums\LeadStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateLeadRequest;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LeadController extends Controller
{
    /**
     * Leads table with stats and filters.
     */
    public function index(Request $request): View
    {
        $filters = $this->filters($request);

        $leads = Lead::query()
            ->filter($filters)
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $stats = [
            'total' => Lead::count(),
            'new' => Lead::where('status', LeadStatus::New)->count(),
            'today' => Lead::whereDate('created_at', today())->count(),
            'week' => Lead::where('created_at', '>=', now()->startOfWeek())->count(),
        ];

        return view('admin.leads.index', [
            'leads' => $leads,
            'stats' => $stats,
            'filters' => $filters,
            'statuses' => LeadStatus::cases(),
        ]);
    }

    public function show(Lead $lead): View
    {
        return view('admin.leads.show', [
            'lead' => $lead,
            'statuses' => LeadStatus::cases(),
        ]);
    }

    public function update(UpdateLeadRequest $request, Lead $lead): RedirectResponse
    {
        $lead->update($request->validated());

        return redirect()->route('admin.leads.show', $lead)->with('status', 'Lead updated.');
    }

    public function destroy(Lead $lead): RedirectResponse
    {
        $lead->delete();

        return redirect()->route('admin.leads.index')->with('status', 'Lead deleted.');
    }

    /**
     * Download the (filtered) leads as a CSV file.
     */
    public function export(Request $request): StreamedResponse
    {
        $filters = $this->filters($request);

        return response()->streamDownload(function () use ($filters): void {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Date', 'Name', 'Phone', 'Email', 'City', 'Service', 'Status', 'Message', 'Notes', 'Source page']);

            Lead::query()->filter($filters)->latest()->lazy()->each(function (Lead $lead) use ($handle): void {
                fputcsv($handle, array_map($this->escapeCsvFormula(...), [
                    $lead->id,
                    $lead->created_at?->timezone(config('site.timezone'))->format('Y-m-d H:i'),
                    $lead->name,
                    $lead->phone,
                    $lead->email,
                    $lead->city,
                    $lead->serviceTitle(),
                    $lead->status->label(),
                    $lead->message,
                    $lead->notes,
                    $lead->source_page,
                ]));
            });

            fclose($handle);
        }, 'finaza-leads-'.now()->format('Y-m-d').'.csv', ['Content-Type' => 'text/csv; charset=UTF-8']);
    }

    /**
     * @return array{search: ?string, status: ?string, service: ?string, from: ?string, to: ?string}
     */
    private function filters(Request $request): array
    {
        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', Rule::enum(LeadStatus::class)],
            'service' => ['nullable', Rule::in(array_keys(config('site.services')))],
            'from' => ['nullable', 'date'],
            'to' => ['nullable', 'date'],
        ]);

        return [
            'search' => $validated['search'] ?? null,
            'status' => $validated['status'] ?? null,
            'service' => $validated['service'] ?? null,
            'from' => $validated['from'] ?? null,
            'to' => $validated['to'] ?? null,
        ];
    }

    /**
     * Prevent spreadsheet formula injection from user-submitted values.
     */
    private function escapeCsvFormula(mixed $value): mixed
    {
        if (is_string($value) && $value !== '' && in_array($value[0], ['=', '+', '-', '@', "\t", "\r"], true)) {
            return "'".$value;
        }

        return $value;
    }
}
