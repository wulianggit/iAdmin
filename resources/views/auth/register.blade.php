@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="login_wrapper">
        <div id="register" class="animate form login_form">
            <section class="login_content">
                <form method="post" action="{{url('/register')}}">
                    {{csrf_field()}}
                    <h1>Create Account</h1>

                    <div>
                        <input type="text" name="username" class="form-control {{$errors->has('username') ? 'parsley-error' : ''}}" placeholder="Username" required="" value="{{old('username')}}" />
                        @if ($errors->has('username'))
                            <p class="text-danger text-left"><strong>{{ $errors->first('username') }}</strong></p>
                        @endif
                    </div>

                    <div>
                        <input type="text" name="name" class="form-control {{$errors->has('name') ? 'parsley-error' : ''}}" placeholder="name" required="" value="{{old('name')}}" />
                        @if ($errors->has('name'))
                            <p class="text-danger text-left"><strong>{{ $errors->first('name') }}</strong></p>
                        @endif
                    </div>

                    <div>
                        <input type="email" name="email" class="form-control {{$errors->has('email') ? 'parsley-error' : ''}}" placeholder="email" required="" value="{{old('email')}}" />
                        @if ($errors->has('email'))
                            <p class="text-danger text-left"><strong>{{ $errors->first('email') }}</strong></p>
                        @endif
                    </div>

                    <div>
                        <input type="password" name="password" class="form-control {{$errors->has('password') ? 'parsley-error' : ''}}" placeholder="password" required="" value="{{old('password')}}" />
                        @if ($errors->has('password'))
                            <p class="text-danger text-left"><strong>{{ $errors->first('password') }}</strong></p>
                        @endif
                    </div>

                    <div>
                        <input type="password" name="password_confirmation" class="form-control {{$errors->has('password_confirmation') ? 'parsley-error' : ''}}" placeholder="password_confirmation" required="" value="{{old('password_confirmation')}}" />
                        @if ($errors->has('password_confirmation'))
                            <p class="text-danger text-left"><strong>{{ $errors->first('password_confirmation') }}</strong></p>
                        @endif
                    </div>

                    <div>
                        <button class="btn btn-default submit">Submit</button>
                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Already a member ?
                            <a href="{{url('/login')}}" class="to_register"> Log in </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-paw"></i> Gentelella Alela!</h1>
                            <p>©2016 All Rights Reserved. Gentelella Alela! is a Bootstrap 3 template. Privacy and Terms</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</div>
@endsection
