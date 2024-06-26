<style>
    .tombolback {
        margin: 0px;
        background-color: #568df2 !important;
        color: white !important;
        border: solid 2px white !important;
    }

    .tombolforward {
        margin: 0px;
        background-color: #3d6bce !important;
        color: white !important;
        border: solid 2px white !important;
    }
</style>

<!-- Navbar -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl
        {{ str_contains(Request::url(), 'virtual-reality') == true ? ' mt-3 mx-3 bg-primary' : '' }}"
    id="navbarBlur" data-scroll="false">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <div class="mt-2 mb-2">
                <button class="btn btn-round tombolback" id="backButton" onclick="goBack()"><i class="fa fa-chevron-left"
                        aria-hidden="true"></i></button>
                <button class="btn btn-round tombolforward" id="forwardButton" onclick="goForward()"><i
                        class="fa fa-chevron-right" aria-hidden="true"></i></button>
            </div>
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
                <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ $title }}</li>
            </ol>
            <h6 class="font-weight-bolder text-white mb-0">{{ $title }}</h6>
        </nav>

        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group">
                    <a href="{{ route('profile') }}" class="btn btn-dark rubik-font"> Profile </a>
                </div>
            </div>
            <ul class="navbar-nav mt-3 justify-content-end">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-dark rubik-font">Log Out</button>
                </form>

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<script>
    function goBack() {
        history.go(-1);
    }

    function goForward() {
        history.go(1);
    }
</script>
