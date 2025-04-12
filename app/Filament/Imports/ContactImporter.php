<?php

namespace App\Filament\Imports;

use Carbon\Carbon;
use App\Models\Contact;
use Illuminate\Validation\Rule;
use Filament\Actions\Imports\Importer;
use Filament\Actions\Imports\ImportColumn;
use Filament\Actions\Imports\Models\Import;

class ContactImporter extends Importer
{
    protected static ?string $model = Contact::class;

    public static function getColumns(): array
    {
        return [
            ImportColumn::make('first_name')
                ->guess(['first_name', 'name'])
                ->castStateUsing(fn($state) => str($state)->trim()->title())
                ->requiredMapping()
                ->rules([
                    'required',
                    'max:255'
                ]),
            ImportColumn::make('last_name')
                ->guess(['last_name'])
                ->castStateUsing(fn($state) => str($state)->trim()->title())
                ->requiredMapping()
                ->rules([
                    'max:255',
                ]),
            ImportColumn::make('date')
                ->guess(['start_time'])
                ->castStateUsing(fn($state) => Carbon::parse($state)->format('Y-m-d'))
                ->requiredMapping()
                ->rules([
                    'required',
                    'date'
                ]),
            ImportColumn::make('email')
                ->castStateUsing(fn($state) => str($state)->trim()->lower())
                ->requiredMapping()
                ->rules([
                    'required',
                    'email',
                    'max:255'
                ]),
            ImportColumn::make('campaign')
                ->guess(['script_name'])
                ->castStateUsing(fn($state) => str($state)->trim()->title())
                ->requiredMapping()
                ->rules([
                    'required',
                    'max:255'
                ]),
            ImportColumn::make('disposition')
                ->castStateUsing(fn($state) => str($state)->trim()->title())
                ->guess([
                    'term_code'
                ])
                ->requiredMapping()
                ->rules([
                    'required',
                    Rule::in(config('app.mailable_dispositions')),
                    'max:255',
                ]),
        ];
    }

    public function resolveRecord(): ?Contact
    {
        return Contact::firstOrNew([
            'email' => $this->data['email'],
            'date' => $this->data['date'],
            // 'email_sent_at' => null
        ], $this->data);
    }

    public static function getCompletedNotificationBody(Import $import): string
    {
        $body = 'Your contact import has completed and ' . number_format($import->successful_rows) . ' ' . str('row')->plural($import->successful_rows) . ' imported.';

        if ($failedRowsCount = $import->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to import.';
        }

        return $body;
    }
}
