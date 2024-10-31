<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Food;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
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

        return view('dashboard.index', compact('labels', 'data', 'foodLabels', 'foodData'));
    }
}
