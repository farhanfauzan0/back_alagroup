@extends('layout.master')
@section('css')
<link rel="stylesheet" href="{{ asset('summernote/summernote-bs4.css') }}">
{{-- <link type="text/css" rel="stylesheet" href="{{ asset('summernote/summernote.min.css') }}"> --}}

@endsection

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="row align-items-center mb-2">
                    <div class="col">
                        <h2 class="h4 page-title">Visi - Misi</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form action="{{ route('visimisi.post') }}" method="POST">
                                    @csrf
                                    <input name="type" hidden value="{{ $type }}">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Visi</label>
                                            <textarea class="summernote" name="visi">{{ $data->visi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->
                    <div class="col-md-6">
                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form action="{{ route('visimisi.post') }}" method="POST">
                                    @csrf
                                    <input name="type" hidden value="{{ $type }}">
                                    <div class="form-group mb-3">
                                        <div class="form-group mb-3">
                                            <label for="simpleinput">Misi</label>
                                            <textarea class="summernote" name="misi">{{ $data->misi }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 p-0 text-right">
                                        <button type="submit" class="btn mb-2 btn-success">Simpan</button>
                                    </div>
                                </form>

                            </div> <!-- .card-body -->
                        </div> <!-- .card -->

                    </div> <!-- ./col -->

                </div> <!-- end section -->
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
</main>
@endsection

@section('js')
{{-- <script type="text/javascript" src="{{ asset('summernote/summernote-bs4.js') }}"></script> --}}
<script type="text/javascript" src="{{ asset('summernote/summernote.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });

</script>
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
