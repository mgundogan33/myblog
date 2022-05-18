<?php

namespace App\Http\Controllers\AdminControllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminUsersController extends Controller
{
    private $rules = [
        'name' => 'required|min:3',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|max:20',
        'role_id' => 'required|numeric'
    ];

    public function index()
    {
        //
    }
    public function create()
    {
        return view('admin_dashboard.users.create', [
            'roles' => Role::pluck('name', 'id'),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate($this->rules);
        $validated['password'] = Hash::make($request->input('password'));
        $user = User::create($validated);

        if ($request->has('image')) {
            $image = $request->file('image');
            $filename = $thumbnail->getClientOriginalName();
            $file_extension = $thumbnail->getClientOriginalExtension();
            $path = $thumbnail->store('images', 'public');

            $user->image()->create([
                'name' => $filename,
                'extension' => $file_extension,
                'path' => $path
            ]);
        }
        return redirect()->route('admin.users.create')->with('success', 'User has ben created');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
