<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminUser;
use App\Http\Requests\AdminUsersStoreRequest;
use App\Http\Requests\AdminUsersUpdateRequest;
use Illuminate\Http\Request;

class AdminUsersController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('viewAny', AdminUser::class);
        $users = AdminUser::query();
        $users->fuzzySearchable('name', $request->name);
        $users->fuzzySearchable('email', $request->email);
        if ($request->user_authority == 'owner') {
            $users->whereIsOwner(true);
        } elseif ($request->user_authority == 'general') {
            $users->whereIsOwner(false);
        }
        $search_results = $users
            ->orderby(
                $request->input('sort_column', 'id'),
                $request->input('sort_direction', 'ASC')
            )->paginate(
                $request->input('page_unit', 10)
            )->appends($request->query());
        return view('admin.admin_users.index', compact('search_results'));
    }

    public function create()
    {
        $this->authorize('create', AdminUser::class);
        return view('admin.admin_users.create');
    }

    public function store(AdminUsersStoreRequest $request)
    {
        $this->authorize('create', AdminUser::class);
        $user = AdminUser::create($request->validated());
        return redirect()->route('admin.admin_users.show', ['admin_user' => $user->id]);
    }

    public function show(AdminUser $adminUser)
    {
        $this->authorize('view', $adminUser);
        return view('admin.admin_users.show', compact('adminUser'));
    }

    public function edit(AdminUser $adminUser)
    {
        $this->authorize('update', $adminUser);
        return view('admin.admin_users.edit', compact('adminUser'));
    }

    public function update(AdminUsersUpdateRequest $request, AdminUser $adminUser)
    {
        $this->authorize('update', $adminUser);
        $adminUser->update($request->validated());
        return redirect()->route('admin.admin_users.show', ['admin_user' => $adminUser->id]);
    }

    public function destroy(AdminUser $adminUser)
    {
        $this->authorize('delete', $adminUser);
        $adminUser->delete();
        return redirect()->route('admin.admin_users.index');
    }
}
