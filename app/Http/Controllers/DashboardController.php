<?php

namespace App\Http\Controllers;

use App\Models\Charity;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch the counts of charities by type
        $charityTypeCounts = Charity::select('charity_type', \DB::raw('count(*) as count'))
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
        return view('dashboard.index', compact('charityTypes', 'charityCounts', 'timeSinceAdded', 'totalCharities', 'charitiesLastWeek'));
    }
}
