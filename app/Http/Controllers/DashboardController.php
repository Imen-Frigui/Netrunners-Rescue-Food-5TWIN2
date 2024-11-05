<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use App\Models\Donation;
use App\Models\Food;
use Illuminate\Http\Request;
use App\Models\Sponsor;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the counts of charities by type
        $charityTypeCounts = Charity::select('charity_type', DB::raw('count(*) as count'))
                                    ->groupBy('charity_type')
                                    ->get();

        // Prepare data for Chart.js
        $charityTypes = $charityTypeCounts->pluck('charity_type');
        $charityCounts = $charityTypeCounts->pluck('count');

        // Fetch the last added charity
        $lastCharity = Charity::latest()->first();
        // Calculate how long ago the last charity was added
        $timeSinceAdded = $lastCharity ? $lastCharity->created_at->diffForHumans() : 'N/A';

        // Count total charities
        $totalCharities = Charity::count(); // Get the total number of charities

        // Count charities added in the last week
        $charitiesLastWeek = Charity::where('created_at', '>=', now()->subWeek())->count(); // Count charities created in the last week

        // Pass the data to the dashboard view
        
        
        $totalSponsorshipAmount = Sponsor::with('events')->get()->sum(function ($sponsor) {
            return $sponsor->events->sum('pivot.sponsorship_amount');
        });

        $sponsorsCount = Sponsor::count();

        // Fetch donation counts grouped by status
        $donationCounts = Donation::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')->all();

        $labels = array_keys($donationCounts);
        $data = array_values($donationCounts);


        $foodCounts = Food::selectRaw('status, COUNT(*) as count')
            ->groupBy('status')
            ->pluck('count', 'status')->all();

        $donationLabels = array_keys($donationCounts);
        $donationData = array_values($donationCounts);

        $foodLabels = array_keys($foodCounts);
        $foodData = array_values($foodCounts);

        return view('dashboard.index', compact('labels', 'data', 'foodLabels', 'foodData','totalSponsorshipAmount', 'sponsorsCount','charityTypes', 'charityCounts', 'timeSinceAdded', 'totalCharities', 'charitiesLastWeek'));
    }
}
