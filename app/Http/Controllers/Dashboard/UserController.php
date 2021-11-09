<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->latest()->paginate(15);
        return view('dashboard.users.index', [
            "users" => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('dashboard.users.create', [
            "roles" => $roles
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            "full_name" => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'role' => "required"
        ]);

        $role = Role::findOrFail($request->input("role"));

        $user = new User;
        $user->full_name = $request->input("full_name");
        $user->email = $request->input("email");
        $user->password = Hash::make($request->input("password"));
        $user->role_id = $role->role_id;
        $user->save();

        return redirect('/dashboard/users')->with('success', "Përdoruesi u krijua me sukses");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $roles = Role::all();
        $user = User::findOrFail($id);
        return view('dashboard.users.edit',[
            "roles" => $roles,
            "user" => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $this->validate($request,[
            "full_name" => ['required', 'string', 'max:255'],
            'email' => ['required', 'email',
                'max:255', Rule::unique('users')->ignore($user->user_id,'user_id')],
//            'password' => ['required', 'string', 'min:8'],
            'role' => "required"
        ]);

        $role = Role::findOrFail($request->input("role"));

        $user->full_name = $request->input("full_name");
        $user->email = $request->input("email");
        if($request->input("password"))
            $user->password = Hash::make($request->input("password"));
        $user->role_id = $role->role_id;
        $user->save();

        return redirect('/dashboard/users')->with('success', "Ndryshimet u ruajtën me sukses.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect('/dashboard/users')->with('success', "Përdoruesi u fshi me sukses");
    }
}
