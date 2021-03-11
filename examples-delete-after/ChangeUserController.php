<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Models\RegisterToken;

class ChangeUserController extends Controller
{
    /**
     * Display the change user view.
     *
     * @return \Illuminate\View\View
     */
    public function show()
    {
        return view('pages.auth.user');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UpdateRequest $request)
    {
        $user = $request->user();
        $user->newEmail($request->email);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->company = $request->company;

        if ($user->getPendingEmail()) {
            $user->email_verified_at = null;
        }

        if ($request->input('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('home')
            ->with('status', __('auth.changed'));
    }

    /**
     * Handle an incoming deletion request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function create(Request $request)
    {
        return view('pages.auth.delete');
    }

    /**
     * Handle an incoming deletion request.
     * Validate the password before deleting the user
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        $user = $request->user();

        if ($user->hasRole('super-admin')) {
            abort(502);
        }

        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        RegisterToken::where('email', $user->email)
            ->delete();
        
        $user->clearPendingEmail();
        $user->delete();

        return redirect()->route('home')
            ->with('status', __('auth.deleted'));
    }
}
