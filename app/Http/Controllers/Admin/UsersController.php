<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UsersStoreRequest;
use App\Http\Requests\UsersUpdateRequest;
use App\Models\User;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query();
        $users->fuzzySearchable('name', $request->name);
        $users->fuzzySearchable('email', $request->email);
        $search_results = $users
            ->orderby(
                $request->input('sort_column', 'id'),
                $request->input('sort_direction', 'ASC')
            )->paginate(
                $request->input('page_unit', 10)
            )->appends($request->query());
        return view('admin.users.index', compact('search_results'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(UsersStoreRequest $request)
    {
        $user = User::create($request->validated());
        return redirect()->route('admin.users.show', ['user' => $user->id]);
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(UsersUpdateRequest $request, User $user)
    {
        if ($request->delete_icon == 1) {
            $user->icon = null;
        }
        $user->update($request->validated());
        return redirect()->route('admin.users.show', ['user' => $user->id]);
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}
