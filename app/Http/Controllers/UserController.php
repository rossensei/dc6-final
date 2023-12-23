<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $userQuery = User::orderBy('name', 'asc');

        if($search) {
            $userQuery->where('name', 'LIKE', "%{$search}%")
                ->orWhere('email', 'LIKE', "%{$search}%");
        }

        $users = $userQuery->paginate(10)
            ->withQueryString()
            ->through(fn($user) => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->getUserRole(),
                'created_at' => $user->created_at
            ]);

        return inertia('User/Index', [
            'users' => $users,
            'filters' => $request->only(['search'])
        ]);
    }

    public function create()
    {
        return inertia('User/Create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $attr = $request->validate([
            'name' => 'string|required',
            'email' => 'required|unique:users',
            'password' => 'confirmed|required|min:6',
            'role' => 'required'
        ]);

        $role = $attr['role'];
        unset($attr['role']);

        $user = User::create($attr);

        $user->assignRole($role);

        return redirect('/admin/users')->with('success', 'User successfully created!');
    }

    public function edit(User $user)
    {
        $user->load('roles'); // Eager load the roles relationship

        return inertia('User/Edit', [
            'user' => $user
        ]);
    }

    public function update(User $user, Request $request)
    {
        $attr = $request->validate([
            'name' => 'string|required',
            'email' => 'required|'.Rule::unique(User::class)->ignore($user->id),
            'role' => 'required'
        ]);

        if($request->password){
            $request->validate([
            'password' => 'confirmed|required|min:6',
            ]);

            $attr['password'] = $request->password;
        }

        $role = $attr['role'];
        unset($attr['role']);

        // dd($attr);
        $user->syncRoles([]);

        $user->update($attr);

        $user->assignRole($role);

        return redirect('/admin/users')->with('success', 'User details has been updated!');
    }

    public function destroy(User $user) 
    {

        if($user->tasks()->exists()) {
            return back()->with('error', 'This user has existing tasks!');
        }

        $user->delete();

        return back()->with('success', 'User successfully deleted!');
    }
}
