@extends('layout.master')

@section('main')
<main role="main" class="main-content">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-body">
                        <div class="toolbar row mb-3">
                            <div class="col">
                                <h4>Data Produk ALA</h4>
                            </div>
                            <div class="col ml-auto">
                                <button class="btn btn-primary float-right ml-3 tombol-tambah" type="button">+ Tambah</button>
                            </div>
                        </div>
                        <table class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Foto</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $datas)
                                <tr>
                                    <td>{{ $datas->nama }}</td>
                                    <td><img width="100" height="100" src="{{ asset("$datas->foto") }}"></td>
                                    <td>
                                        <button class="btn btn-sm btn-danger" onclick="deleteConfirmation({{ $datas->id }})">Hapus</button>
                                        <button class="btn btn-sm btn-info button-edit" data-id="{{ $datas->id }}">Edit</button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    <div class="modal fade modal-notif modal-slide modal-tambah" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Tambah Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-tambah" action="{{ route('produk.insert') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="type" value="{{ $type }}" hidden>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama">
                        </div>
                        <div class="form-group">
                            <label for="nama">Foto</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-tambah').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-notif modal-slide modal-edit" tabindex="-1" role="dialog" aria-labelledby="defaultModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="defaultModalLabel">Edit Produk</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-edit" action="{{ route('produk.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input name="type" value="{{ $type }}" hidden>
                        <input name="id" class="id-edit" hidden>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" name="nama" id="nama-edit">
                        </div>
                        <div class="form-group">
                            <label for="nama">Foto</label>
                            <input type="file" class="form-control" name="file" id="file">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" onclick="document.getElementById('form-edit').submit();" class="btn btn-secondary btn-block" data-dismiss="modal">Simpan</button>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('js')
<script>
    $('.tombol-tambah').click(function() {
        $('.modal-tambah').modal({
            'show': true
        })
    })

    $('.button-edit').click(function() {
        var id = $(this).data('id')

        $.ajax({
            url: "{{ route('produk.edit') }}"
            , type: "POST"
            , data: {
                id: id
            }
        }).then(function(data) {
            console.log(data.nama)
            $('.id-edit').val(data.id)
            $('#nama-edit').val(data.nama)
            $('.modal-edit').modal({
                'show': true
            })
        })
    })

    function deleteConfirmation(id) {
        Swal.fire({
            title: "Yakin ingin menghapus data ini?"
            , text: "jika terhapus tidak dapat dikembalikan."
            , type: "warning"
            , showCancelButton: true
            , confirmButtonColor: "red"
            , confirmButtonText: "Ya"
            , cancelButtonText: "Tidak"
        , }).then(function(e) {
            if (e.isConfirmed) {
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'POST'
                    , url: "{{ route('produk.delete') }}"
                    , data: {
                        id: id
                    }
                }).then(function(data) {
                    Swal.fire({
                        title: data.title
                        , text: data.text
                        , icon: data.icon
                    , }).then(function(e) {
                        if (e.isConfirmed) {
                            location.reload();
                        }
                    })
                })
            } else {
                location.reload();
            }
        });
    };

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
