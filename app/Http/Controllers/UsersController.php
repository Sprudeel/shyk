<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Report;
use Illuminate\Support\Collection;
use Inertia\Inertia;
use ProtoneMedia\LaravelQueryBuilderInertiaJs\InertiaTable;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UsersController extends Controller
{
    protected $attributes = ['name' => ""];


    public function index(Request $request) {
        return Inertia::render('User/UserProfile', ['User' => User::where('username', $request->username)->with('role')->firstOrFail()]);
    }

    public function edit(Request $request) {
        $this->authorize('update', [User::class, User::where('username', $request->username)->firstOrFail()]);

        $user = User::where('username', $request->username)->with('role')->firstOrFail();
        $user = $user->makeVisible(['email']);

        return Inertia::render('User/EditUserProfile', ['User' => $user]);
    }

    public function report(Request $request) {
        $this->authorize('report', User::class);

        $request->validate([
            'reported_user' => 'required',
            'reported_user_name' => 'required',
            'reason' => 'required|max:255',
        ]);

        $reporting_user = Auth::user()->id;


        $report = Report::create([
            'report_on' => 'userprofile',
            'reporting_user' => $reporting_user,
            'reported_id' => $request->reported_user,
            'reason' => $request->reason,
        ]);

        return back()->with('success', 'Nutzer wurde erfolgreich gemeldet!');
    }

    public function update(Request $request) {
        $this->authorize('update', [User::class, User::where('email', $request->email)->firstOrFail()]);

        $request->validate([
            'id' => 'required',
            'username' => 'required|string|max:255|min:3',
            'name' => 'required|string|max:255|min:7',
            'about' => 'required|max:500',
            'avatar' => 'max:2048',
        ]);

        if($request->hasFile('avatar') && $request->validate(['avatar' => 'mimes:png,jpg,jpeg'])) {
            $filename = "avatar_".$request->id.".".$request->avatar->extension();
            $request->avatar->move(public_path('avatars'),$filename);
        }

        $user = User::find($request->id);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->about = $request->about;
        $user->avatar = isset($filename) ? $filename : $request->avatar;

        $user->save();

        return redirect(route('userprofile.view', ['username' => $request->username]))->with('success', 'Profil erfolgreicht bearbeitet!');
    }

    public function datatable() {
        $this->authorize('viewAny', User::class);

        $users = QueryBuilder::for(User::class)
        ->defaultSort('username')
        ->withAggregate('role', 'name')
        ->allowedSorts(['id', 'username', 'name', 'email', 'role_name', 'created_at'])
        ->allowedFilters(['username', 'name', 'email'])
        ->paginate(8)
        ->withQueryString();

        $users = $users->makeVisible(['email']);

        return Inertia::render('Admin/Manage/ManageUsers', ['users' => $users])->table(function (InertiaTable $table) {
            $table->column('id', 'ID', searchable: false, sortable: true);
            $table->column('username', 'Username', searchable: true, sortable: true);
            $table->column('name', 'Name', searchable: true, sortable: true);
            $table->column('email', 'Email Addresse', searchable: true, sortable: true);
            $table->column('role_name', 'Rolle', searchable: false, sortable: true);
            $table->column('created_at', 'Beitritt', searchable: false, sortable: true);
            $table->column(label: 'Actions');
        });
    }

    public function adminEdit($id) {
        $this->authorize('updateRole', User::class);

        return Inertia::render('Admin/Manage/ManageUser', ['user' => User::find($id), 'roles' => Role::all()]);
    }

    public function updateRole(Request $request) {
        $this->authorize('updateRole', User::class);

        $request->validate([
            'id' => 'required',
            'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'role_id' => 'required',
        ]);

        $user = User::find($request->id);

        $user->name = $request->username;
        $user->email = $request->email;
        $user->role_id = $request->role_id;

        $user->save();

        return redirect(route('admin.role.users'))->with('success', 'Nutzrolle erfolgreich bearbeitet!');
    }
}
