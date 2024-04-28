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
                            <form method="POST" action="{{ route('register.action') }}">
                                @csrf
                                <div class="form-group mb-4">
                                    <label for="name">Name</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input Name" name="name" value="{{ old('name') }}"> <!-- Tambahkan 'value="{{ old('name') }}"' untuk mempertahankan nilai saat validasi gagal -->
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="username">Username</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Input username" name="username" value="{{ old('username') }}"> <!-- Tambahkan 'value="{{ old('username') }}"' untuk mempertahankan nilai saat validasi gagal -->
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="role">Role</label>
                                    <select class="form-control" name="role">
                                        <option value="admin">Admin</option>
                                        <option value="manager">Manager</option>
                                        <option value="staff">Staff</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="division">Division</label>
                                    <select class="form-control" name="division">
                                        <option value="ADMIN">Admin</option>
                                        <option value="PRODUCT ENGINEERING">Product Engineering</option>
                                        <option value="PRODUCT DESIGN">Product Design</option>
                                    </select>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="email">Email</label>
                                    <div class="input-group">
                                        <input type="email" class="form-control" placeholder="Input Email" name="email" value="{{ old('email') }}"> <!-- Tambahkan 'value="{{ old('email') }}"' untuk mempertahankan nilai saat validasi gagal -->
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Input Password" name="password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirm">Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation"> <!-- Ubah nama input menjadi 'password_confirmation' untuk memenuhi aturan 'confirmed' -->
                                    </div>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary w-100 my-4 mb-2" id="register-btn">Register</button>
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

<script>
    function capitalizeFirstLetter(input) {
        let words = input.value.split(' ');

        for (let i = 0; i < words.length; i++) {
            words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
        }
        input.value = words.join(' ');
    }
</script>