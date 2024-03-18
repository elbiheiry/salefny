<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $users = User::all()->except('1')->sortByDesc('id');

        return view('admin.pages.users.index' ,compact('users'));
    }

    public function store(Request $request)
    {
        $validator = validator($request->all() ,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required'],
            'password' => ['required', 'string', 'min:8'],
        ] ,[] ,[
            'name' => 'إسم المستخدم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف' ,
            'password' => 'الرقم السري'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        try {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password)
            ]);

            return response()->json( 'تم إضافة المستخدم بنجاح', 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }

    }

    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('admin.pages.users.show' ,compact('member'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.pages.users.edit' ,compact('user'));
    }

    public function update(Request $request , $id)
    {
        $validator = validator($request->all() ,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            'phone' => ['required'],
            'password' => $request->password ? [ 'string', 'min:8'] : ''
        ] ,[] ,[
            'name' => 'إسم المستخدم',
            'email' => 'البريد الإلكتروني',
            'phone' => 'رقم الهاتف' ,
            'password' => 'الرقم السري'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->first() , 400);
        }

        $user = User::findOrFail($id);

        $data = $request->all();

        if ($request->password !== null) {
            $data['password'] = Hash::make($request->password);
        }else{
            $data['password'] = $user->password;
        }

        try {
            $user->update($data);

            return response()->json( 'تم تحديث بيانات المستخدم بنجاح', 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();

        return redirect()->back();
    }
}
