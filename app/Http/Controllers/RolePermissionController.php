<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use Inertia\Inertia;
use App\Models\Permission;

class RolePermissionController extends Controller
{
    public function index() {

        // Get all Permissions
        $permissions = Permission::all();
        // Return Inertia View

        return Inertia::render('Admin/RolesPermissions', [
            'permissions' => $permissions,
        ]);
    }

}
