<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Amount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Member;
use App\Models\Month;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
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
        
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        
        $user = Member::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = ['token' => $token];

        return response($response, 200);
    }

    public function login (Request $request) {
        $validator = Validator::make($request->all(), [
            'identification' => ['required' ,'numeric'],
            'password' => ['required' , Password::min(8)
            ->mixedCase()
            ->numbers()
            ->symbols()
            ->uncompromised(),'string']
        ] , [] , [
            'identification' => 'رقم الهوية',
            'password' => 'الرقم السري'
        ]);

        if ($validator->fails())
        {
            return response()->json( $validator->errors()->first(), 400);
        }
        
        $user = Member::where('identification', $request->identification)->first();
        
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = ['token' => $token];
                return response($response, 200);
            } else {
                // $response = ["message" => "Password mismatch"];
                return response()->json( 'الرقم السري غير متطابق', 400);
            }
        } else {
            // $response = ["message" =>'User does not exist'];
            return response()->json('المستخدم غير موجود' , 200);
        }
    }

    public function signout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        // $response = ['message' => 'You have been successfully logged out!'];
        return response()->json('تم تسجيل الخروج بنجاح' , 200);
    }

    public function retrieve_user(Request $request)
    {
        if (Auth::guard('api')->check()) {
            return $request->user();    
        }else{
            return response()->json( 'برجاء تسجيل الدخول اولا', 400);
        }
        
    }

    public function settings()
    {
        $amounts = Amount::all()->where('status' , 1)->sortByDesc('id');
        $months = Month::all()->where('status' , 1)->sortByDesc('id');
        $tax = Setting::firstOrFail();

        return response()->json([
            'amounts_available' => $amounts,
            'months_available' => $months,
            'tax' => $tax->tax
        ] , 200);
    }

    public function update_user(Request $request)
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
            'monthly_commitment' => 'الاتزامات الشهرية',
            'address' => 'العنوان',
            'password' => 'الرقم السري'
        ]);
        if ($validator->fails())
        {
            return response()->json( $validator->errors()->first(), 400);
        }

        if ($request->password) {
            $request['password']=Hash::make($request['password']);
        }
        Member::findOrFail($request->user()->id)->update($request->toArray());

        return response()->json($request->user() , 200);
    }
}
