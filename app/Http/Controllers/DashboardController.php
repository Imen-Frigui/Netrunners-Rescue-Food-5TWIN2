<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sponsor;

class DashboardController extends Controller
{
    public function index()
    {
        $totalSponsorshipAmount = Sponsor::with('events')->get()->sum(function ($sponsor) {
            return $sponsor->events->sum('pivot.sponsorship_amount');
        });

        $sponsorsCount = Sponsor::count();

        return view('dashboard.index', compact('totalSponsorshipAmount', 'sponsorsCount'));
    }
}
