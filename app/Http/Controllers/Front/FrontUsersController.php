<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\FrontUserUpdateRequest;
use App\Models\User;

class FrontUsersController extends Controller
{
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('front.users.edit');
    }

    public function update(FrontUserUpdateRequest $request, User $user)
    {
        if ($request->delete_icon == 1) {
            $user->icon = null;
        }
        $user->update($request->validated());
        return redirect()->route('front.home');
    }
}
