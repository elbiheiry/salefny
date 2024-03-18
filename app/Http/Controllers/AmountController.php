<?php

namespace App\Http\Controllers;

use App\Models\Amount;
use Illuminate\Http\Request;

class AmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amounts = Amount::all()->sortByDesc('id');

        return view('admin.pages.amounts.index' ,compact('amounts'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = validator($request->all() , [
            'amount' => ['required' , 'numeric'],
            'status' => ['not_in:0']
        ] , [] ,[
            'amount' => 'المبلغ',
            'status' => 'الحالة'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            Amount::create($request->all());

            return response()->json('تم إدخال المبلغ بنجاح' , 200);
        } catch (\Throwable $th) {
            // dd($th->getMessage());
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $amount = Amount::findOrFail($id);

        return view('admin.pages.amounts.edit' ,compact('amount'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = validator($request->all() , [
            'amount' => ['required' , 'numeric'],
            'status' => ['not_in:0']
        ] , [] ,[
            'amount' => 'المبلغ',
            'status' => 'الحالة'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            Amount::findOrFail($id)->update($request->all());

            return response()->json('تم تعديل بيانات المبلغ بنجاح' , 200);
        } catch (\Throwable $th) {
            
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Amount::findOrFail($id)->delete();

        return redirect()->back();
    }
}
