<?php

namespace App\Http\Controllers;
use App\Models\Report; // Import the Report model
use App\Models\Charity;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        // Get the search term from the request
        $searchTerm = $request->input('search');
    
        // Start the query on the Report model
        $reportsQuery = Report::with('charity')->where('status', 'pending');
    
        // Apply the search condition if a search term is provided
        if ($searchTerm) {
            $reportsQuery->where(function ($query) use ($searchTerm) {
                // Assuming you want to search in the report_type and content fields
                $query->where('report_type', 'like', "%{$searchTerm}%")
                      ->orWhere('content', 'like', "%{$searchTerm}%")
                      ->orWhereHas('charity', function ($query) use ($searchTerm) {
                          $query->where('charity_name', 'like', "%{$searchTerm}%");
                      });
            });
        }
    
        // Order reports by created_at in descending order and paginate
        $reports = $reportsQuery->orderBy('created_at', 'desc')->paginate(6);
    
        // Count all reports (for statistics or display purposes)
        $totalReportsCount = Report::where('status', 'pending')->count();
    
        // Pass the reports and other variables to the view
        return view('reports.index', compact('reports', 'searchTerm', 'totalReportsCount'));
    }
    
     // Show the form for creating a new report
     public function create($charityId)
     {
         $charity = Charity::findOrFail($charityId); // Get the specific charity
         return view('reports.create', [
             'charity' => $charity, // Pass the charity to the view
             'charities' => Charity::all() // Pass all charities if needed for selection
         ]);
     }
     
     
 
     // Store a newly created report in storage
     
     
     public function store(Request $request) 
     {
         // Validate the incoming request data
         $validated = $request->validate([
             'content' => 'required|string',
             'report_type' => 'required|in:financial,performance,event summary,Volunteer Report', // Validate report type
             'charity_id' => 'required|exists:charities,id',
         ]);
     
         // Check for bad words in the content
         if ($this->containsBadWords($validated['content'])) {
             return redirect()->back()->withErrors(['content' => 'The content contains inappropriate language.']);
         }
     
         // Create a new report
         $report = Report::create([
             'content' => $validated['content'],
             'report_type' => $validated['report_type'], // Use the validated report type
             'charity_id' => $validated['charity_id'],
             'report_date' => now()->toDateString(), // Set report_date to the current date
         ]);
     
         // Redirect to the charity details page or another route
         return redirect()->route('frontcharities')->with('success', 'Report created successfully.');
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


     public function containsBadWords($content)
{
    $badWords = ['badword1', 'badword2', 'badword3']; // Add prohibited words here
    
    foreach ($badWords as $badWord) {
        if (stripos($content, $badWord) !== false) {
            return true;
        }
    }

    return false;
}
public function markAsSolved($id)
{
    // Find the report by ID
    $report = Report::findOrFail($id);
    
    // Update the report status to 'solved'
    $report->status = 'solved';
    $report->save();

    // Redirect back to reports index with success message
    return redirect()->route('reports.index')->with('success', 'Report marked as solved successfully.');
}

// New function to mark report as rejected
public function markAsRejected($id)
{
    // Find the report by ID
    $report = Report::findOrFail($id);
    
    // Update the report status to 'rejected'
    $report->status = 'rejected';
    $report->save();

    // Redirect back to reports index with success message
    return redirect()->route('reports.index')->with('success', 'Report marked as rejected successfully.');
}

public function downloadPdf($id)
{
    // Find the report by ID and load related charity data
    $report = Report::with('charity')->findOrFail($id);

    // Generate HTML content from a Blade view (we'll create this next)
    $html = view('reports.pdf', compact('report'))->render();

    // Load the HTML content into DOMPDF
    $pdf = Pdf::loadHTML($html);

    // Stream the PDF as a downloadable file
    return $pdf->download('report_' . $report->id . '.pdf');
}


}
