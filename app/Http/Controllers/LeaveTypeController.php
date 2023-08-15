<?php

namespace App\Http\Controllers;

use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = LeaveType::all();
        return view('leave_types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leave_types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        LeaveType::create($request->all());
        session()->flash('Add', 'Added successfully');
        return redirect()->route('types.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveType $leaveType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $type = LeaveType::findOrFail($id);
        return view('leave_types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);
        $type = LeaveType::findOrFail($id);
        $type->update($request->all());
        session()->flash('Edit', 'Modified successfully');
        return redirect()->route('types.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $type = LeaveType::findOrFail($id);
        $type->delete();
        session()->flash('Delete', 'Deleted successfully');
        return redirect()->route('types.index');
    }
}
