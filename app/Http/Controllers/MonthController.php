<?php

namespace App\Http\Controllers;

use App\Models\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $months = Month::all()->sortByDesc('id');

        return view('admin.pages.months.index' ,compact('months'));
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
            'month' => ['required' , 'numeric'],
            'status' => ['not_in:0']
        ] , [] ,[
            'month' => 'الشهر',
            'status' => 'الحالة'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            Month::create($request->all());

            return response()->json('تم إدخال الشهر بنجاح' , 200);
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
        $month = Month::findOrFail($id);

        return view('admin.pages.months.edit' ,compact('month'));
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
            'month' => ['required' , 'numeric'],
            'status' => ['not_in:0']
        ] , [] ,[
            'month' => 'الشهر',
            'status' => 'الحالة'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            Month::findOrFail($id)->update($request->all());

            return response()->json('تم تعديل بيانات الشهر بنجاح' , 200);
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
        Month::findOrFail($id)->delete();

        return redirect()->back();
    }
}
