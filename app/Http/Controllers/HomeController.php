<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userCount       = User::count();
        $roleCount       = Role::count();
        $permissionCount = Permission::count();

        return view('index', [
            'userCount'         => $userCount,
            'roleCount'         => $roleCount,
            'permissionCount'   => $permissionCount
        ]);
    }
}
