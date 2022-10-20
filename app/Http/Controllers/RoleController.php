<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

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
}
