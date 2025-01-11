<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list role', ['only' => ['index']]);
        $this->middleware('permission:create role', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit role', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete role', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('role.index');
    }

    /**
     * Display data Role.
     */
    public function getRoles()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return DataTables::of($roles)
            ->addIndexColumn()
            ->addColumn('opsi', function ($role) {
                $editButton = '';
                $deleteButton = '';

                if (auth()->user()->can('edit user')) {
                    $editButton = '<a href="/role/' . $role->id . '/edit" class="btn icon btn-warning">
                        <i class="bi bi-pencil-square"></i>
                    </a>';
                }

                if (auth()->user()->can('delete user')) {
                    $deleteButton = '<form id="' . $role->id . '" action="/role/' . $role->id . '" method="POST" class="d-inline">
                        ' . method_field('DELETE') . csrf_field() . '
                        <button type="submit" class="btn icon btn-danger swal-confirm" data-form="' . $role->id . '">
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
        $permissions = Permission::all()->groupBy('category');
        return view('role.create', [
            'permissions'   => $permissions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'permissions'   => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required'         => 'Nama role wajib diisi!',
            'permissions.required'  => 'Role harus memiliki permission!',
            'permissions.*.exists'  => 'Permission yang dipilih tidak valid!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect('/role')->with('success', 'Role dan permissions berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::all()->groupBy('category');
        return view('role.edit', [
            'permissions'   => $permissions,
            'role'          => $role
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $role = Role::find($id);
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255',
            'permissions'   => 'required|array',
            'permissions.*' => 'exists:permissions,id'
        ], [
            'name.required'         => 'Nama role wajib diisi!',
            'permissions.required'  => 'Role harus memiliki permission!',
            'permissions.*.exists'  => 'Permission yang dipilih tidak valid!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $role->update([
            'name' => $request->name,
            'guard_name' => 'web',
        ]);

        $role->permissions()->sync($request->permissions);

        return redirect('/role')->with('success', 'Role dan permissions berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::find($id);
        $role->delete();

        return redirect()->back()->with('success', 'Role berhasil dihapus!');
    }
}
