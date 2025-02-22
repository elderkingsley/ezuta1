<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class AuthController extends Controller
{

    public function showRegister(){
           return view('admin.auth.adminregister'); 
    }


    public function showLogin(){
       return view('admin.auth.adminlogin'); 
    }



    public function register(Request $request) {

            $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'username' => ['required', 'min:3', Rule::unique('users', 'username')],
            'phone' => ['required', Rule::unique('users', 'phone')],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => 'required',
            'terms' => 'required'
        ]);
            $user = new User();
            $user->firstname = $request->firstname; 
            $user->lastname = $request->lastname;
            $user->username = $request->username;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            if ($user->save()){
                return redirect()->route('show.login')->with('success','Registration Succesful');
            }
            else{

            return redirect()->route('show.register')->with('error','Registration Failed!!');}

   }  



    public function login(Request $request) {

        $request->validate([
        'username' => 'required',
        //'first_name' => 'required',
        //'last_name' => 'required',
        //'email' => ['required', 'email'],
        'password' => 'required'
        //'password_confirmation' => 'required',
        //'terms' => 'required'
    ]);

        $credentials = $request->only("username", "password");
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('dashboard'))->with('success','Login Successful');

        }
        else{
            return redirect()->back()->with('error','Invalid Credentials');
        }

        //if (auth()->guard()->attempt($registrationData)){
        
        //if (Auth::attempt($registrationData)){
            //$request->session()->regenerate();
            //return redirect()->route('dashboard');
        //}
        
        

       // 'email'=>$request->email,
        //'password'=>$request->password,
        //'is_admin'=>1
 
   // if($registrationData){
    //    return redirect()->route('dashboard')->with('success','Login Successful');
   // }else
    //{
   //     return redirect()->back()->with('error','Invalid Credentials');
   // }

   }  


   public function logout(Request $request){
       //Auth::logout(); - same code as line below 
       auth()->guard()->logout();
       $request->session()->invalidate();
       $request->session()->regenerateToken();

       return redirect()->route('show.login')->with('success','Logout  Successful');

    } 

  

    

    

}   
