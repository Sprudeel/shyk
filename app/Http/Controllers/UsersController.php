<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UsersController extends Controller
{

    public function datatable()
    {
        $users = QueryBuilder::for(User::class)
        ->defaultSort('name')
        ->withAggregate('role', 'name')
        ->allowedSorts(['id', 'name', 'email', 'role_name', 'created_at'])
        ->allowedFilters(['name', 'email'])
        ->paginate(8)
        ->withQueryString();

        return Inertia::render('Admin/Manage/ManageUsers', ['users' => $users])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: false, sortable: true);
            $table->column('name', 'Username', searchable: true, sortable: true);
            $table->column('email', 'Email Addresse', searchable: true, sortable: true);
            $table->column('role_name', 'Rolle', searchable: false, sortable: true);
            $table->column('created_at', 'Beitritt', searchable: false, sortable: true);
            $table->column(label: 'Actions');
        });
    }

    public function adminEdit($id) {
        return Inertia::render('Admin/Manage/ManageUser', ['user' => User::find($id), 'roles' => Role::all()]);
    }
}
