<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Providers\RouteServiceProvider;

class DashboardController extends Controller
{
    /**
     * Switch to a different dashboard
     */
    public function switchDashboard(Request $request)
    {
        $user = auth()->user();
        $dashboard = $request->input('dashboard');
        
        // Validate dashboard access
        $allowedDashboards = [];
        
        if ($user->isSuperAdmin()) {
            $allowedDashboards = ['content-management', 'accountant', 'front-office', 'super-admin'];
        } elseif ($user->isAdmin()) {
            $allowedDashboards = ['content-management'];
        } elseif ($user->isAccountant()) {
            $allowedDashboards = ['accountant'];
        } elseif ($user->isFrontOffice()) {
            $allowedDashboards = ['front-office'];
        }
        
        if (!in_array($dashboard, $allowedDashboards)) {
            return redirect()->back()->with('error', 'You do not have access to that dashboard.');
        }
        
        // Redirect to the selected dashboard
        switch ($dashboard) {
            case 'content-management':
                return redirect()->route('content-management.dashboard');
            case 'accountant':
                return redirect()->route('accountant.dashboard');
            case 'front-office':
                return redirect()->route('front-office.dashboard');
            case 'super-admin':
                return redirect()->route('content-management.dashboard'); // Super Admin uses content management
            default:
                return redirect(RouteServiceProvider::getDashboardRoute($user));
        }
    }
    
    /**
     * Get available dashboards for current user
     */
    public function getAvailableDashboards()
    {
        $user = auth()->user();
        $dashboards = [];
        
        if ($user->isSuperAdmin()) {
            $dashboards = [
                ['name' => 'Content Management', 'route' => 'content-management.dashboard', 'icon' => 'fa-cog', 'key' => 'content-management'],
                ['name' => 'Accountant', 'route' => 'accountant.dashboard', 'icon' => 'fa-calculator', 'key' => 'accountant'],
                ['name' => 'Front Office', 'route' => 'front-office.dashboard', 'icon' => 'fa-concierge-bell', 'key' => 'front-office'],
            ];
        } elseif ($user->isAdmin()) {
            $dashboards = [
                ['name' => 'Content Management', 'route' => 'content-management.dashboard', 'icon' => 'fa-cog', 'key' => 'content-management'],
            ];
        } elseif ($user->isAccountant()) {
            $dashboards = [
                ['name' => 'Accountant', 'route' => 'accountant.dashboard', 'icon' => 'fa-calculator', 'key' => 'accountant'],
            ];
        } elseif ($user->isFrontOffice()) {
            $dashboards = [
                ['name' => 'Front Office', 'route' => 'front-office.dashboard', 'icon' => 'fa-concierge-bell', 'key' => 'front-office'],
            ];
        }
        
        return response()->json($dashboards);
    }
}
