<section class="hero-wrap hero-wrap-2 js-fullheight"
    style="background-image: url('{{ asset('frontend/images/bg_3_new.jpg') }}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
            <div class="col-md-9 ftco-animate pb-5">

                <div class="col-md-9 animated fadeIn col-lg-9 center-screen">
                    <div class="card card-transparent p-4">
                        <div class="card-body">
                            <h4>SIGN IN</h4>
                            <br />
                            <input id="email" placeholder="User Email" class="form-control" type="email" />
                            <br />
                            <input id="password" placeholder="User Password" class="form-control" type="password" />
                            <br />
                            <button onclick="SubmitLogin()" class="btn w-100 btn-secondary">Login</button>
                            <hr />
                            <div class="float-end mt-3">
                                <span>
                                    <a class="text-center ms-3 h6" href="{{ url('/userRegistration') }}">Sign Up </a>
                                    <span class="ms-1">|</span>
                                    <a class="text-center ms-3 h6" href="{{ url('/sendOtp') }}">Forget Password</a>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>



{{-- <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('{{asset('frontend/images/bg_3.jpg')}}');" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
        <div class="col-md-9 ftco-animate pb-5">

            {{-- <div class="col-md-7 animated fadeIn col-lg-9 center-screen">
                <div class="card w-90  p-4">
                    <div class="card-body">
                        <h4>SIGN IN</h4>
                        <br/>
                        <input id="email" placeholder="User Email" class="form-control" type="email"/>
                        <br/>
                        <input id="password" placeholder="User Password" class="form-control" type="password"/>
                        <br/>
                        <button onclick="SubmitLogin()" class="btn w-100 btn-secondary">Login</button>
                        <hr/>
                        <div class="float-end mt-3">
                            <span>
                                <a class="text-center ms-3 h6" href="{{url('/userRegistration')}}">Sign Up </a>
                                <span class="ms-1">|</span>
                                <a class="text-center ms-3 h6" href="{{url('/sendOtp')}}">Forget Password</a>
                            </span>
                        </div>
                    </div>
                </div>
            </div> --}}

{{-- </div>
      </div>
    </div>
  </section>  --}}




{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7 animated fadeIn col-lg-6 center-screen">
            <div class="card w-90  p-4">
                <div class="card-body">
                    <h4>SIGN IN</h4>
                    <br/>
                    <input id="email" placeholder="User Email" class="form-control" type="email"/>
                    <br/>
                    <input id="password" placeholder="User Password" class="form-control" type="password"/>
                    <br/>
                    <button onclick="SubmitLogin()" class="btn w-100 bg-gradient-primary">Next</button>
                    <hr/>
                    <div class="float-end mt-3">
                        <span>
                            <a class="text-center ms-3 h6" href="{{url('/userRegistration')}}">Sign Up </a>
                            <span class="ms-1">|</span>
                            <a class="text-center ms-3 h6" href="{{url('/sendOtp')}}">Forget Password</a>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> --}}


<script>
    async function SubmitLogin() {
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;

        if (email.length === 0) {
            errorToast("Email is required");
        } else if (password.length === 0) {
            errorToast("Password is required");
        } else {
            showLoader();
            let res = await axios.post("/user-login", {
                email: email,
                password: password
            });
            hideLoader()
            if (res.status === 200 && res.data['status'] === 'success') {
                // window.location.href="/dashboard";
                let isAdmin = res.data['isAdmin']
                let isCustomer = res.data['isCustomer']

                if (isAdmin) {
                    sessionStorage.removeItem('last_location');
                    window.location.href = "/admin/dashboard";
                } else if (isCustomer) {
                    let url = sessionStorage.getItem("last_location")
                    if (url) {
                        sessionStorage.removeItem('last_location');
                        window.location.href = url
                    } else {
                        window.location.href = "/";
                    }
                }
            } else {
                errorToast(res.data['message']);
            }
        }
    }
</script>
