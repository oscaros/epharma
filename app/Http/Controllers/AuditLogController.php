<?php

namespace App\Http\Controllers;
use App\Models\AuditLog;

use Illuminate\Http\Request;
use App\DataTables\AuditLogsDataTable;

class AuditLogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $auditLogs = AuditLog::all(); // Fetch audit logs data from the database
    //     return view('audit_logs.index', compact('auditLogs'));
    // }

    public function index(AuditLogsDataTable $dataTable)
    {
        try {
            $pageTitle = "Manage Logs";
            // $auth_user = AuthHelper::authSession();
            $assets = ['data-table'];
            // $headerAction = '<a href="' . route('audit_logs.create') . '" class="btn btn-sm btn-primary" role="button">Add New Branch</a>';
            return $dataTable->render('global.datatable', compact('pageTitle',  'assets' ));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to view branches');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
