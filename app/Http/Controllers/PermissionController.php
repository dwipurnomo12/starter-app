<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list permission', ['only' => ['index']]);
        $this->middleware('permission:create permission', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit permission', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete permission', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('permission.index');
    }

    /**
     * Display data Permission.
     */
    public function getPermissions()
    {
        $permissions = Permission::all()->groupBy('category');
        $formattedPermissions = [];

        foreach ($permissions as $category => $permissionGroup) {
            $permissionList = '<ul>';
            foreach ($permissionGroup as $permission) {
                $editButton = '';
                $deleteButton = '';

                // Cek izin edit
                if (auth()->user()->can('edit permission')) {
                    $editButton = '<a href="/permission/' . $permission->id . '/edit" class="btn btn-warning btn-sm ml-2">
                    <i class="bi bi-pencil-square"></i> 
                </a>';
                }

                // Cek izin delete
                if (auth()->user()->can('delete permission')) {
                    $deleteButton = '<form id="delete-form-' . $permission->id . '" action="/permission/' . $permission->id . '" method="POST" class="d-inline">
                    ' . method_field('DELETE') . csrf_field() . '
                    <button type="submit" class="btn btn-danger btn-sm swal-confirm" data-form="delete-form-' . $permission->id . '">
                        <i class="bi bi-trash"></i> 
                    </button>
                </form>';
                }

                $permissionList .= '<li class="mb-3">' . $permission->name . $editButton . $deleteButton . '</li>';
            }
            $permissionList .= '</ul>';

            $formattedPermissions[] = [
                'category'      => $category,
                'permission'    => $permissionList,
                'opsi'          => ''
            ];
        }

        return DataTables::of($formattedPermissions)
            ->addIndexColumn()
            ->addColumn('opsi', function ($permission) {
                return $permission['opsi'];
            })
            ->rawColumns(['permission', 'opsi'])
            ->make(true);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Permission::select('category')->distinct()->pluck('category');
        return view('permission.create', [
            'categories'    => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255|unique:permissions',
            'category'      => 'nullable|string|max:255',
            'new_category'  => 'nullable|string|max:255',
        ], [
            'name.required'         => 'Form wajib diisi!',
            'name.string'           => 'Data yang dimasukkan tidak benar!',
            'name.max'              => 'Data yang dimasukan terlalu banyak!',
            'name.unique'           => 'Data yang dimasukan sudah ada!',
            'category.string'       => 'Data yang dimasukkan tidak benar!',
            'category.unique'       => 'Data yang dimasukan sudah ada!',
            'new_category.string'   => 'Data yang dimasukkan tidak benar!',
            'category.max'          => 'Data yang dimasukan terlalu banyak!',
            'new_category.max'      => 'Data yang dimasukan terlalu banyak!',
            'new_category.unique'   => 'DData yang dimasukan sudah ada!!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $category = $request->new_category ?: $request->category;

        if (!$category) {
            return back()->withErrors(['category' => 'Silakan pilih atau tambahkan kategori baru.'])->withInput();
        }

        Permission::create([
            'name'          => $request->name,
            'category'      => $category,
            'guard_name'    => 'web'
        ]);

        return redirect('/permission')->with('success', 'Permission berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $permission = Permission::find($id);
        $categories = Permission::distinct()->pluck('category');

        return view('permission.edit', [
            'permission'    => $permission,
            'categories'    => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $permission = Permission::find($id);
        $validator = Validator::make($request->all(), [
            'name'          => 'required|string|max:255|unique:permissions',
            'category'      => 'nullable|string|max:255|unique:permissions',
            'new_category'  => 'nullable|string|max:255|unique:permissions',
        ], [
            'name.required'         => 'Form wajib diisi!',
            'name.string'           => 'Data yang dimasukkan tidak benar!',
            'name.max'              => 'Data yang dimasukan terlalu banyak!',
            'category.string'       => 'Data yang dimasukkan tidak benar!',
            'new_category.string'   => 'Data yang dimasukkan tidak benar!',
            'category.max'          => 'Data yang dimasukan terlalu banyak!',
            'new_category.max'      => 'Data yang dimasukan terlalu banyak!',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $category = $request->new_category ?: $request->category;

        if (!$category) {
            return back()->withErrors(['category' => 'Silakan pilih atau tambahkan kategori baru.'])->withInput();
        }

        $permission->update([
            'name'          => $request->name,
            'category'      => $category,
            'guard_name'    => 'web'
        ]);

        return redirect('/permission')->with('success', 'Permission berhasil ditambahkan!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $permission = Permission::find($id);
        $permission->delete();

        return redirect()->back()->with('success', 'Permission berhasil dihapus');
    }
}
