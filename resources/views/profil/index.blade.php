@extends('layout.master')

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h5 page-title">Profil</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <div class="text-center">
                                    <img height="300" width="300" src="{{ asset("$data->foto") }}">
                                </div>
                                <form action="{{ route('profil.update.foto') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Ganti</label>
                                            <input type="file" id="simpleinput" name="file" class="form-control">
                                        </div>
                                    </div>
                                    <input name="type" hidden value="{{ $type }}">
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Ganti</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <div class="card shadow mb-4">
                                        <div class="card-body">
                                            <form action="{{ route('profil.update') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="nama">Nama</label>
                                                    <input type="text" class="form-control" value="{{ $data->nama }}" name="nama" id="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Email</label>
                                                    <input type="email" class="form-control" value="{{ $data->email }}" name="email" id="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">No Telp</label>
                                                    <input type="text" class="form-control" value="{{ $data->no_telp }}" name="no_telp" id="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Alamat</label>
                                                    <input type="text" class="form-control" value="{{ $data->alamat }}" name="alamat" id="nama">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nama">Deskripsi</label>
                                                    <textarea class="form-control" name="desc" rows="4">{{ $data->desc }}</textarea>
                                                </div>
                                                <input name="type" hidden value="{{ $type }}">
                                                <div class="col-12 p-0 text-right">
                                                    <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /. row -->
                    </div> <!-- /. col -->
                </div> <!-- end section -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>
@endsection

@section('js')
@if (session('mysweet'))

<script>
    Swal.fire({
        title: "{{ session('title_a') }}"
        , text: "{{ session('text_a') }}"
        , icon: "{{ session('icon_a') }}"
    , }).then(function(e) {
        if (e.isConfirmed) {
            location.reload();
        }
    });

</script>
@endif
@endsection
