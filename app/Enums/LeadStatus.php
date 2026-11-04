<?php

namespace App\Enums;

enum LeadStatus: string
{
    case New = 'new';
    case Contacted = 'contacted';
    case Qualified = 'qualified';
    case Converted = 'converted';
    case Closed = 'closed';

    public function label(): string
    {
        return match ($this) {
            self::New => 'New',
            self::Contacted => 'Contacted',
            self::Qualified => 'Qualified',
            self::Converted => 'Converted',
            self::Closed => 'Closed',
        };
    }

    /**
     * Tailwind classes used for the status badge in the admin panel.
     */
    public function badgeClasses(): string
    {
        return match ($this) {
            self::New => 'bg-sky-50 text-sky-700 ring-sky-600/20',
            self::Contacted => 'bg-amber-50 text-amber-700 ring-amber-600/20',
            self::Qualified => 'bg-violet-50 text-violet-700 ring-violet-600/20',
            self::Converted => 'bg-emerald-50 text-emerald-700 ring-emerald-600/20',
            self::Closed => 'bg-slate-100 text-slate-600 ring-slate-500/20',
        };
    }
}
