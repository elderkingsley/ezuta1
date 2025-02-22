@extends('admin.auth.layout.forms')
@section('title', 'Ezuta Login')
@section('content')
         
    <div class="container">
        <div class="form-box">
            
                <img src="{{asset('logo/ezuta2.png')}}" class="img">

            <h1>Login to Ezuta</h1>
             @if(session()->has("success"))
            <div class="alert alert-success">
                {{session()->get("success")}}
            </div>
            @endif
            @if(session()->has("error"))
            <div class="alert alert-success">
                {{session()->get("error")}}
            </div>
            @endif
            <form class="form" action="{{ route('login') }}" method="POST">
                @csrf
                <div class="input-group">
                        <div class="input-field">
                         <i class="fa-solid fa-building-user"></i>
                            <input type="text" id="username" name="username" placeholder="Username / Staff ID" value="{{ old('username') }}" required>
                        </div>
                            @if ($errors->has('username'))
                                <div class="text-danger">{{$message}}</div>
                            @endif

                        <div class="input-field">
                            <i class="fa-solid fa-lock"></i>
                        <input type="password" id="passworfd" name="password" placeholder="Password">
                        </div>
                            @if ($errors->has('password'))
                                <div class="text-danger">{{$message}}</div>
                            @endif

                </div>

                <div class="submit">
                    <button type="submit" name="save" id="save">Submit</button>
                </div>
                        
            </form>

                        <div class="input-sign-in">
                            <label for="sign_in"> Don't have an account? <a href="{{route('register')}}"> Register</a> </label>
                        </div>

        </div>     
    </div>
@endsection
