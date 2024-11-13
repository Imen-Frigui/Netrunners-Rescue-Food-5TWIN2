<?php

namespace App\Http\Controllers;

use App\Models\Sponsor;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use League\Csv\Writer;
use App\Notifications\InvoiceGenerated;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use App\Models\Scan;


class SponsorController extends Controller
{
    // Display a listing of the sponsors
    public function index(Request $request)
    {
        $query = $request->input('search');
        $sponsors = Sponsor::withSum('events as total_sponsorship_amount', 'event_sponsor.sponsorship_amount')
        ->when($query, function ($queryBuilder) use ($query) {
            return $queryBuilder->where('name', 'like', '%' . $query . '%')
                                ->orWhere('email', 'like', '%' . $query . '%')
                                ->orWhere('company', 'like', '%' . $query . '%');
        })
        ->paginate(10);

        return view('dashboard.sponsors.index', compact('sponsors', 'query'));
    }

    // Show the form for creating a new sponsor
    public function create()
    {
        return view('dashboard.sponsors.create');
    }

    // Store a newly created sponsor in storage
    public function store(StoreSponsorRequest $request)
    {
        Sponsor::create($request->validated());

        return redirect()->route('sponsors.index')->with('success', 'Sponsor added successfully');
    }

    // Show the form for editing the specified sponsor
    public function edit(Sponsor $sponsor)
    {
        return view('dashboard.sponsors.edit', compact('sponsor'));
    }

    // Update the specified sponsor in storage
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        $sponsor->update($request->validated());

        return redirect()->route('sponsors.index')->with('success', 'Sponsor updated successfully');
    }

    // Remove the specified sponsor from storage
    public function destroy(Sponsor $sponsor)
    {
        $sponsor->delete();
        return redirect()->route('sponsors.index')->with('success', 'Sponsor deleted successfully');
    }

    public function show(Sponsor $sponsor)
    {
        $sponsor->load('events');

        $totalSponsorshipAmount = $sponsor->events->sum('pivot.sponsorship_amount');
        $averageParticipants = $sponsor->events->avg('max_participants');

        return view('front-office.sponsors.show', compact('sponsor', 'totalSponsorshipAmount', 'averageParticipants'));
    }

    public function exportPdf(Sponsor $sponsor)
    {
        $sponsor->load('events');

        $data = [
            'sponsor' => $sponsor,
            'events' => $sponsor->events
        ];

        $pdf = Pdf::loadView('sponsors.report', $data);
        return $pdf->download("sponsor_report_{$sponsor->id}.pdf");
    }

    public function exportCsv(Sponsor $sponsor)
    {
        $sponsor->load('events');

        $csv = Writer::createFromString('');
        $csv->insertOne(['Event Name', 'Date', 'Location', 'Participants', 'Sponsorship Amount', 'Sponsorship Level']);

        foreach ($sponsor->events as $event) {
            $csv->insertOne([
                $event->name,
                $event->event_date->format('Y-m-d'),
                $event->location,
                $event->max_participants,
                $event->pivot->sponsorship_amount,
                $event->pivot->sponsorship_level,
            ]);
        }

        return response((string) $csv)->header('Content-Type', 'text/csv')
                    ->header('Content-Disposition', 'attachment; filename="sponsor_report_' . $sponsor->id . '.csv"');
    }

    public function generateInvoice(Sponsor $sponsor, Request $request)
    {
        $startDate = $request->input('start_date', now()->startOfMonth()->subMonth());
        $endDate = $request->input('end_date', now()->startOfMonth());


        $sponsoredEvents = $sponsor->events()
            ->withPivot('sponsorship_amount')
            ->get();

        $totalAmount = $sponsoredEvents->sum('pivot.sponsorship_amount');

        // dd($totaltAmount,$totalAmount,$startDate, $endDate, $sponsoredEvents);

        $data = [
            'sponsor' => $sponsor,
            'events' => $sponsoredEvents,
            'totalAmount' => $totalAmount,
            'startDate' => $startDate->format('d M Y'),
            'endDate' => $endDate->format('d M Y')
        ];

        $pdf = Pdf::loadView('dashboard.sponsors.invoice', $data);
        $sponsor->notify(new InvoiceGenerated($data));

        return $pdf->download("invoice_{$sponsor->id}_{$startDate->format('Ymd')}_{$endDate->format('Ymd')}.pdf");
    }

    public function generateQrCode(Sponsor $sponsor, $eventId)
    {
        $url = route('sponsors.scan', ['sponsor' => $sponsor->id, 'eventId' => $eventId]);
        $qrCode = QrCode::size(200)->generate($url);

        return view('front-office.sponsors.qr_code', compact('qrCode', 'sponsor', 'eventId'));
    }

    public function trackScan(Sponsor $sponsor, $eventId = null)
    {
        Scan::create([
            'sponsor_id' => $sponsor->id,
            'event_id' => $eventId,
            'scanned_at' => now(),
        ]);

        return redirect()->route('sponsors.show', $sponsor->id);
    }
    

    public function report(Sponsor $sponsor)
    {
        $totalScans = Scan::where('sponsor_id', $sponsor->id)->count();
        $scansPerEvent = Scan::where('sponsor_id', $sponsor->id)
            ->selectRaw('event_id, count(*) as count')
            ->groupBy('event_id')
            ->get();
        $events = $sponsor->events;

        return view('dashboard.sponsors.report', compact('sponsor', 'totalScans', 'scansPerEvent', 'events'));
    }


}