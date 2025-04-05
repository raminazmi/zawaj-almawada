<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        if (auth()->user()->isSubAdmin()) {
            $admins = User::where('is_admin', false)->paginate(10);
        } else {
            $admins = User::paginate(10);
        }

        return view('admin.admins.index', compact('admins'));
    }

    public function create()
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.admins.create');
    }

    public function store(Request $request)
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'admin_role' => [Rule::requiredIf($request->is_admin), 'nullable', 'in:main,sub'],
        ]);

        do {
            $membershipNumber = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (User::where('membership_number', $membershipNumber)->exists());

        $validated['is_admin'] = 1;
        $validated['password'] = Hash::make($validated['password']);
        $validated['membership_number'] = $membershipNumber;

        User::create($validated);

        return redirect()->route('admin.admins.index')
            ->with('success', 'تم إنشاء المستخدم بنجاح');
    }

    public function show(User $user)
    {
        if (auth()->user()->isSubAdmin() && $user->is_admin) {
            abort(403, 'Unauthorized access.');
        }

        return view('admin.admins.show', compact('user'));
    }

    public function edit(User $user)
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        return view('admin.admins.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8|confirmed',
            'is_admin' => 'boolean',
            'admin_role' => [Rule::requiredIf($request->is_admin), 'nullable', 'in:main,sub'],
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route('admin.admins.index')
            ->with('success', 'تم تحديث المستخدم بنجاح');
    }

    public function destroy(User $user)
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        if ($user->id === 1) {
            return redirect()->back()
                ->with('error', 'لا يمكن حذف الأدمن الرئيسي الأساسي');
        }

        $user->delete();

        return redirect()->route('admin.admins.index')
            ->with('success', 'تم حذف المستخدم بنجاح');
    }

    public function toggleStatus(User $user)
    {
        if (!auth()->user()->isMainAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $user->update(['is_active' => !$user->is_active]);

        return redirect()->back()
            ->with('success', 'تم تحديث حالة المستخدم');
    }
}
