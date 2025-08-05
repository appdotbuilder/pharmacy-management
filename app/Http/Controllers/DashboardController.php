<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Drug;
use App\Models\Prescription;
use App\Models\Sale;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get statistics based on user role
        $stats = [
            'total_drugs' => Drug::active()->count(),
            'low_stock_drugs' => Drug::lowStock()->count(),
            'expired_drugs' => Drug::expired()->count(),
            'total_customers' => Customer::active()->count(),
            'pending_prescriptions' => Prescription::pending()->count(),
            'today_sales' => Sale::whereDate('created_at', today())->completed()->count(),
            'today_revenue' => Sale::whereDate('created_at', today())->completed()->sum('total_amount'),
        ];

        // Get recent activities
        $recent_sales = Sale::with(['customer', 'user'])
            ->latest()
            ->take(5)
            ->get();

        $low_stock_drugs = Drug::lowStock()
            ->active()
            ->orderBy('stock_quantity')
            ->take(10)
            ->get();

        $pending_prescriptions = Prescription::with(['customer'])
            ->pending()
            ->latest()
            ->take(5)
            ->get();

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'recent_sales' => $recent_sales,
            'low_stock_drugs' => $low_stock_drugs,
            'pending_prescriptions' => $pending_prescriptions,
            'user_role' => $user->role,
        ]);
    }
}