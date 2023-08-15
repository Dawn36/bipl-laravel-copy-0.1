@extends('layouts.main')

@section('content')
    <style>
        .swal-button {
            background-color: #082c5b;

        }

        .disabled-link {
            pointer-events: none;
        }

        .tooltip .tooltip-inner {
            background-color: rgb(248, 176, 176);
            color: black;
            padding: 5px;
        }
    </style>
    <main>
        <div class="authentication-left-panel d-none d-lg-block"></div>
        <div class="container mt-5">
            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed  theme-gradient2 heading-bar" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <h1 class="h4 text-white" style="text-align:left!important">IPS Saving Plans - GoP Market
                                Treasury Bills </h1>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse " aria-labelledby="headingOne"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <hr />
                            <div class="row">
                                <div class="col-12">
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
                                    <div class="table-responsive">
                                        <table class="table border-0 m-0 portfolio_tbl">
                                            <thead>
                                                <tr>
                                                    <th>Maturity Date</th>
                                                    <th>DTM</th>
                                                    <th>Units</th>
                                                    <th>Invested Amount</th>
                                                    <th>Selling Range</th>
                                                    <th>AKD Bid Yield</th>
                                                    <th>Amount</th>
                                                    <th>Profit</th>
                                                    <th>Sell</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for ($i = 0; $i < count($data); $i++)
                                                    @php
                                                        $unit = ceil($data[$i]['Face_Value'] / 5000);
                                                        $diff = CalculateDTM(date('Y-m-d'), $data[$i]['Maturity_Date']);
                                                    @endphp
                                                    <tr>
                                                        <td>{{ date('d/M/Y', strtotime($data[$i]['Maturity_Date'])) }}</td>
                                                        <td>{{ $diff }}</td>
                                                        <td id='{{ $unit }}'>{{ number_format($unit) }}</td>
                                                        <td id="{{ $data[$i]['Invested_Amount'] }}">
                                                            {{ number_format($data[$i]['Invested_Amount']) }}</td>
                                                        <td>
                                                            <input type="range" class="form-range slider" value="0"
                                                                min="0" max="{{ $unit }}" id="customRange2"
                                                                style="background-size: 0% 100%;"
                                                                onchange="calCulateRate(this,{{ $data[$i]['AKD_Bid_Price'] }})">
                                                            <p>Value: <span id="demo">0</span></p>
                                                        </td>
                                                        <td>{{ $data[$i]['AKD_Bid_Price'] }} %</td>
                                                        <td>0.00</td>
                                                        <td>0.00</td>
                                                        @php $issueDate=Date('Y-m-d',strtotime($data[$i]['Issue_date'])) @endphp 
                                                        <td>
                                                            <a href="#" class="btn sell-btn blue-btn"
                                                                data-bs-toggle="tooltip" data-bs-placement="right"
                                                                data-bs-custom-class="custom-tooltip"
                                                                data-bs-title="Negative profit is due to duration as well as secondary market yields resulting in a capital loss. We recommend you hold your investment till maturity. If you still want to continue click sell"
                                                                onclick="sell(this,'{{ $data[$i]['Scheme_Code'] }}','{{ $diff }}','{{ $issueDate }}')"
                                                                style="box-shadow: 3px 4px 5px rgb(0 0 0 / 30%);">
                                                                SELL</a>
                                                        </td>
                                                    </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning d-flex align-items-center col-lg-10 m-auto mb-4" role="alert">
                            <i class="icons bi bi-info-square me-3"></i>
                            <div>
                                <ul class="m-0" style="text-align: left;">
                                    <li>
                                        Each invested amount has been converted to units at a denomination/face
                                        value of PKR
                                        5000.
                                    </li>
                                    <li>
                                        Scheduled Maturity Profit is subject to 15% WHT deducted at source
                                    </li>
                                    <li>WHT = SBP deducts 15 % Withholding Tax at source based on primary dealer
                                        or issue price
                                    </li>
                                    <li>Advance Schedule Maturity Profit may be subject to taxes based on
                                        voluntary assessment
                                    </li>
                                    <li>CGT = Capital Gain Tax application and submission is based on
                                        self-assessment basis if
                                        sold before Schedule Maturity. We have assumed CGT @ 12.5% for filers
                                    </li>
                                    <li>You can sell your investment at any time 5 days before Schedule
                                        Maturity. </li>
                                    <li>Please note that you may realize a capital loss if sold before maturity.
                                        This depends on
                                        Interest Rate Movements in the secondary market and spreads. </li>
                                    <li>We recommend that you check the portfolio to see when your investments
                                        have become
                                        profitable</li>
                                    <li><b>We recommend that you hold the investment till its designated
                                            maturity</b></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button  collapsed theme-gradient2 heading-bar" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <h1 class="h4 text-white" style="text-align:left!important">IPS Saving Plans - GoP IJara Sukuk</h1>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse watermark" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body box">
                            <hr />
                            <div class="row">
                                <div class="col-12">
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
                                    <div class="table-responsive">
                                        <table class="table border-0 m-0 portfolio_tbl">
                                            <thead>
                                                <tr>
                                                    <th>Coupon Maturity</th>
                                                    <th>DTM</th>
                                                    <th>Units</th>
                                                    <th>Invested Amount</th>
                                                    <th>Selling Range</th>
                                                    <th>AKD Bid Price</th>
                                                    <th>Amount</th>
                                                    <th>Profit</th>
                                                    <th>Sell</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td ></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="alert alert-warning d-flex align-items-center col-lg-10 m-auto mb-4" role="alert">
                            <i class="icons bi bi-info-square me-3"></i>
                            <div>
                                <ul class="m-0" style="text-align: left;">
                                    <li>
                                       
                                    </li>
                                    <li>
                                        
                                    </li>
                                    <li>
                                    </li>
                                    <li>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="theme-gradient2 heading-bar">
                <h1 class="h4 text-white" style="text-align:left!important">IPS Saving Plans - GoP Market Treasury Bills
                </h1>
            </div>
            <hr />
            <div class="row">
                <div class="col-12">
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
                    <div class="table-responsive">
                        <table class="table border-0 m-0 portfolio_tbl">
                            <thead>
                                <tr>
                                    <th>Maturity Date</th>
                                    <th>DTM</th>
                                    <th>Units</th>
                                    <th>Invested Amount</th>
                                    <th>Selling Range</th>
                                    <th>AKD Bid Yield</th>
                                    <th>Amount</th>
                                    <th>Profit</th>
                                    <th>Sell</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 0; $i < count($data); $i++)
                                    @php
                                        $unit = ceil($data[$i]['Face_Value'] / 5000);
                                        $diff = CalculateDTM(date('Y-m-d'), $data[$i]['Maturity_Date']);
                                    @endphp
                                    <tr>
                                        <td>{{ date('Y-M-d', strtotime($data[$i]['Maturity_Date'])) }}</td>
                                        <td>{{ $diff }}</td>
                                        <td id='{{ $unit }}'>{{ number_format($unit) }}</td>
                                        <td id="{{ $data[$i]['Invested_Amount'] }}">
                                            {{ number_format($data[$i]['Invested_Amount']) }}</td>
                                        <td>
                                            <input type="range" class="form-range slider" value="0" min="0"
                                                max="{{ $unit }}" id="customRange2"
                                                style="background-size: 0% 100%;"
                                                onchange="calCulateRate(this,{{ $data[$i]['AKD_Bid_Price'] }})">
                                            <p>Value: <span id="demo">0</span></p>
                                        </td>
                                        <td>{{ $data[$i]['AKD_Bid_Price'] }} %</td>
                                        <td>0.00</td>
                                        <td>0.00</td>
                                        <td>
                                            <a href="#" class="btn sell-btn blue-btn" data-bs-toggle="tooltip"
                                                data-bs-placement="right" data-bs-custom-class="custom-tooltip"
                                                data-bs-title="Negative profit is due to duration as well as secondary market yields resulting in a capital loss. We recommend you hold your investment till maturity. If you still want to continue click sell"
                                                onclick="sell(this,'{{ $data[$i]['Scheme_Code'] }}','{{ $diff }}')"
                                                style="box-shadow: 3px 4px 5px rgb(0 0 0 / 30%);">
                                                SELL</a>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center my-5">
                        <a href="{{ route('saving_plane_create') }}"
                            class="btn btn-rounded theme-btn pills-button col-10 col-lg-2 col-sm-6"><i
                                class="icons left-arrow-icon me-3"></i>Back</a>
                    </div>

                    <div class="alert alert-warning d-flex align-items-center col-lg-10 m-auto" role="alert">
                        <i class="icons bi bi-info-square me-3"></i>
                        <div>
                            <ul class="m-0" style="text-align: left;">
                                <li>
                                    Each invested amount has been converted to units at a denomination/face value of PKR
                                    5000.
                                </li>
                                <li>
                                    Scheduled Maturity Profit is subject to 15% WHT deducted at source
                                </li>
                                <li>WHT = SBP deducts 15 % Withholding Tax at source based on primary dealer or issue price
                                </li>
                                <li>Advance Schedule Maturity Profit may be subject to taxes based on voluntary assessment
                                </li>
                                <li>CGT = Capital Gain Tax application and submission is based on self-assessment basis if
                                    sold before Schedule Maturity. We have assumed CGT @ 12.5% for filers</li>
                                <li>You can sell your investment at any time 5 days before Schedule Maturity. </li>
                                <li>Please note that you may realize a capital loss if sold before maturity. This depends on
                                    Interest Rate Movements in the secondary market and spreads. </li>
                                <li>We recommend that you check the portfolio to see when your investments have become
                                    profitable</li>
                                <li><b>We recommend that you hold the investment till its designated maturity</b></li>
                            </ul>
                        </div>
                    </div>

                    <x-saving-plan-card></x-saving-plan-card>
                    <br />
                </div>
            </div> --}}
            <div class="text-center my-5">
                <a href="{{ route('saving_plane_create') }}"
                    class="btn btn-rounded theme-btn pills-button col-10 col-lg-2 col-sm-6"><i
                        class="icons left-arrow-icon me-3"></i>Back</a>
            </div>

            
            <x-saving-plan-card></x-saving-plan-card>
            <br />
        </div>
        <!-- /.container -->
    </main>
    <form id='saving_plan_create' class="requires-validation" novalidate method="POST"
        action="{{ route('saving_plan_index') }}">
        @csrf
        <input id='akd_bid_price' name="akd_bid_price" value="" hidden required />
        <input id='scheme_code' name="scheme_code" value="" hidden required />
        <input id='selling_amount' name="selling_amount" value="" hidden required />
        <input id='issue_date' name="issue_date" value="" hidden required />
        <input id='dtm' name="dtm" value="" hidden required />
        <input id='unit' name="unit" value="" hidden required />
        <input hidden name="pin" id="user_pin" value="" />
        <input id='submit_saving_plan_index' type="submit" name="submit" value="Save" hidden />
    </form>
    <script>
        var akdBidPrice = 0;
        var sellingAmount = 0;

        function calCulateRate(obj, rate) {
            obj.nextElementSibling.children.demo.innerHTML = obj.value;
            range = parseInt(obj.value);
            dmt = parseInt(obj.parentElement.previousElementSibling.previousElementSibling.previousElementSibling
                .textContent);
            unit = parseInt(obj.parentElement.previousElementSibling.previousElementSibling.id);
            // console.log('unit',unit);
            investedAmount = parseInt(obj.parentElement.previousElementSibling.id);
            investedAmount = (investedAmount / unit);
            investedAmount = (investedAmount * range);
            // console.log('inverset',investedAmount);
            // rate = rate / 100;

            price = 100 / (((rate * dmt) / 36500) + 1); // round upto 4
            mustInvest = (range * 5000) * price / 100;
            profit = mustInvest - investedAmount;
            // console.log('must_invest',mustInvest);
            // console.log('profit',mustInvest-investedAmount);
            //amount=range*5000*akd;
            // obj.parentElement.nextElementSibling.textContent= new Intl.NumberFormat().format(akd.toFixed(2)); 
            if (profit < 0) {
                tooltip = new bootstrap.Tooltip(obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.children[0])
                obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.children[0]
                    .classList.add("red-btn");
                obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.children[0]
                    .classList.remove("blue-btn");
            } else {
                tooltip = new bootstrap.Tooltip(obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.children[0])
                tooltip.disable(obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling
                    .nextElementSibling.children[0]);
                obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.children[0]
                    .classList.add("blue-btn");
                obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.nextElementSibling.children[0]
                    .classList.remove("red-btn");
            }
            obj.parentElement.nextElementSibling.nextElementSibling.textContent = new Intl.NumberFormat('en-US', {
                // minimumIntegerDigits: 3
            }).format(mustInvest
                .toFixed(2));
            obj.parentElement.nextElementSibling.nextElementSibling.nextElementSibling.textContent = new Intl
                .NumberFormat('en-US', {
                    // minimumIntegerDigits: 3
                })
                .format(profit.toFixed(2));

        }

        function sell(obj, schemeCode, dtm, issueDate) {
            unit = obj.parentElement.previousElementSibling.previousElementSibling.previousElementSibling
                .previousElementSibling.children[0].value;
            sellingRange = obj.parentElement.previousElementSibling.previousElementSibling.previousElementSibling
                .previousElementSibling.children[0].value;
            if (parseInt(dtm) <= 3) {
                swal({
                    text: "Please note that you can choose to sell your investment at anytime before 3 Days to Maturity",
                    confirmButtonColor: '#8CD4F5',
                    type: "danger"
                }).then(okay => {

                });
                return true;
            }
            if (sellingRange > 0) {
                $('#scheme_code').val(schemeCode);
                $('#dtm').val(dtm);
                $('#issue_date').val(issueDate);
                $('#unit').val(unit);
                akdBidPrice = obj.parentElement.previousElementSibling.previousElementSibling.previousElementSibling
                    .innerHTML.replaceAll(" %", "");
                sellingAmount = obj.parentElement.previousElementSibling.previousElementSibling.nextElementSibling
                    .previousElementSibling.innerHTML;
                profit = obj.parentElement.previousElementSibling.innerHTML;
                savingPlanIndexOtp();
            } else {
                swal({
                    text: "Selling range can't be 0",
                    confirmButtonColor: '#8CD4F5',
                    type: "danger"
                }).then(okay => {

                });
            }
        }

        function savingPlanIndexOtp() {
            //document.cookie = "myClock=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/saving_plane_index;";
            var value = {
                redirect_route: 'saving_plan_index',
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
                // .fail(function(jqXHR, ajaxOptions, thrownError) {
                //     alert("Server not responding.....");
                // });
        }

        function submitSavingPlanCreate() {
            document.getElementById('akd_bid_price').value = akdBidPrice;
            document.getElementById('selling_amount').value = sellingAmount;
            document.getElementById("submit_saving_plan_index").click();
            showLoader();
        }
        const rangeInputs = document.querySelectorAll('input[type="range"]');
        //const numberInput = document.querySelector('input[type="number"]')

        function handleInputChange(e) {
            let target = e.target;
            if (e.target.type !== "range") {
                target = document.getElementById("range");
            }
            const min = target.min;
            const max = target.max;
            const val = target.value;

            target.style.backgroundSize =
                ((val - min) * 100) / (max - min) + "% 100%";
        }

        rangeInputs.forEach((input) => {
            input.addEventListener("input", handleInputChange);
        });
    </script>
@endsection('content')
