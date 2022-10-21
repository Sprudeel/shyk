<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\RolePermission;
use App\Models\Permission;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Http\RedirectResponse;


class RoleController extends Controller
{

    public function datatable()
    {
        $roles = QueryBuilder::for(Role::class)
        ->defaultSort('id')
        ->with(['permission'=> function ($query) {
            $query->get(['name']);
        }])
        ->allowedSorts(['id', 'name'])
        ->allowedFilters(['name'])
        ->paginate(8)
        ->withQueryString();

        return Inertia::render('Admin/Manage/ManageRoles', ['roles' => $roles])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: false, sortable: true);
            $table->column('name', 'Name', searchable: true, sortable: true);
            $table->column('permission', 'Berechtigungen', searchable: false, sortable: false);
            $table->column(label: 'Actions');
        });
    }

    public function create() {
        return Inertia::render('Admin/Manage/CreateRole');
    }

    public function store(Request $request) {

        $request->validate([
                'name' => 'required',
        ]);

        Role::create([
            'name' => $request->name
        ]);

        return redirect("admin/roles-permissions/roles");
    }

    public function destroy(Request $request) {
        $role = Role::find($request->id);

        $role->delete();

        return redirect(route('admin.role.roles'));
    }

    public function edit($id) {
        return Inertia::render('Admin/Manage/ManageRole', [
            'role' => Role::find($id),
            'role_permissions' => Role::find($id)->permission,
            'permissions' => Permission::all(),
        ]);
    }

    public function update(Request $request) {
        RolePermission::where('role_id', $request->role_id)->delete();

        foreach ($request->permissions as $permission) {
            if($permission['haspermission'] == true) {
                RolePermission::create([
                    'role_id' => $request->role_id,
                    'permission_id' => $permission['permission_id'],
                ]);
            }
        }

        return redirect(route('admin.role.roles'));
    }

}
