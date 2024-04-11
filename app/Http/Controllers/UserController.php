<?php

namespace App\Http\Controllers;

use App\Models\Entity;
use App\Models\User;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\DataTables\UsersDataTable;
use App\Mail\AccountCreation;
use App\Models\Business;
use App\Models\Branch;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{

    use AuditTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index() {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $roles = Role::all();
            $entities = Entity::all();
            // $branches = Branch::all();
            return view('users.create', compact('roles', 'entities'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to create a new user');
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

            // Validate the request data
            $request->validate([
                'first_name' => 'required',
                'last_name' => 'required',
                'email' => 'required|email|unique:users,email',
                'phone_number' => 'required',
                'role_id' => 'required',
          

            ]);

            $password = Str::random(8);
            $role =  Role::find($request->role_id)->name;
            $name = $request->first_name . ' ' . $request->last_name;

            // dd($name);
            $data = [
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone_number' => $request->phone_number,
                'password' => Hash::make($password),
                'role_id' => $request->role_id,
             
                'entity_id' => auth()->user()->entity_id,
            ];

            // dd($data);
            try {
                //code...
                Mail::to($request->email)->send(new AccountCreation($name, $password,  $role));
            } catch (\Throwable $th) {
                //throw $th;
                dd($th);
            }

            // dd(User::create($data));
            User::create($data);

            

            // Redirect to the index page with success message
            $this->createAudit($request,  'Created New User ', 'User Creation');
            return redirect()->route('users.index')->with('success', 'User created successfully');
        } catch (\Throwable $th) {

            return redirect()->back()->with('error', $th->getMessage());
         

        }
    }

    // Implement other methods like show, edit, update, and destroy
    // ...
    public function show($id)
    {
        try {
            // Return the view for showing a user
            $user = User::find($id);
            return view('users.show', compact('user'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to view user');
        }
    }
    public function edit($id)
    {
        try {

            //pass role
            $roles = Role::all();
       
            $entities = Entity::all();
            $user = User::find($id);
            return view('users.edit', compact('user', 'roles', 'entities'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to edit user');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validate the request data
            $validatedData = $request->validate([
                'name' => 'required',
 
                'phone_number' => 'required',
                'role_id' => 'required',
       

         
    
            ]);

         
            $user = User::find($id);
            $user->name = $request->name;
       
         
            $user->phone_number = $request->phone_number;


            $data = [
                'name' => $request->name,
          
         
                'phone_number' => $request->phone_number,
                // 'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
          
            ];

            // $user->fill($data);

            //save user

            $user->update($data);
            // $user->assignRole($request->role_id);
            // $user->assignEntity($request->entity_id);
          

            // Set other attributes like role_id, branch_id, business_id if needed
            // $user->save();

            $this->createAudit($request,  'Updated User '. $user->name, 'Update');

            // Redirect to the index page with success message
            return redirect()->route('users.index')->with('success', 'User updated successfully');
        } catch (\Throwable $th) {
            // return redirect()->back()->with('error', 'An error occurred while trying to update user');
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
