<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLeadRequest;
use App\Models\Lead;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class LeadController extends Controller
{
    /**
     * Store an enquiry submitted from the public website.
     */
    public function store(StoreLeadRequest $request): RedirectResponse
    {
        $previousPath = parse_url(url()->previous(), PHP_URL_PATH) ?: '/';

        Lead::create([
            ...$request->safe()->except(['consent', 'website']),
            'source_page' => Str::limit($previousPath, 250, ''),
            'ip_address' => $request->ip(),
            'user_agent' => Str::limit((string) $request->userAgent(), 490, ''),
        ]);

        return redirect()->to(url()->previous().'#enquiry')
            ->with('lead_submitted', 'Thank you! Your enquiry has been received. Our team will call you shortly.');
    }
}
