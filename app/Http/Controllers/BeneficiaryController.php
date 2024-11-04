<?php

namespace App\Http\Controllers;

use App\Models\Beneficiary;
use App\Models\User;
use Illuminate\Http\Request;

class BeneficiaryController extends Controller
{
    /**
     * Display a listing of beneficiaries with pagination and search functionality.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Beneficiary::query();

        // Search functionality
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('name', 'LIKE', "%$search%")
                  ->orWhere('contact_info', 'LIKE', "%$search%")
                  ->orWhere('address', 'LIKE', "%$search%")
                  ->orWhereHas('managedBy', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
        }

        // Pagination
        $beneficiaries = $query->with('managedBy')->paginate(5);

        return view('beneficiaries.index', compact('beneficiaries'));
    }

    /**
     * Show the form for creating a new beneficiary.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $admins = User::where('user_type', 'admin')->get();
        return view('beneficiaries.create', compact('admins'));
    }

    /**
     * Store a newly created beneficiary in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:50|unique:beneficiaries,name',
            'contact_info' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:Individual,Organization,School,Hospital,Shelter,Community Center,Family',
            'managed_by' => 'required|exists:users,id', 
            'status' => 'required|in:Active,Inactive',
            'needs' => 'nullable|string|min:10|max:500',
        ]);

        Beneficiary::create($request->all());

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary created successfully.');
    }

    /**
     * Display the specified beneficiary.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $beneficiary = Beneficiary::findOrFail($id);
    
            return response()->json([
                'name' => $beneficiary->name,
                'contact_info' => $beneficiary->contact_info,
                'address' => $beneficiary->address,
                'type' => $beneficiary->type,
                'status' => $beneficiary->status,
                'managed_by' => $beneficiary->managedBy->name ?? 'N/A', 
                'needs' => $beneficiary->needs,
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Beneficiary not found'], 404);
        }
    }

    /**
     * Show the form for editing the specified beneficiary.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $admins = User::where('user_type', 'admin')->get();
        return view('beneficiaries.edit', compact('beneficiary', 'admins'));
    }

    /**
     * Update the specified beneficiary in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validation rules
        $request->validate([
            'name' => 'required|string|max:50|regex:/^[a-zA-Z\s]+$/|unique:beneficiaries,name,' . $id,
            'contact_info' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'description' => 'nullable|string|max:500',
            'type' => 'required|in:Individual,Organization,School,Hospital,Shelter,Community Center,Family',
            'managed_by' => 'required|exists:users,id',
            'status' => 'required|in:Active,Inactive',
            'needs' => 'nullable|string|min:10|max:500',
        ]);

        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->update($request->all());

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary updated successfully.');
    }

    /**
     * Remove the specified beneficiary from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beneficiary = Beneficiary::findOrFail($id);
        $beneficiary->delete();

        return redirect()->route('beneficiaries.index')->with('success', 'Beneficiary deleted successfully.');
    }
}
