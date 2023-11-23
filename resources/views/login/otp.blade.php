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
    @if (Route::currentRouteName() == 'login' || Route::currentRouteName() == 'otp')
        <link href="{{ asset('theme/assets/css/signin.css') }}" rel="stylesheet" />
    @else
        {{-- <link href="{{ asset('theme/assets/css/bootstrap-icons.css') }}" rel="stylesheet" /> --}}
        <link href="{{ asset('theme/assets/css/dashboard.css') }}" rel="stylesheet">
    @endif
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>

<body class="text-center">
    <main class=" w-100  container-fluid p-0 h-100">

        <div class="row g-0  align-items-center h-100 justify-content-center">
            <div class="col-xl-6 col-lg-5  d-none d-lg-block h-100">
                <div class="authentication-left-panel vh-100  d-flex flex-column justify-content-between">
                    <div class="panel-header p-4  text-start">
                        <div class="text-start text-white text-center d-inline-block">
                            <img class="mb-1 brand" src="{{ asset('theme/assets/images/AKD-LOGO-white.png') }}" alt=""
                                width="100">
                            <h1 class="h5 mb-5 fw-normal">AKD Securities Limited</h1>
                        </div>
                    </div>
                    <div class="panel-body">
                        <h1 class="h3 mb-5">Verification Code</h1>

                        <img class="mb-4" src="{{ asset('theme/assets/images/icons/Verification-icon.svg') }}"
                            alt="" width="140">
                    </div>
                </div>
            </div>
            <div class=" col-xl-6 col-lg-7 col-md-8  col-sm-10 h-100">
                <div class="d-flex flex-column align-items-center justify-content-lg-around justify-content-between h-100">
                    <form id='opt_verify' class="form-signin col-lg-6 col-10 requires-validation" novalidate method="POST"
                        action="{{ route('otp_verify') }}">
                        @csrf
                        <img class="mb-1 brand" src="{{ asset('theme/assets/images/AKD-LOGO.png') }}" alt=""
                            width="100">
                        <h1 class="h5 mb-4 fw-normal">AKD Securities Limited</h1>

                        <h1 class="h3 orange-text m-0">Verification Code</h1>

                        <p class="py-4 m-0"> Enter the Verification Code that was sent to
                            your registered mobile number ending in
                            <strong class="fs-5">**********{{ substr($mobileNo, -2) }}</strong>
                        </p>
                        <p class="text-center mb-5 theme-color">
                            <strong class="fs-5" id='clockdiv'></strong> left to enter your Verification Code

                        </p>

                        <div class=" input-group   align-items-center">
                            <div class="code-block">
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class='code-input  text-center otp_box' required />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class='code-input text-center otp_box' required />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class='code-input text-center otp_box' required />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class='code-input text-center otp_box' required />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class='code-input text-center otp_box' required />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class='code-input text-center otp_box' required />
                            </div>
                            <div id='optVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Field
                                cannot be blank!</div>
                        </div>

                        <button class="mt-4 w-100 btn btn-lg theme-btn align-items-center d-flex justify-content-center "
                            type="button" id="submit_opt"><i class="bi bi-arrow-btn me-2"></i><span>Submit</span></button>
                        <button class="mt-2 w-100 btn btn-lg sell-btn blue-btn align-items-center d-flex justify-content-center "
                            type="button" id='resend' disabled onclick="resendOtp()"><i
                                class="bi resend-icon me-2"></i><span>Resend
                                OTP</span></button>

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
    <script>
        jQuery(document).ready(function() {
            jQuery('#submit_opt').click(function(e) {
                if (!checkOptBox()) {
                    return false;
                }
                $("#submit_opt").prop("disabled", true);
                e.preventDefault();
                jQuery.ajax({
                    url: $("#opt_verify").attr('action'),
                    method: 'POST',
                    data: $('#opt_verify').serialize(),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                    },
                    success: function(response) {
                        if (response == 200) {
                            window.location.href = "{{ route('saving_plane_create') }}";

                        } else {
                            swal({
                                text: "OTP do not match!",
                                confirmButtonColor: '#8CD4F5',
                                type: "danger"
                            }).then(okay => {
                                if (okay) {
                                    window.location.href = "{{ route('logout') }}";
                                } else {
                                    window.location.href = "{{ route('logout') }}";

                                }
                            });
                        }

                        // jQuery('.alert-danger').hide();
                        // location.reload();
                    },

                });
            });
        });

        function submitOtp() {
            // $check=checkOptBox();

            // if($check == 'true')
            // {

            // $('#opt_verify').submit()
            //url = "{{ route('saving_plane_create') }}";
            //document.location.href=url;
            // }

        }

        function checkOptBox() {
            optBox = document.querySelectorAll('.otp_box')
            for (let i = 0; i < optBox.length; i++) {
                if (optBox[i].value == '') {
                    $("#optVal").css("display", "block");
                    return false;
                    break;
                }
            }
            $("#optVal").css("display", "none");
            return true;
        }

        function resendOtp() {
            document.cookie = "myClock=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/otp;";
            url = "{{ route('otp_resend') }}";
            document.location.href = url;
            setTimeInCookie();


        }

        function initializeClock(id, endtime) {
            const clock = document.getElementById(id);
            const timeinterval = setInterval(() => {
                const t = getTimeRemaining(endtime);
                clock.innerHTML = '0' + t.minutes + ':' + hasOneDigit(t.seconds);
                if (t.total <= 0) {
                    $('#resend').prop("disabled", false);
                    $('#submit_opt').prop("disabled", true);
                    clock.innerHTML = '0:00';
                    console.log('aa', t.total);
                    clearInterval(timeinterval);
                } else {
                    $('#submit_opt').prop("disabled", false);

                    $('#resend').prop("disabled", true);
                }
            }, 1000);
        }
        let deadline;

        // if there's a cookie with the name myClock, use that value as the deadline
        if (document.cookie && document.cookie.match('myClock')) {
            // debugger;
            // get deadline value from cookie
            deadline = document.cookie.match(/(^|;)myClock=([^;]+)/)[2];
        } else {
            // debugger;
            setTimeInCookie();
        }

        console.log('clockdiv', deadline);
        initializeClock('clockdiv', deadline);

        function setTimeInCookie() {
            // otherwise, set a deadline 10 minutes from now and 
            // save it in a cookie with that name

            // create deadline 10 minutes from now
            const timeInMinutes = 2;
            const currentTime = Date.parse(new Date());
            deadline = new Date(currentTime + timeInMinutes * 60 * 1000);
            // store deadline in cookie for future reference
            console.log('clockdivaa', deadline);
            initializeClock('clockdiv', deadline);
            document.cookie = 'myClock=' + deadline + '; path=/otp;';
        }


        function getTimeRemaining(endtime) {
            const total = Date.parse(endtime) - Date.parse(new Date());
            const seconds = Math.floor((total / 1000) % 60);
            const minutes = Math.floor((total / 1000 / 60) % 60);
            const hours = Math.floor((total / (1000 * 60 * 60)) % 24);
            const days = Math.floor(total / (1000 * 60 * 60 * 24));
            return {
                total,
                days,
                hours,
                minutes,
                seconds
            };
        }

        function hasOneDigit(val) {
            return String(Math.abs(val)).charAt(0) == val ? '0' + val : val;
        }
    </script>

</html>