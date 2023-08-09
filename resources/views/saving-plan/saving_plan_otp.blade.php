<style>
  .swal-button {
    background-color: #082c5b;
   
}
</style>
<div class="container-fluid theme-bg h-100">
    <div
      class="row login_container align-items-center justify-content-center"
    >
      <div class="col-md-12 login_LC py-5">
        <div class="row align-items-center justify-content-center">
          <div
            class="bg-white rounded-2 col-xl-9 col-lg-9 p-xl-5 p-5 mx-lg-5"
          >
            <h4 class="text-center mb-0 theme-color">Verification Code</h4>
            <p class="text-center mt-5 theme-color">
              Enter the Verification Code that was sent to
              <strong class="fs-5">{{$email}}</strong>
            </p>
            <p class="text-center mb-5 theme-color">
              <strong class="fs-5" id='clockdiv'></strong> left to enter your
              Verification Code
            </p>
            <form id='opt_verify' class="requires-validation" novalidate method="POST" action="{{ route('otp_verify') }}" >
              @csrf

              <div class="input-group mb-3">
                <div class="d-flex mb-3">
                  <input
                    type="tel"
                    maxlength="1"
                    pattern="[0-9]"
                    name='otp[]'
                    class="form-control mx-1 otp_box"
                  />
                  <input
                    type="tel"
                    maxlength="1"
                    pattern="[0-9]"
                    name='otp[]'
                    class="form-control mx-1 otp_box"
                  />
                  <input
                    type="tel"
                    maxlength="1"
                    pattern="[0-9]"
                    name='otp[]'
                    class="form-control mx-1 otp_box"
                  />
                  <input
                    type="tel"
                    maxlength="1"
                    pattern="[0-9]"
                    name='otp[]'
                    class="form-control mx-1 otp_box"
                  />
                  <input
                    type="tel"
                    maxlength="1"
                    pattern="[0-9]"
                    name='otp[]'
                    class="form-control mx-1 otp_box"
                  />
                  <input
                    type="tel"
                    maxlength="1"
                    pattern="[0-9]"
                    name='otp[]'
                    class="form-control mx-1 otp_box"
                  />
                </div>
                <div id='optVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Field cannot be blank!</div>

              </div>

              <div
                class="input-group form-button mb-3 justify-content-center"
              >
                <button  type="button"
                  id="submit_opt"
                  class="btn btn-primary rounded-1 theme-bgcolor" 
                >
                  Submit
            </button>
            <button type="button" id='resend' style="margin-left: 10px;"
                  class="btn btn-primary rounded-1 theme-bgcolor" disabled onclick="resendOtp()"
                >
                  Resend
            </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      {{-- <x-saving-plan-card></x-saving-plan-card> --}}
    </div>
  </div>
<script src="{{ asset('theme/assets/js/script.js')}}"></script>

  {{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}
<script>
   jQuery(document).ready(function() {
        jQuery('#submit_opt').click(function(e) {
          if(!checkOptBox()){
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
                  if(response == 200)
                  {
                    swal({ 
                     text: "Saving plan submit",
                     confirmButtonColor: '#8CD4F5',
                    type: "danger"}).then(okay => {
                    if (okay) {
                      $('#exampleModal').modal('toggle')
                      submitSavingPlanCreate();
                    // window.location.href = "{{route('saving_plane_create')}}";

                    }
                    
                    else
                    {
                      $('#exampleModal').modal('toggle')

                      submitSavingPlanCreate();
                        // window.location.href = "{{route('saving_plane_create')}}";

                    }
                    });
                }
                  else
                  {
                    swal({ 
                     text: "Otp do not match!",
                     confirmButtonColor: '#8CD4F5',
                    type: "danger"}).then(okay => {
                    if (okay) {
                        window.location.href = "{{route($redirectRoute)}}";

                    //   window.location.href = "{{route('logout')}}";
                    }
                    else
                    {
                        window.location.href = "{{route($redirectRoute)}}";

                    //   window.location.href = "{{route('logout')}}";

                    }
                  });
                  }
                  
                    // jQuery('.alert-danger').hide();
                    // location.reload();
                },
              
            });
        });
    });
    function checkOptBox()
    {
      optBox=document.querySelectorAll('.otp_box')
    for (let i = 0; i < optBox.length; i++) {
      if(optBox[i].value== '')
      {
        $("#optVal").css("display", "block");
        return false;
        break;
      }
    }
    $("#optVal").css("display", "none");
    return true;
    }

function resendOtp()
{
  document.cookie = "myClock=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/saving_plane_create;";
  $.ajax({
    type: 'GET',
    url: "{{route('saving_plane_otp_resend')}}",
    success: function(result) {
        // $('#exampleModalLabel').html('Saving plan submit otp');
        // $('#modalbody').html(result);
        // $('#exampleModal').modal('show');
    }
});
//   url = "{{route('otp_resend')}}";
//     document.location.href=url;
  setTimeInCookie();
  
    
}

  function initializeClock(id, endtime) {
  const clock = document.getElementById(id);
  const timeinterval = setInterval(() => {
    const t = getTimeRemaining(endtime);
    clock.innerHTML =  '0'+t.minutes + ':'+hasOneDigit(t.seconds) ;
    if (t.total <= 0) {
      $('#resend').prop("disabled", false);
      $('#submit_opt').prop("disabled", true);
      clock.innerHTML =  '0:00';
      console.log('aa',t.total);
      clearInterval(timeinterval);
    }
    else
    {
      $('#submit_opt').prop("disabled", false);

      $('#resend').prop("disabled", true);
    }
  },1000);
}
let deadline;

// if there's a cookie with the name myClock, use that value as the deadline
if(document.cookie && document.cookie.match('myClock')){
  // debugger;
  // get deadline value from cookie
  deadline = document.cookie.match(/(^|;)myClock=([^;]+)/)[2];
} else {
  // debugger;
  setTimeInCookie();
}

console.log('clockdiv',deadline);
  initializeClock('clockdiv', deadline);
function setTimeInCookie()
{
 // otherwise, set a deadline 10 minutes from now and 
  // save it in a cookie with that name

  // create deadline 10 minutes from now
  const timeInMinutes = 2;
  const currentTime = Date.parse(new Date());
  deadline = new Date(currentTime + timeInMinutes*60*1000);
  // store deadline in cookie for future reference
  console.log('clockdivaa',deadline);
  initializeClock('clockdiv', deadline);
  document.cookie = 'myClock=' + deadline + '; path=/saving_plane_create;';
}


function getTimeRemaining(endtime){
  const total = Date.parse(endtime) - Date.parse(new Date());
  const seconds = Math.floor( (total/1000) % 60 );
  const minutes = Math.floor( (total/1000/60) % 60 );
  const hours = Math.floor( (total/(1000*60*60)) % 24 );
  const days = Math.floor( total/(1000*60*60*24) );
  return {
    total,
    days,
    hours,
    minutes,
    seconds
  };
}
function hasOneDigit(val) {
  return String(Math.abs(val)).charAt(0) == val ? '0'+val : val;
}
</script>