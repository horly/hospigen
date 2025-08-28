<?php

namespace App\Http\Middleware;

use App\Models\Licence;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckLicenseExpiration
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Si l'utilisateur est superadmin, on laisse passer
        if ($user->role->name === 'superadmin') {
            return $next($request);
        }

        // Pour admin et user, on vérifie la licence
        $licence = Licence::first();

        if (!$licence || Carbon::now()->greaterThan($licence->date_expiration)) {
            Auth::logout();
            return redirect()->route('app_add_licence')
                ->with('danger', __('licence.your_license_has_expired'));
        }

        return $next($request);
    }
}
