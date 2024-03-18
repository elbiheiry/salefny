<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
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
        $user = auth()->user();

        return view('admin.pages.profile.index' ,compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $v = validator($request->all() , [
            'name' => ['required' ,'max:225' ,'string'],
            'email' => ['required' ,'max:225' ,'string' ,'email' , 'unique:users,email,'.auth()->id()],
            'phone' => ['required'],
            'password' => $request->password ? ['string', 'min:8'] : ''
        ] ,[] , [
            'name' => 'الإسم بالكامل',
            'email' => 'البريد الإلكتروني',
            'password' => 'الرقم السري',
            'phone' => 'رقم الجوال'
        ]);

        if ($v->fails()) {
            return response()->json($v->errors()->first() , 400);
        }

        $data = [
            'name' => $request->name,
            'email'=> $request->email,
            'phone' => $request->phone
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user = auth()->user();

        try {
            $user->update($data);

            return response()->json('تم تحديث البيانات بنجاح' , 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }
}
