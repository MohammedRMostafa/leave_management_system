<?php

namespace App\Http\Controllers;

use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            $requests = LeaveRequest::where('status', 'unseen')->get();
        } else {
            $requests = Auth::user()->leave_requests;
        }
        return view('leave_requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = LeaveType::all();
        return view('leave_requests.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'leave_type_id' => ['required', 'int', 'exists:leave_types,id'],
            'description' => ['nullable', 'string'],
            'leave_date' => ['required', 'date', 'after:now'],
        ]);
        Auth::user()->leave_requests()->create($request->all());
        session()->flash('Add', 'Added successfully');
        return redirect()->route('requests.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(LeaveRequest $request)
    {
        return view('leave_requests.show', compact('request'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $types = LeaveType::all();
        $leave_request = LeaveRequest::findOrFail($id);
        if ($leave_request->status != 'unseen') {
            return redirect()->back()->with('Info', 'This request has been answered. You cannot edit it');
        }
        return view('leave_requests.edit', compact('leave_request', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $leave_request = LeaveRequest::findOrFail($id);
        if ($leave_request->status != 'unseen') {
            return redirect()->route('requests.index')->with('Info', 'This request has been answered. You cannot edit it');
        }
        $request->validate([
            'leave_type_id' => ['required', 'int', 'exists:leave_types,id'],
            'description' => ['nullable', 'string'],
            'leave_date' => ['required', 'date', 'after:now'],
        ]);

        $leave_request->update($request->all());
        session()->flash('Edit', 'Updated Successfuly');
        return redirect()->route('requests.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $leave_request = LeaveRequest::findOrFail($id);
        $leave_request->delete();
        session()->flash('Delete', 'Deleted successfully');
        return redirect()->route('requests.index');
    }

    public function update_status(Request $request)
    {
        $request->validate([
            'reason' => ['nullable', 'string', 'max:255'],
            'submit' => ['required', 'string', 'in:approve,deny'],
            'id' => ['required', 'int', 'exists:leave_requests,id'],
        ]);
        $leave_request = LeaveRequest::findOrFail($request->input('id'));
        $leave_request->update([
            'status' => $request->input('submit'),
            'reason' => $request->input('reason'),
        ]);
        session()->flash('Info', 'The Operation was Completed Successfully');
        return redirect()->route('requests.index');
    }
}
