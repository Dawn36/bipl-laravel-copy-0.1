<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="AKD - Security Limited">
    <title>AKD - Security Limited</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="shortcut icon" href="{{ asset('theme/assets/images/AKD-LOGO.png') }}" />
    <link href="{{ asset('theme/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('theme/assets/css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('theme/assets/css/dropdownmenu.css') }}" rel="stylesheet">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.2/jquery.min.js"></script>
</head>

<body class="text-center">
    <div id="loader" class="loader"></div>
    <header>
        <nav class="navbar navbar-expand navbar-light fixed-top bg-white p-0 theme-gradient" style="height: 100px;">
            <div class="container-fluid p-0 h-100">
                <a class="navbar-brand  col-lg-2 col-4 me-0 " href="{{ route('saving_plane_create') }}"><img
                        src="{{ asset('theme/assets/images/AKD-LOGO.png') }}">
                    <span>AKD Securities Limited</span></a>
                <h1 class="header-title h3 d-none d-lg-block">
                    IPS Saving Plans
                </h1>
                <form action="{{ route('logout') }}" id='logout-form' method="POST" style="display: none;">
                    @csrf
                </form>
                {{-- <div class=" theme-gradient h-100 col-lg-5 col-8 navbar-block" id=""> --}}
                {{-- Primary Action dropdown --}}
                <ul class="navbar-nav ms-auto mb-2 mb-md-0  pe-lg-5 ">
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="{{ route('saving_plan_index') }}" onclick="showLoader()">
                            Portfolio
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" data-bs-toggle="dropdown">
                            Primary Auction
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="openModalBox('IPS Auction Bid','{{ route('auction-bid.create') }}')">NON
                                    Competitive Bid Form</a>
                            </li>

                            <li><a class="dropdown-item" href="#">Auction Calendar &raquo; </a>
                                <ul class="submenu submenu-left dropdown-menu">
                                    <li><a href="https://www.sbp.org.pk/ecodata/auction-treasurybills.pdf"
                                            target="_blank" class="dropdown-item">Auction Treasury Bills</a></li>
                                    <li><a href="https://www.sbp.org.pk/ecodata/Auction-Sukuk.pdf" target="_blank"
                                            class="dropdown-item">Auction Sukuk</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link " href="#" data-bs-toggle="dropdown">
                            <i class="icons chat-icon"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="#">MTBs &raquo; </a>
                                <ul class="submenu submenu-left dropdown-menu">
                                    <li><a class="dropdown-item" href="#"
                                            onclick="openModalBox('Our Saving Plan','{{ route('our-saving-plan') }}')">Our
                                            Saving Plan</a></li>
                                    <li><a class="dropdown-item"
                                            href="#"onclick="openModalBox('How To Invest','{{ route('how-to-invest') }}')">How
                                            To Invest</a></li>
                                    <li><a class="dropdown-item"
                                            href="#"onclick="openModalBox('Viewing Your Profile','{{ route('viewing-yor-profile') }}')">Viewing
                                            Your Profile</a></li>
                                    <li><a class="dropdown-item"
                                            href="#"onclick="openModalBox('Selling Your Investment Before Maturity','{{ route('selling-your-investment') }}')">Selling
                                            Your Investment</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" href="#">GIS &raquo; </a>
                                <ul class="submenu submenu-left dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Coming Soon</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item dropdown">
                        <a class="nav-link  " href="#" data-bs-toggle="dropdown"><i
                                class="icons chat-icon"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a class="dropdown-item" href="#"
                                    onclick="openModalBox('Our Saving Plan','{{ route('our-saving-plan') }}')">Our
                                    Saving Plan</a></li>
                            <li><a class="dropdown-item"
                                    href="#"onclick="openModalBox('How To Invest','{{ route('how-to-invest') }}')">How
                                    To Invest</a></li>
                            <li><a class="dropdown-item"
                                    href="#"onclick="openModalBox('Viewing Your Profile','{{ route('viewing-yor-profile') }}')">Viewing
                                    Your Profile</a></li>
                            <li><a class="dropdown-item"
                                    href="#"onclick="openModalBox('Selling Your Investment Before Maturity','{{ route('selling-your-investment') }}')">Selling
                                    Your Investment</a></li>
                        </ul>
                    </li> --}}
                    @php
                        $data = Session::get('data');
                    @endphp
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            {{-- <img src="https://github.com/mdo.png" alt="mdo" width="24" height="24" class="rounded-circle me-1"> --}}
                            {{ $data['Client_Name'] }}
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Activity Report</a></li>
                            <li><a class="dropdown-item" href="#">Cash ledger</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Sign
                                    Out</a></li>
                        </ul>
                    </li>
                    {{-- <li class="nav-item">
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="nav-link ">Sign Out</a>
                    </li> --}}
                </ul>

                {{-- </div> --}}
            </div>
        </nav>
        <style>
            /* width */
            ::-webkit-scrollbar {
                width: 10px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
                box-shadow: inset 0 0 5px #d5d5d6;
                border-radius: 10px;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
                background: #4061a6;
                border-radius: 10px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #6b80aa;
            }

            .watermark {
                position: relative;
                display: block;
                opacity: 0.2;
                pointer-events: none;
            }

            .watermark .box::before {
                font-family: "Comic Sans MS";
                content: "Coming Soon";
                position: absolute;
                margin-left: -17rem;
                font-weight: bold;
                font-size: 100px;
            }
        </style>
    </header>
    <script>
        function showLoader() {
            $('#loader').addClass('show');
        }

        function hideLoader() {
            $('#loader').removeClass('show');
        }
        if (document.readyState == 'loading') {
            showLoader();
        }
    </script>
    {{-- <header class="py-3 mb-2 border-bottom border-5 theme-border">
        <div class="container-fluid d-flex flex-wrap justify-content-between">
            <a href="{{ route('login') }}"
                class="d-flex align-items-center mb-3 mb-lg-0 me-lg-auto text-dark text-decoration-none">
                <svg class="brand-icon me-2" width="135" height="62">
                    <use xlink:href="#bootstrap" />
                </svg>
            </a>
            @if (!Session::has('data'))
                <ul class="nav">
                    <li class="nav-item">Join us? &nbsp;<a href="{{ route('login') }}"
                            class="px-4 py-1 btn btn-outline-dark">Sign up</a></li>
                </ul>
            @else
                <form action="{{ route('logout') }}" id='logout-form' method="POST" style="display: none;">
                    @csrf
                </form>
                <ul class="nav">
                    <li class="nav-item"><a href="{{ route('logout') }}" class="px-4 py-1 btn btn-outline-dark"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Sign Out
                        </a></li>
                </ul>
            @endif
        </div>
    </header> --}}

    <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable scrollbar" role="document">
            <div class="modal-content">
                <div class="modal-header theme-gradient" style="justify-content: center;">
                    <div class="col-11">
                        <h1 class="modal-title h4 text-white" id="exampleModalLabel">New message</h1>
                    </div>
                    <div class="col-1">
                        <button type="button" class="btn-close close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close">
                        </button>
                    </div>
                </div>
                <div class="modal-body" id='modalbody'>

                </div>

            </div>
        </div>
    </div>
