<style>
    .swal-button {
        background-color: #082c5b;

    }
</style>
<div class="container-fluid theme-bg h-100">
    <div class="row login_container align-items-center justify-content-center">
        <div class="col-md-12 login_LC py-5">
            <div class="row align-items-center justify-content-center">
                <div class="bg-white rounded-2 col-xl-9 col-lg-9 p-xl-5 p-5 mx-lg-5">
                    <h4 class="text-center mb-0 theme-color">Verification Pin</h4>
                    <p class="text-center mt-1 theme-color">
                        Please enter your Tradecast T-Pin/Verification Pin to proceed in submitting your request
                        {{-- @if ($day)
                            You have selected an early maturity at {{ $day }} days for your selected investment
                            plan.
                        @endif --}}
                        <strong class="fs-5">{{ $email }}</strong>
                    </p>
                    <form id='opt_verify' class="requires-validation" novalidate method="POST">
                        @csrf
                        <div class="input-group mb-3">
                            <div class="d-flex mb-3">
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class="form-control mx-1 otp_box" style="min-width: 0px !important;" />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class="form-control mx-1 otp_box" style="min-width: 0px !important;" />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class="form-control mx-1 otp_box" style="min-width: 0px !important;" />
                                <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                                    class="form-control mx-1 otp_box" style="min-width: 0px !important;" />

                            </div>
                            <div id='optVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Field
                                cannot be blank!</div>

                        </div>

                        <div class="input-group form-button mb-3 justify-content-center">
                            <button type="button" id="submit_opt" class="btn btn-primary rounded-1 theme-bgcolor">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        {{-- <x-saving-plan-card></x-saving-plan-card> --}}
    </div>
</div>
<script src="{{ asset('theme/assets/js/script.js') }}"></script>

{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script>
    jQuery(document).ready(function() {
        jQuery('#submit_opt').click(function(e) {
            if (!checkOptBox()) {
                return false;
            }
            swal({
                text: "Successfully Submit",
                confirmButtonColor: '#8CD4F5',
                type: "danger"
            }).then(okay => {
                if (okay) {
                    $('#exampleModal').modal('toggle')
                    submitSavingPlanCreate();
                } else {
                    $('#exampleModal').modal('toggle')

                    submitSavingPlanCreate();
                }
            });

            //   $("#submit_opt").prop("disabled", true);
            //   e.preventDefault();
            //   jQuery.ajax({
            //       url: $("#opt_verify").attr('action'),
            //       method: 'POST',
            //       data: $('#opt_verify').serialize(),
            //       headers: {
            //           'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            //       },
            //       success: function(response) {
            //         if(response == 200)
            //         {
            //           swal({ 
            //            text: "Saving plan submit",
            //            confirmButtonColor: '#8CD4F5',
            //           type: "danger"}).then(okay => {
            //           if (okay) {
            //             $('#exampleModal').modal('toggle')
            //             submitSavingPlanCreate();
            //           // window.location.href = "{{ route('saving_plane_create') }}";

            //           }

            //           else
            //           {
            //             $('#exampleModal').modal('toggle')

            //             submitSavingPlanCreate();
            //               // window.location.href = "{{ route('saving_plane_create') }}";

            //           }
            //           });
            //       }
            //         else
            //         {
            //           swal({ 
            //            text: "Otp do not match!",
            //            confirmButtonColor: '#8CD4F5',
            //           type: "danger"}).then(okay => {
            //           if (okay) {
            //               window.location.href = "{{ route($redirectRoute) }}";

            //           }
            //           else
            //           {
            //               window.location.href = "{{ route($redirectRoute) }}";

            //           }
            //         });
            //         }
            //       },

            //   });
        });
    });

    function checkOptBox() {
        optBox = document.querySelectorAll('.otp_box')
        var pin = '';
        for (let i = 0; i < optBox.length; i++) {
            if (optBox[i].value == '') {
                $("#optVal").css("display", "block");
                return false;
                break;
            }
            pin += optBox[i].value;
            $('#user_pin').val('');
            $('#user_pin').val(pin);
        }
        $("#optVal").css("display", "none");
        return true;
    }
</script>
