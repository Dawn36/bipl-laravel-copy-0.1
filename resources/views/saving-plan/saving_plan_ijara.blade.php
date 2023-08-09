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
            <div class="theme-gradient2 heading-bar">
                <h1 class="h4 text-white" style="text-align:left!important">IPS Saving Plans - GoP IJara Sukuk </h1>
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
            </div>
        </div>
        <!-- /.container -->
    </main>
@endsection('content')
