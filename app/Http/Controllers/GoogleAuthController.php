<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;

class GoogleAuthController extends Controller
{
    // Tanggapin ang role galing sa URL (halimbawa: /auth/google?role=student)
    public function redirect(Request $request)
    {
        $role = $request->query('role', 'student'); // Default to student kung walang naipasa
        session(['google_login_role' => $role]);

        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            
            // Kunin ang role na sinet natin sa session batay sa login page na pinanggalingan
            $requestedRole = strtolower(session('google_login_role', 'student'));

            // Hanapin ang user sa database gamit ang google_id o email
            $user = User::where('google_id', $googleUser->getId())
                        ->orWhere('email', $googleUser->getEmail())
                        ->first();

            // 1. KUNG WALA PA SA DATABASE ANG ACCOUNT (STRICT ACCESS CONTROL)
            if (!$user) {
                return redirect()->route("{$requestedRole}.login", ['role' => $requestedRole])
                    ->with('error', 'No existing account found for this Google email. Please register manually first.');
            }

            // 2. ROLE MISMATCH CHECK (Case-insensitive comparison para hindi magkamali ng dashboard)
            $userRole = strtolower($user->role);

            if ($userRole !== $requestedRole) {
                return redirect()->route("{$requestedRole}.login", ['role' => $requestedRole])
                    ->with('error', "Access Denied: This account is registered as an " . ucfirst($userRole) . ", not a " . ucfirst($requestedRole) . ".");
            }

            // 3. KUNG UNANG BESES NA MAG-LOG IN VIA GOOGLE ANG EXISTING USER, I-LINK ANG GOOGLE ID
            if (!$user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }

            // I-log in ang user
            Auth::login($user);

            // I-redirect base sa kanilang TUNAY NA ROLE SA DATABASE
            if ($userRole === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($userRole === 'instructor') {
                return redirect()->intended('/instructor/dashboard');
            } else {
                return redirect()->intended('/student/dashboard');
            }

        } catch (Exception $e) {
            $requestedRole = strtolower(session('google_login_role', 'student'));
            
            return redirect()->route("{$requestedRole}.login", ['role' => $requestedRole])
                ->with('error', 'No existing account found for this Google email. Please register manually first. ' . $e->getMessage());
        }
    }
}