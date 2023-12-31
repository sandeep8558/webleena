@layout('layouts/admin')

@section('head')
<title>Login</title>
@endsection('head')

@section('body')

<div class="container">
    <div class="row justify-content-center align-items-center m-0 vh-100">

        <div class="col-11 col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4 p-0 h-auto">

            <div class="shadow rounded-4">

                <h3 class="text-center bg-primary text-light p-4 mb-0 rounded-top-4">Sign In</h3>

                <form action="/authenticate" method="post" class="rounded-bottom-4 p-4">
                    
                    <div class="form-floating mb-4">
                        <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                    </div>

                    <div class="form-floating">
                        <button type="submit" class="btn btn-primary">Sign In</button>
                        <a class="d-inline-block btn btn-link" href="/forgot">Forgot Password</a>
                    </div>
                    
                </form>
                
            </div>

            <div class="p-3 text-center">Powered By <strong>WebLeena</strong></div>

        </div>

    </div>
</div>

@endsection('body')