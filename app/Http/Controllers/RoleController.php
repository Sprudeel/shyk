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
use App\Policies\Rolepolicy;


class RoleController extends Controller
{
    /**
     * Return a Datatable
     */
    public function datatable() {
        $this->authorize('viewAny', Role::class);

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
            // $table->column('permission', 'Berechtigungen', searchable: false, sortable: false);
            $table->column(label: 'Actions');
        });
    }

    /**
     * Redirect to create a new Role
     */
    public function create() {
        $this->authorize('create', Role::class);

        return Inertia::render('Admin/Manage/CreateRole');
    }

    /**
     * Create a new Role
     */
    public function store(Request $request) {
        $this->authorize('create', Role::class);

        $request->validate([
                'name' => 'required',
                'color' => 'required',
        ]);

        Role::create([
            'name' => $request->name,
            'color' => $request->color,
        ]);

        return redirect("admin/roles-permissions/roles")->with('success', 'Rolle erfolgreicht erstellt!');
    }

    /**
     * Destroy a Role
     */
    public function destroy(Request $request) {
        $this->authorize('delete', Role::class);

        $role = Role::find($request->id);

        $role->delete();

        return redirect(route('admin.role.roles'))->with('success', 'Rolle erfolgreicht gelöscht!');
    }

    /**
     * Redirect to Edit Rolepermissions
     */
    public function edit($id) {
        $this->authorize('update', Role::class);

        return Inertia::render('Admin/Manage/ManageRole', [
            'role' => Role::find($id),
            'role_permissions' => Role::find($id)->permission,
            'permissions' => Permission::all(),
        ]);
    }

    /**
     * Update Role
     */
    public function update(Request $request) {
        $this->authorize('update', Role::class);

        RolePermission::where('role_id', $request->role_id)->delete();

        foreach ($request->permissions as $permission) {
            if($permission['haspermission'] == true) {
                RolePermission::create([
                    'role_id' => $request->role_id,
                    'permission_id' => $permission['permission_id'],
                ]);
            }
        }

        return redirect(route('admin.role.roles'))->with('success', 'Rolle erfolgreicht bearbeitet!');
    }

}
