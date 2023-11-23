<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AKD Securities Limited">
    <title>AKD Securities Limited</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="{{ asset('theme/assets/images/AKD-LOGO.png') }}" />
    <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('theme/assets/css/signin.css') }}" rel="stylesheet" />
        <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>

<body class="text-center">
    <main class=" w-100  container-fluid p-0 h-100">

        <div class="row g-0  align-items-center h-100 justify-content-center">
            <div class="col-xl-6 col-lg-5 col-md-8  col-sm-10 d-none d-lg-block  h-100">
                <div class="authentication-left-panel  h-100   d-flex flex-column justify-content-between">
                    <div class="panel-header p-4  text-start">
                        <div class="text-start text-white text-center d-inline-block">
                            <img class="mb-1 brand" src="{{ asset('theme/assets/images/AKD-LOGO-white.png') }}" alt=""
                                width="100">
                            <h1 class="h5 mb-5 fw-normal">AKD Securities Limited</h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h1 class="h3 mb-5">Login</h1>

                        <img class="mb-4" src="{{ asset('theme/assets/images/icons/login-icon.png') }}" alt=""
                            width="140">

                        <h1 class="mt-3 mb-0">Welcome!</h1>
                        <p>Login your account to start the service </p>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7 col-md-8  col-sm-10 h-100 py-5">
                <div class=" d-flex flex-column align-items-center justify-content-lg-around justify-content-between h-100">
                    <form id='login_form' class="form-signin col-lg-6 col-10 requires-validation" novalidate method="POST"
                        action="{{ route('login') }}">
                        @csrf
                        <div>
                            <img class="mb-1 brand" src="{{ asset('theme/assets/images/AKD-LOGO.png') }}" alt=""
                                width="100">
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            <h1 class="h5 mb-5 fw-normal">AKD Securities Limited</h1>
                        </div>
                        <div class="form-floating  input-group align-items-center mb-3">
                            <input type="text" class="form-control" id="Email" name="email"
                                placeholder="name@example.com" value="">
                            <label for="Email">User Name</label><i class="bi bi-envelope"></i>
                            @if ($errors->has('email'))
                                <div class="invalid-feedback" style="display:block"><b>{{ $errors->first('email') }}</b>
                                </div>
                            @endif
                            <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>User field is valid!
                            </div>
                            <div id='emailVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>User
                                field cannot be blank!</div>
                        </div>
                        <div class="form-floating input-group show_hide_password  align-items-center">
                            <input type="password" class="form-control" id="password-field" type="password" name="password"
                                placeholder="Password" required onkeydown="ValidateProductData()" placeholder="Password" value="">
                            <label for="Password">Password</label><button class="password-icon"><i
                                    class="bi bi-eye"></button></i>
                        </div>
                        <div id='passwordVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Password
                            field cannot be blank!</div>
                        <button class="mt-5 w-100 btn btn-lg theme-btn align-items-center d-flex justify-content-center "
                            type="button" onclick="submitFrom()"><i class="bi bi-arrow-btn me-2"></i><span>Sign
                                in</span></button>
                    </form>
                    <x-saving-plan-card></x-saving-plan-card>
                </div>
            </div>
        </div>
    </main>
</body>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/script.js') }}"></script>
<script src="{{ asset('theme/assets/js/sweetalert.min.js') }}"></script>
    {{-- <div class="container-fluid theme-bg h-100 ">
        <div class="row login_container align-items-center justify-content-center ">
            <div class="col-md-7 login_LC py-5 ">
                <div class="row align-items-end justify-content-end">
                    <div class="bg-white rounded-2 col-xl-7 col-lg-9 p-xl-5 p-5 mx-lg-5">
                        @if ($message = Session::get('error'))
                            <div class="alert alert-danger alert-block" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif
                        <h4 class="text-center mb-0 theme-color">AKD Welcome! </h4>
                        <p class="text-center mb-5 theme-color">Login your account to start the service
                        <form id='login_form' class="requires-validation" novalidate method="POST"
                            action="{{ route('login') }}" onSubmit="javascript:submitFrom();">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0" id=""><i
                                        class="custom-icon icon-email"></i></span>
                                <input class="form-control border-start-0" id='email' type="text" name="email"
                                    placeholder="Email" onkeydown="ValidateProductData()" required>
                                @if ($errors->has('email'))
                                    <div class="invalid-feedback" style="display:block"><b>{{ $errors->first('email') }}</b>
                                    </div>
                                @endif
                                <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Email field is valid!
                                </div>
                                <div id='emailVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Email
                                    field cannot be blank!</div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0" id=""><i
                                        class="custom-icon icon-password"></i></span>
                                <input class="form-control border-start-0" id="password-field" type="password"
                                    name="password" placeholder="Password" required onkeyup="ValidateProductData()">
                                <i id="change_pass_icon" class="bi-eye-slash field-icon toggle-password"
                                    onclick="showPassword()"></i>
                                <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Email field is valid!
                                </div>
                                <div id='passwordVal' class="invalid-feedback"><i
                                        class="bi-x-circle-fill">&nbsp;</i>Password field cannot be blank!</div>
                            </div>
                            <div class="input-group form-button mb-3 justify-content-end">
                                <button type="submit" id="submit"
                                    class="btn btn-primary rounded-1 theme-bgcolor">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <x-saving-plan-card></x-saving-plan-card>
        </div>
    </div> --}}
    <script>
        function submitFrom() {
            if (ValidateProductData()) {
                document.cookie = "myClock=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/otp;";
                $('#login_form').submit();
                // url ="{{ route('login') }}";
                // url = "{{ route('otp', ['email' => ':email']) }}";
                // id=$("#email").val();
                // url = url.replace(':email', id);
                // document.location.href=url;
                // debugger;
                // console.log(url);
            }

        }

        function showPassword() {
            var x = document.getElementById("password-field");
            if (x.type === "password") {
                x.type = "text";
                $('#change_pass_icon').removeClass('bi-eye-slash');
                $('#change_pass_icon').addClass('bi-eye-fill');
            } else {
                $('#change_pass_icon').addClass('bi-eye-slash');
                $('#change_pass_icon').removeClass('bi-eye-fill');
                x.type = "password";
            }
        }

        function ValidateProductData() {
            // email = document.getElementById('email').value;
            // if(email == '')
            // {
            //     $("#emailVal").css("display", "block");
            //     emailVal= document.getElementById('emailVal');
            //     emailVal.childNodes[1].textContent='Email field cannot be blank!';
            //     return false;
            // }
            // var emailregex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            // if (emailregex.test(email) == false) {

            //     $("#emailVal").css("display", "block");
            //     emailVal= document.getElementById('emailVal');
            //     emailVal.childNodes[1].textContent='Wrong Email! (Hint:abc@gmail.com)';
            //     return false;
            // }
            // $("#emailVal").css("display", "none");
            passwordVal = document.getElementById('password-field').value;
            if (passwordVal == '') {
                $("#passwordVal").css("display", "block");
                return false;
            }
            $("#passwordVal").css("display", "none");
            return true;
        }

        function addPasswordShowHide(el) {
            el.querySelector("button").addEventListener("click", function(event) {
                event.preventDefault();
                if (el.querySelector("input").getAttribute("type") == "text") {
                    el.querySelector("input").setAttribute("type", "password");
                    el.querySelector("i").classList.remove("bi-eye-slash");
                    el.querySelector("i").classList.add("bi-eye");
                } else if (el.querySelector("input").getAttribute("type") == "password") {
                    el.querySelector("input").setAttribute("type", "text");
                    el.querySelector("i").classList.add("bi-eye-slash");
                    el.querySelector("i").classList.remove("bi-eye");
                }
            });
        }

        document.querySelectorAll(".show_hide_password").forEach(addPasswordShowHide)
    </script>
</html>
