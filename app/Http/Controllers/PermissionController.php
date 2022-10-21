<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Permission;

class PermissionController extends Controller
{
    public function index() {

        $this->authorize('view_admin_section', User::class);

        // Get all Permissions
        $permissions = Permission::all();
        // Return Inertia View

        return Inertia::render('Admin/RolesPermissions', [
            'permissions' => $permissions,
        ]);
    }
}
