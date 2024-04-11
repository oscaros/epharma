<?php

namespace App\Http\Controllers;

use App\DataTables\EntitiesDataTable;
use App\Models\Entity;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;

class EntityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AuditTrait;
    public function index()
    {
        try {
            //code...
            return view('entities.index');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'An error occurred while trying to view entities');
            // return redirect()->back()->with('error', $th->getMessage());
        
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        try {
            //code...
            return view('entities.create');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'An error occurred while trying to create a new entity');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            //code...
            $request->validate([
                'name' => 'required',
                
            ]);

           

            $data = [
                'name' => $request->name,
               
            ];

           

            $entity = Entity::create($data);

            $this->createAudit($request,  'Created New Entity named '. $entity->name, 'Create');

            return redirect()->route('entities.index')->with('success', 'Entity created successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //

        try {
            //code...
            $entity = Entity::find($id);
            return view('entities.show', compact('entity'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'An error occurred while trying to view entities');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        try {
            //code...
            $entity = Entity::find($id);
            return view('entities.edit', compact('entity'));
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'An error occurred while trying to edit entity');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        try {
            //code...
            $request->validate([
                'name' => 'required',
               
            ]);
            $entity = Entity::find($id);
           

            $data = [
                'name' => $request->name,
               
            ];

           

            $entity->update($data);
            $this->createAudit($request,  "Updated Entity with ID: {$entity->id}", 'Update', $entity->id, null);
            return redirect()->route('entities.index')->with('success', 'Entity updated successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //
        try {
            //code...
            $entity = Entity::find($id);
            $this->createAudit($request,  "Deleted Entity with ID: {$entity->id}", 'Delete', $entity->id, null);
            $entity->delete();
            return redirect()->route('entities.index')->with('success', 'Entity deleted successfully.');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->with('error', 'An error occurred while trying to delete entity');
        }
    }
}
