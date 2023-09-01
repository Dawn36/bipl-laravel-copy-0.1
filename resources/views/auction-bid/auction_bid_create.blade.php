  <div class="row justify-content-center">
      <div class="col-md-7">
          <div class="row my-4 ">
              <div class="mb-3  col-lg-12">
                  <label class="form-label">Date</label>
                  <div class="input-group date  p-0 " id="">
                      <input type="text" class="form-control border-left" value="{{ Date('Y-m-d') }}" disabled />
                      <span class="input-group-append">
                          <span class="input-group-text bg-white h-100">
                              <i class="icons calendar-icon"></i>
                          </span>
                      </span>
                  </div>
              </div>
              <div class="mb-3  col-lg-12 ">
                  <p style="text-align: left;">The Treasury Marketing Unit<br>
                      Investor Portfolio Services<br>
                      AKD Securities Limited<br>
                      602 Continental Trade Center<br>
                      Block 8, Clifton Karachi Pakistan</p>
              </div>
              <div class="my-3  col-lg-12 ">
                  <h4>Placement of Non Competitive Bids</h4>
                  <p>Pursuant to the tender notice published by the State Bank of Pakistan for the sale of government
                      securities, I/we, would like to apply for purchase of following:</p>
              </div>
              <form id='auction_bid_submit' class="requires-validation" novalidate method="POST"
              action="{{ route('auction-bid.store') }}">
              @csrf
              <div class="mb-3  col-lg-12 ">
                  <label class="form-label">Placement of Non Competitive Bids</label>
                  <select class="form-select border-left" name="non_competitive_bid" id="NonCompetitiveids"
                      onchange="getAuctionDate()">
                      <option value="">Select Instrument</option>
                      <option value="TREASURY BILL">Treasury Bills</option>
                      <option value="IJARA SUKUK">Ijara Sukuk</option>
                  </select>
              </div>
              <div class="mb-3  col-lg-12 ">
                  <label class="form-label">Auction Date</label>
                  <select class="form-select border-left" onchange="getMaturity()" id="auction_date"
                      name="auction_date">
                      <option value="">Select auction date</option>

                  </select>
              </div>
              <div class="mb-3  col-lg-12 ">
                  <label class="form-label">Insert IPS Account Number</label>
                  <input id="" class="form-control border-left" id="account_number" type="text"
                      placeholder="Enter Account Number" value="{{$account}}" name="account_number" disabled />
              </div>
              <div class="mb-3  col-lg-12 ">
                  <label class="form-label">Insert CNIC/NTN</label>
                  <input type="text" class="form-control border-left" id="cnic" name="cnic"
                      placeholder="Enter CNIC/NTN" value="{{ isset($clientInfo->cnic) ? $clientInfo->cnic : '' }}" disabled>
              </div>

              <div id="clone_dive">
                  <div class="mb-3  col-lg-12 ">
                      <label class="form-label ">Select Maturity</label>
                      <select class="form-select box border-left maturitydrop" name="maturity[]" id="maturity">

                      </select>
                  </div>
                  <div class="mb-3 col-lg-12 ">
                      <label class="form-label">Insert Bid/Investment Amount</label>
                      <input id="" class=" form-control border-left maturityamount" type="number"
                          placeholder="Enter Investment Amount" name="amount[]" />
                  </div>
              </div>
              <div class="d-flex justify-content-end" id="add_more">
                  <button class="btn sell-btn blue-btn" style="font-size: 13px;" type="button"
                      onclick="clone()"></i><span>Add More</span></button>
              </div>

              <div id="after_clone_add_here">
              </div>
            </form>

              {{-- class="row text-center mb-5 d-flex justify-content-center justify-content-xl-between" --}}
              <div>
                  <button class="mt-4 w-100 btn btn-lg theme-btn align-items-center justify-content-center "
                      type="button" id="sendOtpToUser"><i class="bi bi-arrow-btn me-2"></i><span>Send
                          OTP</span></button>
              </div>

          </div>
          <form id='auction_bid_verify' class="requires-validation" novalidate method="POST"
              action="{{ route('otp_verify') }}">
              @csrf
              <div class="mb-3  col-lg-12 ">
                  {{-- <h1 class="h3 orange-text m-0">Verification Code</h1> --}}

                  <p class="py-4 m-0"> Enter the Verification Code that was sent to you
                  </p>
                  <p class="text-center mb-5 theme-color">
                      <strong class="fs-5" id='clockdiv'></strong> left to enter your
                      Verification Code
                  </p>
                  <div class=" input-group   align-items-center" style="width: 75%; margin: auto;">
                      <div class="code-block">
                          <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                              class='code-input  text-center auction_bid_box' required />
                          <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                              class='code-input text-center auction_bid_box' required />
                          <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                              class='code-input text-center auction_bid_box' required />
                          <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                              class='code-input text-center auction_bid_box' required />
                          <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                              class='code-input text-center auction_bid_box' required />
                          <input type="tel" maxlength="1" pattern="[0-9]" name='otp[]'
                              class='code-input text-center auction_bid_box' required />
                      </div>
                      <div id='optVal' class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Field
                          cannot be blank!</div>
                  </div>
              </div>
              <div class="row text-center mb-5 d-flex justify-content-center justify-content-xl-between">
                  <button
                      class="mt-4 w-100 btn btn-lg theme-btn align-items-center d-flex justify-content-center "
                      type="button" id="submit_opt"><i class="bi bi-arrow-btn me-2"></i><span>Submit</span></button>
                  <button
                      class="mt-2 w-100 btn btn-lg sell-btn blue-btn align-items-center d-flex justify-content-center "
                      type="button" id='resend' disabled onclick="resendOtp()"><i
                          class="bi resend-icon me-2"></i><span>Resend
                          OTP</span></button>

              </div>
          </form>

      </div>
  </div>
  <script>
      function getAuctionDate() {
          var nonCompetitiveids = $('#NonCompetitiveids').val();
          $('#after_clone_add_here').html('');
          i = 1;
          $.ajax({
              type: 'GET',
              url: "{{ route('auction-date') }}",
              data: {
                  nonCompetitiveids: nonCompetitiveids,
              },
              success: function(result) {
                  if (result.length == 0) {
                      document.getElementById('auction_date').innerHTML =
                          '<option value="">Select auction date</option>';
                  } else {
                      document.getElementById('auction_date').innerHTML =
                          '<option value="">Select auction date</option>';
                      for (var i = 0; i < result.length; i++) {
                          var opt = document.createElement('option');
                          datetimeString = result[i].auction_date; // Your datetime string
                          date = new Date(datetimeString);
                          day = String(date.getDate()).padStart(2, '0');
                          month = new Intl.DateTimeFormat('en-US', {
                              month: 'short'
                          }).format(date);
                          year = date.getFullYear();
                          formattedDate = `${day}-${month}-${year}`;
                          opt.value = formattedDate;
                          opt.innerHTML = formattedDate;
                          document.getElementById('auction_date').appendChild(opt);
                      }
                  }
              }
          });
      }

      function getMaturity() {
          // TreasuryBills
          // IjaraSukuk
          var nonCompetitiveids = $('#NonCompetitiveids').val();
          var auction_date = $('#auction_date').val();
          $.ajax({
              type: 'GET',
              url: "{{ route('get-maturity') }}",
              data: {
                  nonCompetitiveids: nonCompetitiveids,
                  auction_date: auction_date,
              },
              success: function(result) {
                  if (result.length == 0) {
                      document.getElementById('maturity').innerHTML =
                          '<option value="">Select maturity</option>';
                  } else {
                      document.getElementById('maturity').innerHTML =
                          '<option value="">Select maturity</option>';
                      for (var i = 0; i < result.length; i++) {
                          var opt = document.createElement('option');
                          opt.value = result[i].auction_id;
                          opt.innerHTML = result[i].scheme_name;
                          document.getElementById('maturity').appendChild(opt);
                      }
                  }

              }
          });
      }

      var i = 1;

      function clone() {
          if (!validationCheck()) {
              return false;
          }
          if (i == 3) {
              Swal.fire({
                  icon: 'error',
                  title: 'Alert',
                  text: "You can't add more then 3 rows",
                  confirmButtonColor: '#073f8a',
              })
              return false;
          }
          i++;
          var cloneDiv = $('#clone_dive').clone();
          cloneDiv[0].children[0].children[1].value = '';
          cloneDiv[0].children[1].children[1].value = '';
          //   cloneDiv.insertBefore("#after_clone_add_here");
          $('#after_clone_add_here').append(cloneDiv);
          //   cloneDiv.html(");
      }
      var formA = document.querySelector("#auction_bid_verify");
      var inputA = formA.querySelectorAll(".auction_bid_box");
      var KEYBOARDA = {
          backspace: 8,
          arrowLeft: 37,
          arrowRight: 39,
      };

      function handleInput(e) {
          var input = e.target;
          var nextInput = input.nextElementSibling;
          if (nextInput && input.value) {
              nextInput.focus();
              if (nextInput.value) {
                  nextInput.select();
              }
          }
      }

      function handlePaste(e) {
          e.preventDefault();
          var paste = e.clipboardData.getData("text");
          inputA.forEach((input, i) => {
              input.value = paste[i] || "";
          });
      }

      function handleBackspace(e) {
          var input = e.target;
          if (input.value) {
              input.value = "";
              return;
          }

          input.previousElementSibling.focus();
      }

      function handleArrowLeft(e) {
          var previousInput = e.target.previousElementSibling;
          if (!previousInput) return;
          previousInput.focus();
      }

      function handleArrowRight(e) {
          var nextInput = e.target.nextElementSibling;
          if (!nextInput) return;
          nextInput.focus();
      }

      formA.addEventListener("input", handleInput);
      inputA[0].addEventListener("paste", handlePaste);

      inputA.forEach((input) => {
          input.addEventListener("focus", (e) => {
              setTimeout(() => {
                  e.target.select();
              }, 0);
          });

          input.addEventListener("keydown", (e) => {
              switch (e.keyCode) {
                  case KEYBOARDA.backspace:
                      handleBackspace(e);
                      break;
                  case KEYBOARDA.arrowLeft:
                      handleArrowLeft(e);
                      break;
                  case KEYBOARDA.arrowRight:
                      handleArrowRight(e);
                      break;
                  default:
              }
          });
      });


      function resendOtp() {
          document.cookie = "myClock=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/auction_bid_create;";
          //url = "aa";
          // document.location.href = url;
          setTimeInCookie();
          optAuctionCreate();
      }

      function initializeClock(id, endtime) {

          var clock = document.getElementById(id);
          var timeinterval = setInterval(() => {
              var t = getTimeRemaining(endtime);
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
      var deadline;

      // if there's a cookie with the name myClock, use that value as the deadline
      // if (document.cookie && document.cookie.match('myClock')) {
      //     // get deadline value from cookie
      //     deadline = document.cookie.match(/(^|;)myClock=([^;]+)/)[2];
      // } else {
      //     setTimeInCookie();
      // }

      console.log('clockdiv', deadline);
      $('#auction_bid_verify').hide();

      $("#sendOtpToUser").click(function() {
          if (!validationCheck()) {
              return false;
          }
          $('#add_more').attr('style', 'display: none !important;');
          $('#sendOtpToUser').hide();
          $('#auction_bid_verify').show();
          setTimeInCookie();
          initializeClock('clockdiv', deadline);
          optAuctionCreate();
          // alert("The paragraph was clicked.");
      });

      function setTimeInCookie() {
          // otherwise, set a deadline 10 minutes from now and 
          // save it in a cookie with that name

          // create deadline 10 minutes from now
          var timeInMinutes = 2;
          var currentTime = Date.parse(new Date());
          deadline = new Date(currentTime + timeInMinutes * 60 * 1000);
          // store deadline in cookie for future reference
          console.log('clockdivaa', deadline);
          initializeClock('clockdiv', deadline);
          document.cookie = 'myClock=' + deadline + '; path=/auction_bid_create;';
      }


      function getTimeRemaining(endtime) {
          var total = Date.parse(endtime) - Date.parse(new Date());
          var seconds = Math.floor((total / 1000) % 60);
          var minutes = Math.floor((total / 1000 / 60) % 60);
          var hours = Math.floor((total / (1000 * 60 * 60)) % 24);
          var days = Math.floor(total / (1000 * 60 * 60 * 24));
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

      function validationCheck() {
          if ($('#NonCompetitiveids').val() == '') {
              Swal.fire({
                  icon: 'error',
                  title: 'Alert',
                  text: "Please select instrument",
                  confirmButtonColor: '#073f8a',
              })
              return false;
          }
          if ($('#auction_date').val() == '') {
              Swal.fire({
                  icon: 'error',
                  title: 'Alert',
                  text: "Please select auction date",
                  confirmButtonColor: '#073f8a',
              })
              return false;
          }
          var results = [];
          var currentAmount=0;
          var selectedId=0;
          $('.maturitydrop').each(function() {
              var selectedValue = $(this).val();
              selectedId=selectedValue;
              if (selectedValue == '') {
                  Swal.fire({
                      icon: 'error',
                      title: 'Alert',
                      text: "Please select all maturity date",
                      confirmButtonColor: '#073f8a',
                  })
                  results.push('Please select all maturity date');
                  return false;
              }
          });
          $('.maturityamount').each(function() {
              var selectedValue = $(this).val();
              currentAmount +=parseInt(selectedValue);
              if (selectedValue == '') {
                  Swal.fire({
                      icon: 'error',
                      title: 'Alert',
                      text: "Please enter all amount",
                      confirmButtonColor: '#073f8a',
                  })
                  results.push('Please enter all amount');
                  return false;
              }
          });
          
          if (currentAmount % 5000 !== 0) {
                  Swal.fire({
                      icon: 'error',
                      title: 'Alert',
                      text: "Please enter amount that are multiple of 5000",
                      confirmButtonColor: '#073f8a',
                  })
                  results.push('Please enter amount that are multiple of 5000');
                  return false;
              }
          $.ajax({
              url: "{{route('get-info-auction')}}",
              method: 'Get',
              async: false, 
              data: {
                auction_id:selectedId,
              },
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              success: function(response) {
                if(parseInt(response.cash_balance) < currentAmount)
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Dear Client',
                        text: `Your investment amount for the upcoming auction exceeds your cash balance. You are requested to deposit the shortfall amount 
                        PkR(${numberFormate(Math.abs(parseInt(response.cash_balance) - currentAmount).toFixed(0))}) before 
                        (${response.auction_details.last_bid_date}) and resubmit your bid`,
                        confirmButtonColor: '#073f8a',
                    })
                    results.push('Please select all maturity date');
                }
              },
          });
          
          if (results.length > 0) {
              return false;
          }
          return true;
      }

      function optAuctionCreate() {
          $.ajax({
              type: 'Post',
              url: "{{ route('otp_auction') }}",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: {
                  _token: $('meta[name="csrf-token"]').attr('content'),
              },
              success: function(result) {

              }
          });
      }


      $('#submit_opt').click(function(e) {
          if (!checkOptBox()) {
              return false;
          }
          $("#submit_opt").prop("disabled", true);
          e.preventDefault();
          $.ajax({
              url: $("#auction_bid_verify").attr('action'),
              method: 'POST',
              data: $('#auction_bid_verify').serialize(),
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
              },
              success: function(response) {
                  if (response == 200) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Alert',
                        text: "OTP match successfully",
                        confirmButtonColor: '#073f8a',
                    }).then(okay => {
                    if (okay) {
                        // $('#auction_bid_submit').submit();
                        auctionBidSubmit('auction_bid_submit','exampleModal');
                    }}
                    )
                  } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alert',
                        text: "OTP do not match!",
                        confirmButtonColor: '#073f8a',
                    })
                  }

                  // jQuery('.alert-danger').hide();
                  // location.reload();
              },

          });
      });

      function auctionBidSubmit(formId,modalId) {
        debugger
      
        $.ajax({
            url: $(`#${formId}`).attr('action'),
            method: 'POST',
            data: new FormData($(`#${formId}`)[0]),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            success: function(result) {
                
                if(result)
                {
                    Swal.fire({
                        icon: 'success',
                        title: 'Alert',
                        text: "Auction bid submit successfully",
                        confirmButtonColor: '#073f8a',
                    });
                   // window.location.reload();
                }
                else
                {
                    Swal.fire({
                        icon: 'error',
                        title: 'Alert',
                        text: "Try again after some time",
                        confirmButtonColor: '#073f8a',
                    })
                }
                

                $(`#${modalId}`).modal('hide');
            },
            cache: false,
            contentType: false,
            processData: false
        });
        
    }

      function checkOptBox() {
            optBox = document.querySelectorAll('.auction_bid_box')
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
  </script>
