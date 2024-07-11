<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash; // Import Hash facade for password hashing

class UserController extends Controller
{
    public function index()
    {
        $users = User::all(); // Fetch all users
        return view('user.user_overview', compact('users')); // Pass users to the view
    }

    public function create()
    {
        return view('user.user_configuration_create');
    }
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'country' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'job_description' => 'nullable|string|max:255',
        ]);
        // Create a new user instance
        $user = new User;
        // Set the user attributes
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->create = $request->create ?? false;
        $user->edit = $request->edit ?? false;
        $user->delete = $request->delete ?? false;
        $user->country = $request->country;
        $user->city = $request->city;
        $user->address = $request->address;
        $user->job_description = $request->job_description;
        // Save the user to the database
        $user->save();
        // Optionally, you can redirect or return a response
        return redirect()->route('user.create')->with('success', 'User created successfully.');
        // return to_route('user.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function edit($id)
{
    $user = User::findOrFail($id);
    return view('user.user_edit', compact('user'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8',
        'address' => 'nullable|string|max:255',
        'job_description' => 'nullable|string|max:255',
    ]);

    $user = User::findOrFail($id);
    $user->name = $request->name;
    $user->email = $request->email;
    if ($request->password) {
        $user->password = Hash::make($request->password);
    }
    $user->country = $request->country;
    $user->city = $request->city;
    $user->address = $request->address;
    $user->job_description = $request->job_description;
    $user->create = $request->create ?? false;
    $user->edit = $request->edit ?? false;
    $user->delete = $request->delete ?? false;
    $user->save();

    return redirect()->route('user.index')->with('success', 'User updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('user.index')->with('success', 'User deleted successfully.');
}

public function bulkAction(Request $request)
{
    $request->validate([
        'user_ids' => 'required|array',
        'user_ids.*' => 'exists:users,id',
        'action' => 'required|string|in:edit,delete',
    ]);

    $userIds = $request->input('user_ids');
    $action = $request->input('action');

    if ($action === 'delete') {
        User::whereIn('id', $userIds)->delete();
        return redirect()->route('user.index')->with('success', 'Users deleted successfully.');
    } elseif ($action === 'edit') {
        if (!empty($userIds)) {
            return redirect()->route('user.edit', $userIds[0]);
        }
    }
    return redirect()->route('user.index')->with('success', 'Action completed successfully.');
}

}
