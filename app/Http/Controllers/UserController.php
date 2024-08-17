<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Mail\AccountCreation;
use App\Models\Branch;
use App\Models\Business;
use App\Models\Department;
use App\Models\Entity;
use App\Models\Role;
use App\Models\User;
use App\Traits\AuditTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use AuditTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('entity_id', auth()->user()->entity_id)->get();
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
            if (auth()->user()->role_id == 1) {
                $entities = Entity::all();
                $departments = Department::where('is_deleted', 0)->get();  // Only retrieve departments where is_deleted is 0
                $roles = Role::all();
            } else {
                // if(auth()->user()->role_id == 2){
                $roles = Role::where('entity_id', auth()->user()->entity_id)->get();
                $entities = Entity::where('id', auth()->user()->entity_id)->get();
                $departments = Department::where('entity_id', auth()->user()->entity_id)
                    ->where('is_deleted', 0)
                    ->get();
            }

            return view('users.create', compact('roles', 'entities', 'departments'));
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
            $isAdmin = $request->has('is_admin') ? 1 : 0;

            if (auth()->user()->role_id == 1) {
                // Validate the request data
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    'phone_number' => 'required|unique:users,phone_number',
                    'role_id' => 'required',
                    'entity_id' => 'required',
                    // Existing validation rules...
                    'is_admin' => 'sometimes|boolean',
                ]);
            } else {
                // Validate the request data
                $request->validate([
                    'first_name' => 'required',
                    'last_name' => 'required',
                    'email' => 'required|email|unique:users,email',
                    // ensure phone is unique
                    // 'phone_number' => 'required',
                    'phone_number' => 'required|unique:users,phone_number',
                    'role_id' => 'required',
                    // 'entity_id' => 'required',
                    // Existing validation rules...
                    'is_admin' => 'sometimes|boolean',
                ]);
            }

            $password = Str::random(8);
            $role = Role::find($request->role_id)->name;
            $name = $request->first_name . ' ' . $request->last_name;

            if (auth()->user()->role_id == 1) {
                $data = [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($password),
                    'role_id' => $request->role_id,
                    'department_id' => $request->department_id,
                    'entity_id' => $request->entity_id,
                    'is_admin' => $isAdmin
                ];
            } else {
                $data = [
                    'name' => $request->first_name . ' ' . $request->last_name,
                    'email' => $request->email,
                    'phone_number' => $request->phone_number,
                    'password' => Hash::make($password),
                    'role_id' => $request->role_id,
                    'department_id' => $request->department_id,
                    'entity_id' => auth()->user()->entity_id,
                    'is_admin' => $isAdmin
                ];
            }

            try {
                // code...
                Mail::to($request->email)->send(new AccountCreation($name, $password, $role));
            } catch (\Throwable $th) {
                // throw $th;
                dd($th);
            }

            User::create($data);

            // Redirect to the index page with success message
            $this->createAudit($request, 'Created New User ', 'User Creation');
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
            // $roles = Role::all();
            // // $entities = Entity::all();
            // $departments = Department::all();
            // if role == 1 return entities in compact else dont
            // dd($roles);
            // dd($departments);
            // dd($branches);
            if (auth()->user()->role_id == 1) {
                $entities = Entity::all();
                $departments = Department::where('is_deleted', 0)->get();  // Only retrieve departments where is_deleted is 0
                $roles = Role::all();
            } else {
                // if(auth()->user()->role_id == 2){
                $entities = Entity::where('id', auth()->user()->entity_id)->get();
                $departments = Department::where('entity_id', auth()->user()->entity_id)
                    ->where('is_deleted', 0)
                    ->get();
                $roles = Role::where('entity_id', auth()->user()->entity_id)->get();
            }

            // pass role
            // $roles = Role::all();

            // $entities = Entity::all();
            // $departments = Department::all();
            $user = User::find($id);
            return view('users.edit', compact('user', 'roles', 'entities', 'departments'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'An error occurred while trying to edit user');
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $user = User::find($id);
            $user->name = $request->name;

            $user->phone_number = $request->phone_number;

            $data = [
                'name' => $request->name,
                'phone_number' => $request->phone_number,
                // 'password' => Hash::make($request->password),
                'role_id' => $request->role_id,
                'department_id' => $request->department_id,
            ];

            // $user->fill($data);

            // save user

            $user->update($data);
            // $user->assignRole($request->role_id);
            // $user->assignEntity($request->entity_id);

            // Set other attributes like role_id, branch_id, business_id if needed
            // $user->save();

            $this->createAudit($request, 'Updated User ' . $user->name, 'Update');

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
