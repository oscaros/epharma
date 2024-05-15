<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;
use App\Models\Permission;
use App\DataTables\PermissionsDataTable;



class PermissionController extends Controller
{

    use AuditTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PermissionsDataTable $dataTable)
    {
        try {
            $pageTitle = "Manage Permissions";
            // $auth_user = AuthHelper::authSession();
            $assets = ['data-table'];
            $headerAction = '<a href="' . route('permissions.create') . '" class="btn btn-sm btn-primary" role="button">Add New Permission</a>';
            return $dataTable->render('global.datatable', compact('pageTitle',  'assets' ));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to view branches');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   
     public function create(Request $request)
     {
         try {
             //code...
             return view('permissions.create');
         } catch (\Throwable $th) {
             //throw $th;
             return redirect()->back()->with('error', 'An error occurred while trying to create a new permission');
         }
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
        public function store(Request $request)
        {
            try {
                $request->validate([
                    'name' => 'required|string|max:255',
                    'description' => 'required|string',
                ]);

               $data = [
                    'name' => $request->name,
                    'description' => $request->description
               ];

            //    dd($data);


                // dd($request->all());
                // Permission::create($request->only('name', 'description'));
                Permission::create($data);
                $this->createAudit($request,  'Created Permission', 'Create', null, null);
                return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
            } catch (\Throwable $th) {
                return redirect()->back()->with('error', $th->getMessage());
                // dd($th);
            }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $permission = Permission::findOrFail($id);
        return view('permissions.show', compact('permission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       //code here
         $permission = Permission::findOrFail($id);
        return view('permissions.edit', compact('permission'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //code here
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'required|string',
            ]);
            $permission = Permission::findOrFail($id);
            $permission->update($request->only('name', 'description'));
            $this->createAudit($request,  'Updated Permission', 'Update', null, $permission->id);
            return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to update permission');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //code here
        try {
            $request = new Request();
            
            $permission = Permission::findOrFail($id);
            $permission->delete();
            $this->createAudit($request,  'Deleted Permission', 'Delete', null, $permission->id);
            return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to delete permission');
        }
    }
}
