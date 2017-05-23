@extends('wasp.default')

@section('content')
    <div class="main">
        <div class="loginbox">
            <br />
            <div>
                <h2>Login</h2>
            </div>
            <form class="form" id="form" target="" method="post" action="">
                <label>Username</label>
                <div>
                    <input type="text" id="username" name="username" required="required" />
                </div>
                <label>Password</label>
                <div>
                    <input type="password" id="password" name="password" required="required" />
                </div>
                <div>
                    <input id="loginButton" type="submit" value="Login" />
                </div>
                <br />
                    <a href="https://etsupws.etsu.edu/AccountActivation/" target="_blank">forgot password?</a>
            </form>
        </div>
    </div>
@stop
