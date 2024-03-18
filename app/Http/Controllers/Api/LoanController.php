<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Bill;
use App\Models\Loan;
use App\Models\Member;
use App\Models\Setting;
use Illuminate\Http\Request;

class LoanController extends Controller
{
    public function index()
    {
        $loans = Loan::with('bills')->where('member_id' , request()->user()->id)->orderBy('id' , 'desc')->get();

        return response()->json($loans , 200);
    }

    public function show($id)
    {
        $loan = Loan::with(['bills' , 'member'])->findOrFail($id);

        return response()->json($loan , 200);
    }

    public function get_bill($id)
    {
        $bill = Bill::findOrFail($id);

        return response()->json($bill , 200);
    }

    public function create_loan(Request $request)
    {
        $settings = Setting::firstOrFail();
        $validator = validator($request->all() , [
            'amount' => ['required'],
            'months' => ['required']
        ] ,[] ,[
            'amount' => 'المبلغ المراد استلافه',
            'months' => 'عدد الشهور المراد التسديد خلالها',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            $loan = Loan::create([
                'amount' => $request->amount + $settings->tax,
                'months' => $request->months,
                'member_id' => $request->user()->id,
                'accepted' => 0
            ]);

            for ($i=1; $i <= $loan->months; $i++) { 
                $loan->bills()->create([
                    'amount' => number_format($loan->installment),
                    'status' => 'pending',
                    'payment_date' => $loan->created_at->addMonth($i)->format('y-m-d')
                ]);
            }
            return response()->json([
                'message' => 'تم طلب السلفة بنجاح , في إنتظار تاكيد الطلب ',
                'loan' => $loan
            ], 200);
        } catch (\Throwable $th) {

            // dd($th->getMessage());
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }
}
