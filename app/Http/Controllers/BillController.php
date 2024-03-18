<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function index()
    {
        $bills = Bill::with('loan.user')
                    ->whereRelation('loan' , 'accepted' ,1)
                    ->whereMonth('payment_date' , Carbon::now()->month)
                    ->whereYear('payment_date' , Carbon::now()->year)
                    ->where('status' , 'pending')->orderBy('id' , 'desc')->get();

        return view('admin.pages.bills.index' ,compact('bills'));
    }

    public function search(Request $request)
    {
        $month = $request->month;
        $year = $request->year;

        $bills = Bill::with('loan.user')
                    ->whereRelation('loan' , 'accepted' ,1)
                    ->whereMonth('payment_date', date($month))
                    ->whereYear('payment_date' , date($year))
                    ->where('status' , 'pending')->orderBy('id' , 'desc')->get();

        return view('admin.pages.bills.search' ,compact('bills'));
    }
}