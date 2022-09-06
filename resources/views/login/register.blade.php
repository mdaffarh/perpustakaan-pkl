<!DOCTYPE html>
<html>
    <head>
    	<!-- Font Awesome -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet"/>

        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet"/>

        <!-- MDB -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet"/>

        <!-- costum css -->
        <link rel="stylesheet" type="text/css" href="{{ asset('/') }}assets/css/register.css">
    	<title></title>
    </head>
    <body>
        @include('sweetalert::alert')
    	<a href="{{ url()->previous() }}" style="font-size: 32px;padding-left: 15px;color: white;">
    		<i class="fa-solid fa-arrow-left"></i>
    	</a>
        <div class="card">
            <div class="card-body">

                <!-- Pills navs -->
                <ul class="nav nav-pills nav-justified mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="tab-login" data-mdb-toggle="pill" href="#pills-login" role="tab" aria-controls="pills-login" aria-selected="true">Login</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register-member" data-mdb-toggle="pill" href="#pills-register-member" role="tab" aria-controls="pills-register-member" aria-selected="false">Register Anggota</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" id="tab-register-staff" data-mdb-toggle="pill" href="#pills-register-staff" role="tab" aria-controls="pills-register-staff" aria-selected="false">Register Staff</a>
                    </li>
                </ul>
                <!-- Pills navs -->

                <!-- Pills content -->
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="pills-login" role="tabpanel" aria-labelledby="tab-login">
                        <form action="/login" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-sm-8">
                                    <img src="{{ asset('/') }}assets/img/poster.png" width="100%">
                                </div>
                                <div class="col-sm-4">
                                    <!-- Email input -->
                                    <div class="form-outline mb-4">
                                        <input autofocus id="username" type="text" class="form-control @error('username') is-invalid @enderror" placeholder="username" name="username" value="{{ old('username') }}">
                                        @error('username')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                        <label class="form-label" for="username">Username</label>
                                    </div>

                                    <!-- Password input -->
                                    <div class="form-outline mb-4">
                                        <input type="password" name="password" id="password" class="form-control" />
                                        <label class="form-label" for="password">Password</label>
                                    </div>

                                    <!-- Submit button -->
                                    <button type="submit" class="btn btn-primary btn-block mb-4">Login</button>

                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <!-- TAB REGISTER MEMBER -->
                    <div class="tab-pane fade" id="pills-register-member" role="tabpanel" aria-labelledby="tab-register-member">
                        <form action="/transaction/member-registrations/store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center mb-3">
                                <p>Register Anggota</p>
                                <hr>
                            </div>

                            <!-- Nis input -->
                            <div class="form-outline mb-4">
                                <input type="number" id="nis" name="nis" class="form-control" />
                                <label class="form-label" for="nis">NIS</label>
                            </div>

                            <div class="row g-3 mb-4">
                                <div class="col-sm-6">
                                    <div class="form-outline">
                                        <input type="text" name="nama" id="nama-anggota" class="form-control" />
                                        <label class="form-label" for="nama-anggota">Nama</label>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-outline">
                                        <input type="number" name="kelas" id="kelas" class="form-control" />
                                        <label class="form-label" for="kelas">Kelas</label>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="form-outline">
                                        <input type="text" name="jurusan" id="jurusan" class="form-control" />
                                        <label class="form-label" for="jurusan">Jurusan</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Gender input -->
                            <div class="mb-4">
                                <select id="gender" name="jenis_kelamin" class="form-select">
                                    <option disabled>Jenis Kelamin</option>
                                    <option value="Laki-Laki">Laki-Laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select>
                            </div>

                            <!-- ttl input -->
                            <div class="form-outline mb-4">
                                <input type="date" id="ttl-anggota" class="form-control" name="tanggal_lahir" />
                                <label class="form-label" for="ttl-anggota">tanggal Lahir</label>
                            </div>

                            <!-- NO Telp input -->
                            <div class="form-outline mb-4">
                                <input type="number" id="no" class="form-control" name="nomor_telepon" />
                                <label class="form-label" for="no">No Telp</label>
                            </div>

                            <!-- Alamat input -->
                            <div class="mb-4">
                                <textarea placeholder="alamat" name="alamat" class="form-control"></textarea>
                            </div>


                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText"/>
                                <label class="form-check-label" for="registerCheck">
                                I have read and agree to the terms
                                </label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
                        </form>
                    </div>

                    <!-- TAB REGISTER STAFF -->
                    <div class="tab-pane fade" id="pills-register-staff" role="tabpanel" aria-labelledby="tab-register-staff">
                        <form action="/transaction/staff-registrations/store" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="text-center mb-3">
                                <p>Register Staff</p>
                                <hr>
                            </div>

                            <!-- nip input -->
                            <div class="form-outline mb-4">
                                <input type="number" name="nip" id="nip" class="form-control" />
                                <label class="form-label" for="nip">NIP</label>
                            </div>

                            <!-- nip input -->
                            <div class="form-outline mb-4">
                                <input type="text" name="nama" id="nama-staff" class="form-control" />
                                <label class="form-label" for="nama-staff">Nama</label>
                            </div>

                            <!-- email input -->
                            <div class="input-group mb-3">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                                <span class="input-group-text"><i class="fa-solid fa-envelope"></i></span>
                            </div>

                            <!-- Gender input -->
                            <div class="mb-4">
                                <select id="gender" name="jenis_kelamin" class="form-select">
                                    <option disabled>Jenis Kelamin</option>
                                    <option>Laki-Laki</option>
                                    <option>Perempuan</option>
                                </select>
                            </div>

                            <!-- ttl input -->
                            <div class="form-outline mb-4">
                                <input type="date" name="tanggal_lahir" id="ttl-staff" class="form-control" />
                                <label class="form-label" for="ttl-staff">tanggal Lahir</label>
                            </div>

                            <!-- no telp input -->
                            <div class="form-outline mb-4">
                                <input type="number" name="nomor_telepon" id="no-staff" class="form-control" />
                                <label class="form-label" for="no-staff">No.Telp</label>
                            </div>

                            <!-- Alamat input -->
                            <div class="mb-4">
                                <textarea name="alamat" placeholder="alamat" class="form-control"></textarea>
                            </div>


                            <!-- Checkbox -->
                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2" type="checkbox" value="" id="registerCheck" checked aria-describedby="registerCheckHelpText" required="" />
                                <label class="form-check-label" for="registerCheck">
                                I have read and agree to the terms
                                </label>
                            </div>

                            <!-- Submit button -->
                            <button type="submit" class="btn btn-primary btn-block mb-3">Sign in</button>
                        </form>
                    </div>
                </div>
                <!-- Pills content -->

            </div>
        </div>
    	
    <!-- MDB -->
    <script
      type="text/javascript"
      src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"
    ></script>
    </body>
</html>