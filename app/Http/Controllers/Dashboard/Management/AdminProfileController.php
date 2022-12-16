<?php

namespace App\Http\Controllers\Dashboard\Management;

use App\Http\Controllers\Controller;
use Collective\Html\FormFacade;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class AdminProfileController extends Controller
{
    protected string $prefix = 'dashboard.management.users';

    public function index(): View
    {
        FormFacade::setModel(auth()->user());

        return view("{$this->prefix}.profile");
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|max:255|unique:users,phone,'.auth()->id(),
            'password' => ['nullable', 'confirmed', Password::min(6)->mixedCase()],
            'avatar' => 'sometimes|image|max:2000',
        ]);

        if (isset($validated['password']) && $validated['password'] !== '') {
            $validated['password'] = bcrypt($validated['password']);
        } else {
            unset($validated['password']);
        }
        $avatar = Arr::pull($validated, 'avatar');
        Auth::user()->update($validated);
        if ($avatar instanceof UploadedFile) {
            Auth::user()->clearMediaCollection();
            Auth::user()->addMedia($avatar)->toMediaCollection();
        }
        toast(__('Updated Successfully'), 'success');

        return back();
    }
}
