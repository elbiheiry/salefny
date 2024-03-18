<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $settings = Setting::firstOrFail();

        return view('admin.pages.settings.index' ,compact('settings'));
    }

    public function update(Request $request)
    {
        $validator = validator($request->all() , [
            'tax' => ['required' , 'numeric']
        ] ,[] ,[
            'tax' => 'الرسوم الإداريه'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        $settings = Setting::firstOrFail();

        try {
            $settings->update($request->all());

            return response()->json('تم تحديث البيانات بنجاح' , 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }
}
