{{-- Pilihan New User --}}
<div id="modal_choice_user" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white d-flex justify-content-between">
                <h6 class="modal-title">Pilih Tipe User Baru</h6>
                <button type="button" id="btn-close-doc" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light">
                <div class="row justify-content-center">
                    <div class="col-md-6 mb-3">
                        <div class="card text-center p-4">
                            <i class="fas fa-user-graduate fa-3x mb-3 text-dark"></i>
                            <h5 class="card-title">Siswa</h5>
                            <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#modal_add_siswa">Daftar</a>                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="card text-center p-4">
                            <i class="fas fa-chalkboard-teacher fa-3x mb-3 text-dark"></i>
                            <h5 class="card-title">Tenaga Pendidik</h5>
                            <a href="#" class="btn btn-warning">Daftar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal New User as Siswa --}}
<div id="modal_add_siswa" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header text-white bg-warning">
                <h6 class="modal-title">Tambah User Siswa</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-add-user-siswa" method="post">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" name="type_save" id="type_save" value="">
                     <div class="row">
                        <div class="col-lg-6 col-12 pall">
                            <div class=" border-round">
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span>NISN:</label>
                                    <input type="number" class="form-control" name="nisn" id="nisn" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span>Nama Lengkap:</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label><span class="text-danger">*</span> Kelas:</label>
                                    <select class="form-control form-select" id="select_kelas" name="kelas_id" required>
                                    </select>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <label><span class="text-danger">*</span>Tanggal Lahir :</label>
                                        </div>
                                        <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                            <small>Ex : 27062003</small>
                                        </a>
                                    </div>
                                    <input type="number" class="form-control" name="nisn" id="nisn" placeholder="dd/mm/yyyy" required>        
                                </div>        
                            </div>
                        </div>
                        <div class="col-lg-6 col-12 pall">
                            <div class=" border-round">
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <label><span class="text-danger">*</span>No.Telp Siswa:</label>
                                        </div>
                                        <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                            <small><i class="ph ph-notepad"></i> Support WhatsApp</small>
                                        </a>
                                    </div>
                                    <input type="number" class="form-control" name="nisn" id="nisn" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label>Nama Orang Tua / Wali:</label>
                                    <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" required>
                                </div>
                                <div class="form-group mb-3">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            <label><span class="text-danger">*</span>No.Telp Orang Tua / Wali:</label>
                                        </div>
                                        <a class="fw-semibold text-warning" data-bs-toggle="collapse">
                                            <small><i class="ph ph-notepad"></i> Support WhatsApp</small>
                                        </a>
                                    </div>
                                    <input type="number" class="form-control" name="nisn" id="nisn" required>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="sidikJari">Sidik Jari:</label>
                                    <div class="col-lg-12"> 
                                        <a href="#" class="btn btn-warning w-100" data-bs-toggle="modal" data-bs-target="#modal_add_fingerprint">+Tambah</a>
                                    </div>
                                </div>                  
                            </div>
                        </div>
                     </div>
                </div>
                <div class="modal-footer">
                   <div class="form-group">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                   </div>
                   <div class="form-group">
                        <button type="submit" name="save" value="open" class="btn btn-primary" id="save-open">Save</button>
                   </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Tambah Sidik Jari -->
<div id="modal_add_fingerprint" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-warning text-white d-flex justify-content-between">
                <h6 class="modal-title">Pilih Tipe User Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body bg-light text-center"> 
                <img src="{{ url('assetImg/orange-fingerprint.gif') }}" alt="Fingerprint Detect GIF" class="mb-3"> 
                <button id="scanFingerprintBtn" class="btn btn-primary mb-3">Mulai Pemindaian Sidik Jari</button>
                <div id="fingerprintResult"></div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/fingerprintjs2/2.1.0/fingerprint2.min.js"></script>
<script>
    // Tambahkan event listener untuk tombol "+Tambah" pada modal siswa
    document.querySelector('#modal_add_siswa .btn.btn-warning').addEventListener('click', function() {
        // Buka modal pemindaian sidik jari
        $('#modal_add_fingerprint').modal('show');
    });

    // Tangani pemindaian sidik jari
    document.getElementById('scanFingerprintBtn').addEventListener('click', function () {
        Fingerprint2.get(function (components) {
            var fingerprint = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31);
            // Tampilkan hasil pemindaian sidik jari di dalam modal pemindaian sidik jari
            document.getElementById('fingerprintResult').innerText = 'Hasil Pemindaian Sidik Jari: ' + fingerprint;
            
            // Jika data sidik jari berhasil didapat
            if (fingerprint) {
                // Tampilkan Sweet Alert
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: 'Data sidik jari berhasil didapatkan.',
                    showConfirmButton: false,
                    timer: 1500 // Menutup Sweet Alert setelah 1.5 detik
                });

                // Tutup modal pemindaian sidik jari
                $('#modal_add_fingerprint').modal('hide');
            }
        });
    });
</script>


{{-- Modal New User as Tenaga Didik --}}