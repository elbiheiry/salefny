<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Validator;

class MemberController extends Controller
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
        $members = Member::all()->sortByDesc('id');

        return view('admin.pages.members.index' ,compact('members'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'identification' => ['required' ,'numeric', 'unique:members,identification'],
            'name' => ['required' , 'string' , 'max:255'],
            'phone' => ['required'],
            'employer' => ['required' , 'string' , 'max:255'],
            'position' => ['required' , 'string' , 'max:255'],
            'salary' => ['required' ,'numeric'],
            'monthly_commitment' => ['required' ,'numeric'],
            'address' => ['required' , 'string' , 'max:255'],
            'password' => ['required' , Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised(),'string']
        ] ,[] ,[
            'identification' => 'رقم الهوية',
            'name' => 'الاسم الرباعي',
            'phone' => 'رقم الجوال',
            'employer' => 'جهة العمل',
            'position' => 'الرتبة',
            'salary' => 'مقدار الراتب',
            'monthly_commitment' => 'الاتزامات الشهرية',
            'address' => 'العنوان',
            'password' => 'الرقم السري'
        ]);

        if ($validator->fails())
        {
            return response()->json( $validator->errors()->first(), 400);
        }

        $request['password'] = Hash::make($request['password']);

        try {
            
            Member::create($request->toArray());

            return response()->json( 'تم إضافة المستخدم بنجاح', 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }

    }

    public function show($id)
    {
        $member = Member::findOrFail($id);

        return view('admin.pages.members.show' ,compact('member'));
    }

    public function edit($id)
    {
        $member = Member::findOrFail($id);

        return view('admin.pages.members.edit' ,compact('member'));
    }

    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'identification' => ['required' ,'numeric', 'unique:members,identification,'.$request->user()->id],
            'name' => ['required' , 'string' , 'max:255'],
            'phone' => ['required'],
            'employer' => ['required' , 'string' , 'max:255'],
            'position' => ['required' , 'string' , 'max:255'],
            'salary' => ['required' ,'numeric'],
            'monthly_commitment' => ['required' ,'numeric'],
            'address' => ['required' , 'string' , 'max:255'],
            'password' => $request->password ? [Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(),'string'] : ''
        ] ,[] ,[
            'identification' => 'رقم الهوية',
            'name' => 'الاسم الرباعي',
            'phone' => 'رقم الجوال',
            'employer' => 'جهة العمل',
            'position' => 'الرتبة',
            'salary' => 'مقدار الراتب',
            'monthly_commitment' => 'الالتزامات الشهرية',
            'address' => 'العنوان',
            'password' => 'الرقم السري'
        ]);
        if ($validator->fails())
        {
            return response()->json( $validator->errors()->first(), 400);
        }

        if ($request->password) {
            $request['password'] = Hash::make($request['password']);
        }
        try {
            Member::findOrFail($id)->update($request->toArray());

            return response()->json('تم تعديل بيانات المستخدم بنجاح' , 200);
        } catch (\Throwable $th) {
            return response()->json('لقد حدث خطأ برجاء المحاولة لاحقا ' , 400);
        }
    }

    public function destroy($id)
    {
        Member::findOrFail($id)->delete();

        return redirect()->back();
    }
}
