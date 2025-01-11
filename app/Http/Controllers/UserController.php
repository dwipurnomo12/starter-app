<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list user', ['only' => ['index']]);
        $this->middleware('permission:create user', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit user', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete user', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Display data Users.
     */
    public function getUsers()
    {
        $users = User::with('roles')->orderBy('id', 'DESC')->get();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('role', function ($user) {
                return $user->roles->isNotEmpty() ? $user->roles->first()->name : 'No Role';
            })
            ->addColumn('opsi', function ($user) {
                $editButton = '';
                $deleteButton = '';

                if (auth()->user()->can('edit user')) {
                    $editButton = '<a href="/user/' . $user->id . '/edit" class="btn icon btn-warning">
                    <i class="bi bi-pencil-square"></i>
                </a>';
                }

                if (auth()->user()->can('delete user')) {
                    $deleteButton = '<form id="' . $user->id . '" action="/user/' . $user->id . '" method="POST" class="d-inline">
                    ' . method_field('DELETE') . csrf_field() . '
                    <button type="submit" class="btn icon btn-danger swal-confirm" data-form="' . $user->id . '">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>';
                }

                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['opsi'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Role::all();
        return view('user.create', [
            'roles' => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required|unique:users',
            'password'  => 'required|min:8',
            'role'      => 'required'
        ], [
            'name.required'     => 'Form wajib diisi!',
            'name.string'       => 'Format yang dimasukkan tidak benar!',
            'name.max'          => 'Data yang dimasukkan melebihi batas!',
            'email.required'    => 'Form wajib diisi!',
            'email.unique'      => 'Email sudah digunakan!',
            'password.required' => 'Form wajib diisi!',
            'password.min'      => 'Password minimal 8 karakter!',
            'role.required'     => 'Form wajib diisi!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $user = User::create([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);

        $user->assignRole($request->role);

        return redirect('/user')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user   = User::find($id);
        $roles  = Role::all();
        return view('user.edit', [
            'user'  => $user,
            'roles' => $roles
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $validator = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'email'     => 'required||unique:users,email,' . $id,
            'password'  => 'nullable|min:8',
            'role'      => 'required'
        ], [
            'name.required'     => 'Form wajib diisi!',
            'name.string'       => 'Format yang dimasukkan tidak benar!',
            'name.max'          => 'Data yang dimasukkan melebihi batas!',
            'email.required'    => 'Form wajib diisi!',
            'email.unique'      => 'Email sudah digunakan!',
            'password.min'      => 'Password minimal 8 karakter!',
            'role.required'     => 'Form wajib diisi!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        if ($request->filled('password')) {
            $validated['password'] = Hash::make($request->password);
        }

        $user->update([
            'name'      => $request->name,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
        ]);
        $user->syncRoles([$request->role]);

        return redirect('/user')->with('success', 'User berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->back()->with('success', 'User berhasisl dihapus');
    }
}
