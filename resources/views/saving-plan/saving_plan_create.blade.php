@extends('layouts.main')

@section('content')
    <style>
        input[type="radio"]:checked+label {
            color: #0d6efd;
        }

       
    </style>
    @php
        $data = Session::get('data');
    @endphp
    <main>
        <div class="authentication-left-panel d-none d-lg-block"></div>
        <div class="container mt-5">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block" role="alert">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            <div class="theme-gradient2 heading-bar">
                <h1 class="h4 text-white" style="text-align:left!important"> IPS Saving Plans</h1>
            </div>
            <hr>
            <form id='saving_plan_create' class="requires-validation" novalidate method="POST"
                action="{{ route('submit_saving_plan') }}">
                @csrf
                <div class="row ">
                    <div class="col-12 my-4 IPS-Form">
                        <div class="mb-3 input-group ">
                            <span class="ar-lable d-none d-lg-flex">نام</span>
                            <input type="text" class="form-control" type="text" name="client_name" placeholder="Name"
                                value="{{ ucwords($data['Client_Name']) }}" required readonly>
                            <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Name field is valid!
                            </div>
                            <div class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Name field cannot be
                                blank!</div>
                        </div>
                        <div class="mb-3 input-group ">
                            <span class="ar-lable d-none d-lg-flex">اکاؤنٹ نمبر</span>
                            <input type="text" class="form-control" name="account_name"
                                value="{{ ucwords($data['Account']) }}" placeholder="Account Number" required readonly>
                            <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Account Number field
                                is valid!</div>
                            <div class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Account Number field
                                cannot be blank!</div>
                        </div>
                        <div class="mb-3 input-group ">
                            <span class="ar-lable d-none d-lg-flex">بقایا رقم</span>
                            <input type="text" class="form-control" name="cash_balance"
                                value="{{ $data['Cash_Balance'] }}" placeholder="Cash Balance" required readonly>
                            <div class="valid-feedback"><i class="bi-check-circle-fill">&nbsp;</i>Cash balance field is
                                valid!</div>
                            <div class="invalid-feedback"><i class="bi-x-circle-fill">&nbsp;</i>Cash balance field
                                cannot be blank!</div>
                        </div>
                        <div class="mb-3 input-group ">
                            <span class="ar-lable d-none d-lg-flex">منتخب کریں۔</span>
                            <select class="form-select border-left" id="SavingPlanChange">
                                <option>Select</option>
                                <option value="SavingTreasuryBills">Treasury Bills</option>
                                <option value="SavingIjaraSukuk">Ijara Sukuk</option>
                            </select>
                        </div>
                        {{-- <div class=" input-group text-end justify-content-end ">
                            <a href="javascript:void(0);" class="btn sell-btn blue-btn " onclick="clone()"><i
                                    class="icons add-icon me-1"></i> Add More</a>
                        </div> --}}
                    </div>

                    <div class="col-12 boxSavingPlan" id="SavingTreasuryBills">
                        <div class="table-responsive IPS-tbl">
                            <table class="table border-0 m-0 SavingPlans_tbl">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Saving Plan</th>
                                        <th>Invested Amount?</th>
                                        <th>Invest Today</th>
                                        <th>Maturity Date</th>
                                        <th>Profit On Maturity</th>
                                        <th>WHT 15%</th>
                                        <th>Net Profit</th>
                                        {{-- <th>Amount Net of WHT at Maturity</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr id="cloneDivInvest">
                                        <td> <a onclick="removeDiv(this)"><i class="icons delete-icon pointer"></i></a></td>
                                        <td>
                                            <select class="form-select saving_plans_type" id="ips_saving_plans_type"
                                                type="text" name="saving_plans_type"
                                                placeholder="How many days would you like to invest for" required
                                                onchange="onIpsPlanChanged(this);savingPlanType(this)">
                                                <option value="">Select Saving Plan</option>
                                            </select>
                                        </td>
                                        <td> <input type="text" disabled onkeypress="onlyNumber(event)"
                                                class="form-control " id="ips_invest_amount" name='invest_amount'
                                                onkeyup="CalculateAmountRequest(this)" required>
                                            <label style="display:none; color: #FF5E6D!important;font-size: 10px;"
                                                id="error_multiple">Kindly enter
                                                multiple of 5000 PKR</label>
                                            <input type="hidden" id="txt_price" name="txt_price" value="" />
                                            <input type="hidden" id="txt_price_min_five_days"
                                                name="txt_price_min_five_days" value="" />
                                        </td>
                                        <td class="invest_amount">0</td>
                                        <td class="td-bg maturity_date">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="MaturityType0"
                                                    onclick="profitCalculation(this)"
                                                    style="float: right;margin-left: 0.5em; display: none"
                                                    id="ScheduleMaturity" value="N" required>
                                                <label class="form-check-label" style="text-align: left; cursor: pointer;"
                                                    for="ScheduleMaturity">0
                                                </label>
                                            </div>
                                        </td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class=" input-group text-end justify-content-end " style="margin-top: 10px">
                            <a href="javascript:void(0);" class="btn sell-btn blue-btn " onclick="clone()"><i
                                    class="icons add-icon me-1"></i> Add More</a>
                        </div>
                        <input hidden name="pin" id="user_pin" value="" />
                        <input hidden name="table_json" id="table_json" value="" />
                        <div class="text-center mb-5">
                            <a href="{{ route('saving_plan_index') }}" onclick="showLoader()"
                                class="btn btn-rounded blue-btn pills-button col-10 col-lg-2 col-sm-6 mx-2  mt-5"><i
                                    class="icons portfolio-icon me-3"></i>Portfolio</a>
                            <button id="submit" type="button"
                                class="btn btn-rounded theme-btn pills-button col-10 col-lg-2 col-sm-6 mx-2  mt-5"><i
                                    class="icons submit-icon me-3"></i>Submit</button>
                            {{-- <a href="{{ route('saving_plan_ijara') }}" onclick="showLoader()"
                                class="btn btn-rounded blue-btn pills-button col-10 col-lg-2 col-sm-6 mx-2  mt-5"><i
                                    class="icons portfolio-icon me-3"></i>IJara Sukuk</a>
                            <a href="{{ route('saving_plan_index') }}" onclick="showLoader()"
                                class="btn btn-rounded blue-btn pills-button col-10 col-lg-2 col-sm-6 mx-2  mt-5"><i
                                    class="icons portfolio-icon me-3"></i>Portfolio</a> --}}

                            <input id='submit_saving_plan' type="submit" name="submit" value="Save" hidden />
                        </div>


                        {{-- <div class="alert alert-warning d-flex align-items-center col-lg-10 m-auto" role="alert">
                            <i class="icons bi bi-info-square me-3"></i>
                            <div>
                                <ul class="m-0 " style="text-align: left;">
                                    <li>
                                        Scheduled Maturity Profit is subject to 15% WHT deducted at source
                                    </li>
                                    <li>WHT = SBP deducts 15 % Withholding Tax at source based on primary dealer or issue
                                        price
                                    </li>
                                    <li>Advance Schedule Maturity Profit may be subject to taxes based on voluntary
                                        assessment
                                    </li>
                                    <li>CGT = Capital Gain Tax application and submission is based on self-assessment basis
                                        if sold before Schedule Maturity. We have assumed CGT @ 12.5% for filers</li>
                                    <li>You can sell your investment at any time 5 days before Schedule Maturity. </li>
                                </ul>
                            </div>
                        </div>

                        <x-saving-plan-card></x-saving-plan-card>
                        <br /> --}}
                    </div>
                    <div class="col-12 boxSavingPlan watermark" id="SavingIjaraSukuk">
                        <div class="table-responsive IPS-tbl box">
                            <table class="table border-0 m-0 ">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Saving Plan</th>
                                        <th>Invested Amount?</th>
                                        <th>Accured Interest</th>
                                        <th>Invest Today</th>
                                        <th>Coupon Profit </th>
                                        <th>WHT 15%</th>
                                        <th>Net Profit</th>
                                        {{-- <th>Amount Net of WHT at Maturity</th> --}}
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr id="cloneDivInvest">
                                        <td> <a onclick="removeDiv(this)"><i class="icons delete-icon pointer"></i></a>
                                            @php
                                                $url = route('ijara_show');
                                            @endphp
                                            <a onclick="openModalBox('Ijara Sukuk Details','{{ $url }}')"><i
                                                    class="fa fa-info-circle pointer"
                                                    style="font-size:25px;color:#014398"></i></a>
                                        </td>
                                        <td>
                                            <select class="form-select saving_plans_type" type="text"
                                                placeholder="How many days would you like to invest for">
                                                <option value="">Select Saving Plan</option>
                                            </select>
                                        </td>
                                        <td> <input type="text" disabled onkeypress="onlyNumber(event)"
                                                class="form-control ">
                                            <label style="display:none; color: #FF5E6D!important;font-size: 10px;"
                                                id="error_multiple">Kindly enter
                                                multiple of 5000 PKR</label>
                                        </td>
                                        <td>0</td>
                                        <td>
                                            0
                                        </td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>0</td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                        <div class=" input-group text-end justify-content-end " style="margin-top: 10px">
                            <a href="javascript:void(0);" class="btn sell-btn blue-btn "><i
                                    class="icons add-icon me-1"></i> Add More</a>
                        </div>
                        <input hidden value="" />
                        <input hidden value="" />
                        <div class="text-center mb-5 ">
                            <div class="dropdown-center">
                                <a href="{{ route('saving_plan_index') }}" onclick="showLoader()"
                                    class="btn btn-rounded blue-btn pills-button col-10 col-lg-2 col-sm-6 mx-2  mt-5"><i
                                        class="icons portfolio-icon me-3"></i>Portfolio</a>
                                <button type="button"
                                    class="btn btn-rounded theme-btn pills-button col-10 col-lg-2 col-sm-6 mx-2  mt-5"><i
                                        class="icons submit-icon me-3"></i>Submit</button>
                            </div>

                            <input value="Save" hidden />
                        </div>
                    </div>
                    <div class="alert alert-warning d-flex align-items-center col-lg-10 m-auto" role="alert">
                        <i class="icons bi bi-info-square me-3"></i>
                        <div>
                            <ul class="m-0 " style="text-align: left;">
                                <li>
                                    Scheduled Maturity Profit is subject to 15% WHT deducted at source
                                </li>
                                <li>WHT = SBP deducts 15 % Withholding Tax at source based on primary dealer or issue
                                    price
                                </li>
                                <li>Advance Schedule Maturity Profit may be subject to taxes based on voluntary
                                    assessment
                                </li>
                                <li>CGT = Capital Gain Tax application and submission is based on self-assessment basis
                                    if sold before Schedule Maturity. We have assumed CGT @ 12.5% for filers</li>
                                <li>You can sell your investment at any time 5 days before Schedule Maturity. </li>
                            </ul>
                        </div>
                    </div>

                    <x-saving-plan-card></x-saving-plan-card>
                    <br />
                </div>
            </form>
        </div>
    </main>

    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#submit").click(function(event) {

            // Fetch form to apply custom Bootstrap validation
            var form = $("#saving_plan_create")

            if (form[0].checkValidity() === false) {
                event.preventDefault()
                event.stopPropagation()
            }
            if (form[0].checkValidity() === true) {
                savingPlanOtp();
                validation();
            }

            form.addClass('was-validated');
            // Perform ajax submit here...
        });

        function getPrice(days, obj) {
            var values = obj.value.split('|');
            obj.parentElement.nextElementSibling.children[0].value = '';

            rate = values[1];
            DTM = values[0];
            rate = rate - 1;
            if (days) {
                rate = rate + 2;
                DTM = days;
            }

            // let FV = $("#ips_invest_amount").val();
            let FV = obj.parentElement.nextElementSibling.children[0].value;

            $.ajax({
                type: "Get",
                url: "{{ route('get_saving_plan_price') }}",
                data: {
                    'rate': rate,
                    'DTM': DTM,
                    'FV': FV,
                },
                success: function(result) {
                    console.log("Response from server for price : " + result);
                    if (days) {
                        // obj.parentElement.nextElementSibling.children[1].children[4].value=result
                        obj.parentElement.nextElementSibling.children[3].value = result;

                        // $("#txt_price_min_five_days").val(result);
                    } else {

                        obj.parentElement.nextElementSibling.children[2].value = result;
                        // obj.parentElement.nextElementSibling.children[1].children[3].value=result
                        // $("#txt_price").val(result);
                    }
                }
            });
        }

        function savingPlanType(obj) {
            getPrice('', obj);
            getPrice(5, obj);
        }

        function CalculateAmountRequest(obj) {
            invest = obj.value;

            if (invest != "" || invest != 0) {

                if (invest % 5000 == 0) {
                    console.log('Multiple of 5000')
                    CalculateAmount(obj, 0.15);
                    obj.parentElement.children[1].style.display = 'none'
                } else {
                    console.log('Not a Multiple of 5000')
                    obj.parentElement.nextElementSibling.textContent = 0;
                    obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.textContent = 0;
                    obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
                        .textContent = 0;
                    obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
                        .nextElementSibling.textContent = 0;
                    obj.parentElement.children[1].style.display = 'block'
                    obj.focus();
                }

            } else {
                // $("#must_invest").val('')
                // $("#on_maturity").val('')
                // $("#your_profit").val('')
            }
        }
        var pp = 0;

        function CalculateAmount(obj, val) {
            // get pb value from drop down
            let pdValue = obj.parentElement.previousElementSibling.children[0].value.split('|')[2];
            if (val) {
                var price = obj.parentElement.children[2].value;
                // var price =  $("#txt_price_min_five_days").val();
            } else {

                var price = obj.parentElement.children[3].value;
                // var price =  $("#txt_price").val();
            }
            // let FV = $("#ips_invest_amount").val();
            var FV = obj.value;
            let invertedTodayPd = (pdValue / 100) * FV;
            let pdMaturity = FV - invertedTodayPd;
            // console.log('pdMaturity', pdMaturity);
            $.ajax({
                type: "Get",
                url: "{{ route('get_saving_plan_price_amount') }}",
                data: {
                    'price': price,
                    'FV': FV,
                },
                success: function(result) {
                    // console.log("Response from server for : " + result);
                    result = result.split('|');
                    if (val) {
                        pp = 0;
                        pp = result[0].replaceAll(",", "");
                        min = pdMaturity * val;
                        percentage = result[1].replaceAll(",", "") - min;
                        obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.innerHTML =
                            "Rs." +
                            numberFormate(Number(result[1].replaceAll(",", ""))
                                .toFixed(0)) + "/-";
                        obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling
                            .nextElementSibling.innerHTML = "Rs." + numberFormate(min
                                .toFixed(0)) + "/-";
                        obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling
                            .nextElementSibling.nextElementSibling.innerHTML = "Rs." + numberFormate(percentage
                                .toFixed(0)) + "/-";
                        // obj.parentElement.parentElement.nextElementSibling.children[1].children[4].innerHTML='Your profit at schedule maturity: gross profit is '+result[1]+' (Net of 15% WHT) Tax = '+percentage+' . <br>(We recommend you choose plan A)';
                        // obj.parentElement.nextElementSibling.nextElementSibling
                        //     .innerHTML = "Profit." + numberFormate(Number(result[1].replaceAll(",", ""))
                        //         .toFixed(0)) +
                        //     "/- <br><span>*WHT @ 15 %</span> <br><span>Net Profit: " + numberFormate(percentage
                        //         .toFixed(0)) +
                        //     "</span>";

                        // $('#plan_a').html('Your profit at schedule maturity: gross profit is '+result[1]+' (Net of 15% WHT) Tax = '+percentage+' . <br>(We recommend you choose plan A)')
                    } else {
                        // var values = $("#ips_saving_plans_type").val().split('|');
                        // var values = obj.parentElement.parentElement.previousElementSibling.children[0].value.split('|');
                        // DTM =  values[0];
                        // days=DTM-5;
                        // console.log('aaa', result[0]);

                        // profitCal = result[0].replaceAll(",", "") - pp;
                        // percentage = profitCal * 0.125;
                        // percentage = profitCal - percentage;
                        // console.log('profitCal', profitCal);
                        // pp = 0;

                        // obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.children[0]
                        //     .children[1].innerHTML = "Profit." + profitCal +
                        //     "/- <br><span>*CGT @ 12.5 %</span> <br><span>Net Profit: " +
                        //     percentage.toFixed(4) + "</span>";
                        // obj.parentElement.parentElement.nextElementSibling.children[1].children[1].innerHTML='Your profit at 5 days advanced maturity '+DTM+' days - 5 day advanced maturity='+days+' days  <br> Your profit is '+result[1]+' ';
                        // $('#plan_b').html('Your profit at 5 days advanced maturity '+DTM+' days - 5 day advanced maturity='+days+' days  <br> Your profit is '+result[1]+' ')
                    }
                    //$("#div_samount").show().html(" &nbsp; <b> S.Amount = </b> " + result);
                    obj.parentElement.nextElementSibling.textContent = "Rs." + numberFormate(Number(result[0]
                        .replaceAll(",", "")).toFixed(0)) + "/-"

                }

            });

        }

        // function CalculateAmountAdvMaturity(obj) {

        //     var price = obj.parentElement.children[3].value;

        //     var FV = obj.value;
        //     $.ajax({
        //         type: "Get",
        //         url: "{{ route('get_saving_plan_price_amount') }}",
        //         data: {
        //             'price': price,
        //             'FV': FV,
        //         },
        //         success: function(result) {
        //             // console.log("Response from server for : " + result);
        //             result = result.split('|');
        //             profitCal = result[0].replaceAll(",", "") - pp;
        //             percentage = profitCal * 0.125;
        //             percentage = profitCal - percentage;
        //             // pp = 0;
        //             obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.children[0]
        //                 .children[1].innerHTML = "Profit." + numberFormate(profitCal.toFixed(0)) +
        //                 "/- <br><span>*CGT @ 12.5 %</span> <br><span>Net Profit: " + numberFormate(percentage.toFixed(0)) +
        //                 "</span>";

        //         }

        //     });

        // }

        GetSavingPlan();

        function GetSavingPlan() {
            hideLoader();
            showLoader();
            $.ajax({
                type: "Get",
                url: "{{ route('saving_plan') }}",
                success: function(result) {
                    $("#ips_saving_plans_type").html(result);
                    hideLoader();
                    // console.log("Response from server : " + result);
                }
            });
        }

        function onlyNumber(event) {
            const ch = String.fromCharCode(event.which);
            if (!/[0-9]/.test(ch)) {
                event.preventDefault();
            }
        };

        function onIpsPlanChanged(e) {
            var values = e.value.split('|');
            var date = new Date();
            // Add five days to current date
            date.setDate(date.getDate() + parseInt(values[0]));
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();
            let format1 = (month + 1) + "/" + day + "/" + year;
            if (e.value) {
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.textContent = format1;
                e.parentElement.nextElementSibling.nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent =
                    '0';
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.children[0].disabled = false;
                // $("#ips_invest_amount_div").show()
            } else {
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.textContent =
                    '0';
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.nextElementSibling.textContent = '0';
                e.parentElement.nextElementSibling.children[0].disabled = true;
                // $("#ips_invest_amount_div").hide()
            }
        }

        function savingPlanOtp() {
            // document.cookie = "myClock=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/saving_plane_create;";
            valueCheck = $('.planCheckbox:checked').val();
            values = $("#ips_saving_plans_type").val().split('|');
            dmt = values[0];
            var day = 0;
            if (valueCheck == 5) {
                day = dmt - 5;
            } else {
                day = dmt;
            }
            var value = {
                redirect_route: 'saving_plane_create',
                days: day,
            };
            $.ajax({
                    type: 'GET',
                    url: "{{ route('saving_plane_pin') }}",
                    data: value,

                })
                .done(function(result) {
                    $('#exampleModalLabel').html('Saving Plan Submit Pin');
                    $('#modalbody').html(result);
                    $('#exampleModal').modal('show');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("Server not responding.....");
                });

        }

        function submitSavingPlanCreate() {
            document.getElementById("submit_saving_plan").click();
            showLoader();
        }
        var i = 1;

        function clone() {
            if (i == 3) {
                Swal.fire({
                    icon: 'error',
                    title: 'Alert',
                    text: "You can't add more then 3 rows",
                    confirmButtonColor: '#073f8a',
                })
                return true;
            }
            i++;

            // $("#cloneDivInvest").clone().insertAfter("#cloneDivInvest");\
            cloneDiv = $("#cloneDivInvest").clone();
            cloneDiv[0].children[2].children[0].disabled = true;
            cloneDiv[0].children[2].children[0].value = '';
            cloneDiv[0].children[2].children[2].value = '';
            cloneDiv[0].children[2].children[3].value = '';
            cloneDiv[0].children[3].textContent = '0';
            cloneDiv[0].children[4].textContent = '0';
            cloneDiv[0].children[5].textContent = '0';
            cloneDiv[0].children[6].textContent = '0';
            cloneDiv[0].children[7].textContent = '0';
            cloneDiv.insertAfter("#cloneDivInvest");

        }

        function removeDiv(obj) {
            if (i == 1) {
                Swal.fire({
                    icon: 'warning',
                    title: 'Alert',
                    text: "You can't remove the last row",
                    confirmButtonColor: '#073f8a',
                })
                return true;
            }
            obj.parentElement.parentElement.remove();
            i--;
        }
        $(function() {
            $("#sortable").sortable();
        });

        function profitCalculation(obj) {
            var todayInvested = parseInt(obj.parentElement.parentElement.parentElement.children[3].textContent.replace(
                /Rs.|,|\/-/gi, ''));
            var profit = parseInt(obj.parentElement.children[1].textContent.replace(
                /Profit.|WHT @ 15 % Net Profit:|,|\/-/gi, '').split('*')[1]);
            var total = +todayInvested + profit;
            obj.parentElement.parentElement.parentElement.children[5].textContent = new Intl.NumberFormat('en-IN', {
                // maximumSignificantDigits: 3
            }).format(total);
        }

        function storeTblValues() {
            var TableData = new Array();

            $('.SavingPlans_tbl tr').each(function(row, tr) {

                TableData[row] = {
                    "saving_plan": $(tr).find('.saving_plans_type :selected').val(),
                    "invest_amount": $(tr).find('.invest_amount').text(),
                    "maturity_date": $(tr).find('.maturity_date').text()
                }

            });
            TableData.shift();
            return TableData;
        }

        function validation() {
            tableDate = JSON.stringify(storeTblValues());
            $('#table_json').val(tableDate);
        }

        function numberFormate(value) {
            return new Intl.NumberFormat('en-US', {}).format(value)
        }

        function infoHowToUses() {
            localStorage.setItem("session_id", "{{ $sessionId }}");
            // localStorage.getItem("lastname");
            $.ajax({
                    type: 'GET',
                    url: "{{ route('info-how-to-use') }}",
                })
                .done(function(result) {
                    $('#exampleModalLabel').html('<h2>How To Use IPS - Saving Plan</h2>');
                    $('#modalbody').html(result);
                    $('#exampleModal').modal('show');
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert("Server not responding.....");
                });

        }
        var sessionId = localStorage.getItem("session_id");
        if (sessionId != "{{ $sessionId }}") {
            setTimeout(infoHowToUses, 3000);
        }

        $(".boxSavingPlan").hide();
        $('#SavingPlanChange').on('change', function() {
            $(".boxSavingPlan").hide();
            var demovalue = $(this).val();
            $("#" + demovalue).show();
        });
    </script>
@endsection('content')
