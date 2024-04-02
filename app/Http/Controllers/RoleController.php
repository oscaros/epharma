<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use App\Traits\AccessTrait;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;


class RoleController extends Controller
{
    use  AccessTrait;


    use AuditTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return view('roles.index');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to view roles');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $roles = $this->getAccessControl();
        $permissions = array();
        return view('roles.create', compact('roles', 'permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions_menu' => 'required',
        ]);

        try {

            // DB::beginTransaction();
            $role = Role::create([
                'name' => $request->name,
                'description' => $request->description,
                'permissions' => json_encode($request->permissions_menu),
                'user_id' => auth()->user()->id,
                'entity_id' => auth()->user()->entity->id,
                
            ]);
            $this->createAudit($request, 'Created Role', 'Create', $role->getTable(), $role->id);
            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        } catch (\Throwable $th) {
            // DB::rollBack();
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {

        // Retrieve permissions associated with the role
        $staff_permissions =  json_decode($role->permissions);
        if ($staff_permissions == NULL) {
            $staff_permissions = array();
        }
        $roles = $this->getAccessControl();

        return view('roles.show', compact('roles', 'staff_permissions', 'role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $permissions =  json_decode($role->permissions);
        if ($permissions == NULL) {
            $permissions = array();
        }
        $roles = $this->getAccessControl();
        return view('roles.edit', compact('roles', 'permissions', 'role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'persmissions_menu' => 'required',
        ]);

        try {
            $role->update([
                'name' => $request->name,
                'description' => $request->description,
                'permissions' => json_encode($request->persmissions_menu),
                'user_id' => auth()->user()->id,
                'business_id' => auth()->user()->business->id,
                'branch_id' => auth()->user()->branch->id
            ]);

            $this->createAudit($request, 'Updated Role', 'Update', $role->getTable(), $role->id);
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to update the role');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        try {
            // detach all permissions
            $request = request();
            $role->delete();
            $this->createAudit($request, 'Deleted Role', 'Delete', $role->getTable(), $role->id);
            return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to delete the role');
        }
    }
}
