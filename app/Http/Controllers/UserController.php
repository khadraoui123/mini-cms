<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRoleRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(): View
    {
        Gate::authorize('manage-users');

        return view('admin.users.index', [
            'users' => User::orderBy('name')->get(),
        ]);
    }

    public function updateRole(UpdateUserRoleRequest $request, User $user): RedirectResponse
    {
        $user->role = $request->validated()['role'];
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Rôle mis à jour.');
    }

    public function destroy(User $user): RedirectResponse
    {
        Gate::authorize('manage-users');

        if ($user->id === auth()->id()) {
            abort(403, 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        $admin = auth()->user();

        DB::transaction(function () use ($user, $admin): void {
            $user->posts()->update(['user_id' => $admin->id]);
            $user->delete();
        });

        return redirect()->route('admin.users.index')
            ->with('success', 'Utilisateur supprimé. Ses articles ont été réassignés.');
    }
}
