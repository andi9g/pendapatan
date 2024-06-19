
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <link rel="shortcut icon" href="img/sentralprintz.png"> --}}
    <title>Sentral Printz - @yield('judul')</title>
    @include('layouts.header')

    <style>
        .active {
            border-left: 5px solid #306bff;
            background: rgba(233, 233, 233, 0.507);
        }
        .rentang {
            padding-bottom: 75px;
        }

        .header {
            position: fixed;
            height: 50px;
            width: 100%;
            background: #1E90FF;
            z-index: 4;
        }
        table tr th {
            text-align: center !important;
        }
        .table tr td{
            padding: 3px 7px !important;
            text-align: left !important;
        }

        .bg-primary {
            background: #1E90FF !important;
        }

</style>

</head>

<body>


    <div class="header">
        {{-- <img src="{{ url('img/sentralprintz.png', []) }}" style="width:35px;height:35px" class=""> --}}
		<h3 class="text-white font-weight-bold float-left logo text-left float-left">Sentral Printz</h3>
		<form action="{{ route('logout', []) }}" method="post">
        @csrf
        <div class="logout">
            <button type="submit" class="badge badge-secondary rounded-lg border-0 mt-1">
                <i class="fa fa-sign-out"></i> Keluar
                {{-- <i class="fas fa-sign-out-alt float-right"></i>
                <p class="float-right logout">Logout</p> --}}
            </button>
        </div>

        </form>
		</a>
	</div>




    <div class="sidebar">
        <nav>
            <ul>
                <a href="{{ url('profil', []) }}">
                    <li class="rentang">
                        <img src="{{ url('gambar', [Auth::user()->gambar ?? 'user.png']) }}" class="img-fluid profile float-left rounded-circle" width="50px" height="50px">
                        <h5 class="admin">{{ Auth::user()->name }}</h5>
                        <div class="online online2">
                            <p class="float-right ontext">Online</p>
                            <div class="on float-right"></div>
                        </div>
                    </li>
                </a>
                <!-- fungsi slide -->
                <script>
                    $(document).ready(function () {
                        $("#flip").click(function () {
                            $("#panel").slideToggle("medium");
                            $("#panel2").slideToggle("medium");
                        });
                        $("#flip2").click(function () {
                            $("#panel3").slideToggle("medium");
                            $("#panel4").slideToggle("medium");
                        });
                    });
                </script>

                <a href="{{ url('home', []) }}" style="text-decoration: none;">
                    <li class="@yield('activedashboard')" style="">
                        <div>
                            <span class="fas fa-tachometer-alt"></span>
                            <span>Dashboard</span>
                        </div>
                    </li>
                </a>

                <!-- data -->
                <li class="klik @yield('activeharian')" id="flip" style="cursor:pointer;">
                    <div>
                        <span class="fas fa-database"></span>
                        <span>Data Harian</span>
                        <i class="fas fa-caret-right float-right" style="line-height: 20px;"></i>
                    </div>
                </li>

                <a href="{{ url('pemasukan', []) }}" class="linkAktif">
                    <li class="@yield('activepemasukan')" id="panel" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-file-invoice-dollar"></i></span>
                            <span>Data Pemasukkan</span>
                        </div>
                    </li>
                </a>
                <a href="{{ url('barang', []) }}" class="linkAktif">
                    <li class="@yield('activebarang')" id="panel2" style="display: none;">
                        <div style="margin-left: 20px;">
                            <span><i class="fas fa-database"></i></span>
                            <span>Data Barang</span>
                        </div>
                    </li>
                </a>

                <a href="{{ url('kategori', []) }}" style="text-decoration: none;">
                    <li class="@yield('activekategori')" style="">
                        <div>
                            <span class="fas fa-wrench"></span>
                            <span>Kategori Barang</span>
                        </div>
                    </li>
                </a>
                <!-- data -->



                <!-- laporan -->
                <a href="laporan" style="text-decoration: none;">
                    <li class="@yield('activelaporan')">
                        <div>
                            <span><i class="fas fa-clipboard-list"></i></span>
                            <span>Laporan</span>
                        </div>
                    </li>
                </a>

                <!-- change icon -->
                <script>
                    $(".klik").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                    $(".klik2").click(function () {
                        $(this).find('i').toggleClass('fa-caret-up fa-caret-right');
                        if ($(".klik2").not(this).find("i").hasClass("fa-caret-right")) {
                            $(".klik2").not(this).find("i").toggleClass('fa-caret-up fa-caret-right');
                        }
                    });
                </script>
                <!-- change icon -->
            </ul>
        </nav>
    </div>

    <div class="main-content khusus">
        <div class="konten khusus2">
            <div class="konten_dalem khusus3">
                <h2 class="heade" style="color: #4b4f58;">@yield('judul')</h2>
                <hr style="margin-top: -2px;">
                <div class="container-fluid" id="container" style="border: none;">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>












    @include('layouts.footer')
    @include('sweetalert::alert')
    @yield('myScript')
</body>

</html>
