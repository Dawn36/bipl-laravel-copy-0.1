<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AKD Securities Limited">
    <title>AKD Securities Limited</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="{{ asset('theme/assets/images/AKD-LOGO.png') }}" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
        <link href="{{ asset('theme/assets/css/signin.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>

<body class="text-center">
    <div class="container-fluid theme-bg h-100 ">
        <div class="row login_container align-items-center justify-content-center ">
            <div class="col-md-7 login_LC py-5 ">
                <div class="row align-items-end justify-content-end">
                    <div class="bg-white rounded-2 col-xl-7 col-lg-9 p-xl-5 p-5 mx-lg-5">
                        <h4 class="text-center mb-0 theme-color">AKD Welcome!</h4>
                        <p class="text-center mb-5 theme-color">Login your account to start the service</p>
                        <form class="requires-validation" novalidate method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0" id=""><i
                                        class="custom-icon icon-email"></i></span>
                                <input class="form-control border-start-0" id='email' type="email" name="email"
                                    placeholder="Email" required>
                                <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Email field is valid!
                                </div>
                                <div id='emailVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Email
                                    field cannot be blank!</div>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text bg-white border-end-0" id=""><i
                                        class="custom-icon icon-password"></i></span>
                                <input class="form-control border-start-0" id="password-field" type="password"
                                    name="password" placeholder="Password" required>
                                <i id="change_pass_icon" class="bi-eye-slash field-icon toggle-password"
                                    onclick="showPassword()"></i>
                                <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Email field is valid!
                                </div>
                                <div id='passwordVal' class="invalid-feedback"><i
                                        class="bi-x-circle-fill">&nbsp;</i>Password field cannot be blank!</div>
                            </div>
                            <div class="input-group form-button mb-3 justify-content-end">
                                <button type="button" onclick="submitFrom()" id="submit"
                                    class="btn btn-primary rounded-1 theme-bgcolor">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
            <x-saving-plan-card></x-saving-plan-card>
        </div>
    </div>
</body>
<script src="{{ asset('theme/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('theme/assets/js/script.js') }}"></script>
<script src="{{ asset('theme/assets/js/sweetalert.min.js') }}"></script>
    <script>
        function submitFrom() {
            if (ValidateProductData()) {
                url = "{{ route('otp', ['email' => ':email']) }}";
                id = $("#email").val();
                url = url.replace(':email', id);
                document.location.href = url;
                console.log(url);
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
            email = document.getElementById('email').value;
            if (email == '') {
                $("#emailVal").css("display", "block");
                emailVal = document.getElementById('emailVal');
                emailVal.childNodes[1].textContent = 'Email field cannot be blank!';
                return false;
            }
            var emailregex = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
            if (emailregex.test(email) == false) {

                $("#emailVal").css("display", "block");
                emailVal = document.getElementById('emailVal');
                emailVal.childNodes[1].textContent = 'Wrong Email! (Hint:abc@gmail.com)';
                return false;
            }
            $("#emailVal").css("display", "none");

            passwordVal = document.getElementById('password-field').value;
            if (passwordVal == '') {
                $("#passwordVal").css("display", "block");
                return false;
            }
            $("#passwordVal").css("display", "none");
            return true;
        }
    </script>
</html>
