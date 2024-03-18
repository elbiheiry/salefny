<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use App\Models\Bill;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Month;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loan::all()->sortByDesc('id');
        $members = Member::all()->sortByDesc('id');
        $amounts = Amount::all()->where('status' , 1)->sortByDesc('id');
        $months = Month::all()->where('status' , 1)->sortByDesc('id');

        return view('admin.pages.loans.index' ,compact('loans' , 'members' , 'amounts' , 'months'));
    }

    public function show($id)
    {
        $loan = Loan::findOrFail($id);

        return view('admin.pages.loans.show' ,compact('loan'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $settings = Setting::firstOrFail();

        $validator = validator($request->all() , [
            'amount' => ['not_in:0'],
            'months' => ['not_in:0'],
            'member_id' => ['not_in']
        ] ,[] ,[
            'amount' => 'المبلغ المراد استلافه',
            'months' => 'عدد الشهور المراد التسديد خلالها',
            'member_id' => 'طالب السلفة'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            $loan = Loan::create([
                'amount' => $request->amount + $settings->tax,
                'months' => $request->months,
                'member_id' => $request->member_id,
                'accepted' => 1
            ]);

            for ($i=1; $i <= $loan->months; $i++) { 
                $loan->bills()->create([
                    'amount' => number_format($loan->installment),
                    'status' => 'pending',
                    'payment_date' => $loan->created_at->addMonth($i)->format('y-m-d')
                ]);
            }
            

            return response()->json('تم طلب السلفة بنجاح , في إنتظار تاكيد الطلب ', 200);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }

    public function change_status(Request $request , $id)
    {
        $loan = Loan::findOrFail($id);

        $loan->accepted = $request->accepted;

        $loan->save();

        return response()->json('تم تحديث حالة الطلب بنجاح' , 200);
    }

    public function get_bill($id)
    {
        $bill = Bill::findOrFail($id);

        return view('admin.pages.loans.bill' ,compact('bill'));
    }

    public function update_bill(Request $request , $id)
    {
        $validator = validator($request->all() , [
            'payment_date' => ['required'],
            'status' => ['not_in:0']
        ],[],[
            'payment_date' => 'موعد الاستحقاق',
            'status' => 'حالة الاستحقاق'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        $bill = Bill::findOrFail($id);

        try {
            $bill->update([
                'payment_date' => $request->payment_date,
                'status' => $request->status
            ]);

            return response()->json('تم تحديث بيانات الفاتوره بنجاح' , 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }
}
