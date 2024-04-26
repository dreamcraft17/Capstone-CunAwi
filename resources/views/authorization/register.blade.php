
<head>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Rubik&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>
    <link rel="stylesheet" href="argon/assets/css/argon-dashboard.css">
    <link rel="stylesheet" href="argon/assets/css/font-awesome.min.css">
    <style>
        body {
        overflow-x: hidden;
        margin: 0;
        padding: 0;
        }

        main {
            margin-top: -450px;
        }
    </style>
</head>

<body>
    <svg viewBox="0 0 500 200">
    </svg>
    <main class="main-content">
        <div class="container">
            <div class="row justify-content-center align-items-center mx-auto">
                <div class="col-xl-4 col-lg-5 ml-md-5">
                    <div class="card z-index-0 shadow p-3 mb-5">
                        <div class="text-center">
                            <h5 style="">CUNAWI</h5>
                            <h5 class="mt-1 text-primary">REGISTER</h5>
                        </div>
                        <div class="card-body">
                                <div class="form-group mb-4">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Input Email" name="email" />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Input Password">
                                    </div>
                                    {{-- @if ($errors->has('password'))<div class="invalid-feedback">{{ $errors->first('password') }}</div>@endif --}}
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Name" />
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email">ID</label>
                                    <div class="input-group">
                                        <input type="ID" class="form-control" placeholder="Input ID"/>
                                    </div>
                                </div>
                                 <div class="text-center">
                                    <button type="submit" name="submit" class="btn btn-primary w-100 my-4 mb-2" id="login-btn">Register</button>
                                    <p class="mt-1 text-secondary" style="font-size: 14px;">Already have an account? <a href="{{ route('login') }}" class="text-info">Login</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>