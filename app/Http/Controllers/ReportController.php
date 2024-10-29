<?php

namespace App\Http\Controllers;
use App\Models\Report; // Import the Report model
use App\Models\Charity;

use Illuminate\Http\Request;

class ReportController extends Controller
{
     // Display a listing of the reports
     public function index(Request $request)
     {
         // Get the search term from the request
         $searchTerm = $request->input('search');
     
         // Use paginate() with a search condition
         $reports = Report::with('charity')
             ->when($searchTerm, function ($query, $searchTerm) {
                 // Assuming you want to search in the title and description fields
                 return $query->where('report_type', 'like', "%{$searchTerm}%")
                              ->orWhere('content', 'like', "%{$searchTerm}%")
                              ->orWhereHas('charity', function ($query) use ($searchTerm) {
                                  $query->where('charity_name', 'like', "%{$searchTerm}%");
                              });
             })
             ->paginate(6); // Retrieve 6 reports per page
     
         return view('reports.index', compact('reports', 'searchTerm'));
     }
     
     // Show the form for creating a new report
     public function create()
     {
         return view('reports.create');
     }
 
     // Store a newly created report in storage
     public function store(Request $request)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string',
             'charity_id' => 'required|exists:charities,id',
             // Add more validation rules as needed
         ]);
 
         Report::create($request->all());
 
         return redirect()->route('reports.index')->with('success', 'Report created successfully.');
     }
 
     // Display the specified report
     public function show($id)
     {
         $report = Report::with('charity')->findOrFail($id); // Eager load charity relationship
         return view('reports.details', compact('report'));
     }
     
     // Show the form for editing the specified report
     public function edit(Report $report)
     {
         return view('reports.edit', compact('report'));
     }
 
     // Update the specified report in storage
     public function update(Request $request, Report $report)
     {
         $request->validate([
             'title' => 'required|string|max:255',
             'description' => 'required|string',
             'charity_id' => 'required|exists:charities,id',
             // Add more validation rules as needed
         ]);
 
         $report->update($request->all());
 
         return redirect()->route('reports.index')->with('success', 'Report updated successfully.');
     }
 
     // Remove the specified report from storage
     public function destroy(Report $report)
     {
         $report->delete();
 
         return redirect()->route('reports.index')->with('success', 'Report deleted successfully.');
     }
}
