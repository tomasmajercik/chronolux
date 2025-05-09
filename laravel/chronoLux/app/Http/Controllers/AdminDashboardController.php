<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Order;
use Carbon\Carbon;
class AdminDashboardController extends Controller
{

    public function adminStats()
    {
        $now = Carbon::now();

        $ordersThisMonth = Order::whereMonth('created_at', $now->month)
                                ->whereYear('created_at', $now->year)
                                ->count();

        $newUsersThisMonth = User::whereMonth('created_at', $now->month)
                                ->whereYear('created_at', $now->year)
                                ->count();

        $totalOrders = Order::count();

        $salesThisMonth = Order::whereMonth('created_at', $now->month)
                            ->whereYear('created_at', $now->year)
                            ->sum('total_price');

        $salesThisYear = Order::whereYear('created_at', $now->year)
                            ->sum('total_price');

        $salesOverall = Order::sum('total_price');

        return view('admin.dashboard', [
            'ordersThisMonth' => $ordersThisMonth,
            'newUsersThisMonth' => $newUsersThisMonth,
            'totalOrders' => $totalOrders,
            'salesThisMonth' => $salesThisMonth,
            'salesThisYear' => $salesThisYear,
            'salesOverall' => $salesOverall,
        ]);
    }
}
