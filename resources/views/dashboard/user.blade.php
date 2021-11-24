@extends('layout.dash_layout')
@section('title.content')
@section('content')

<div class="row layout-spacing">
    <div class="col-lg-12">
        <div class="statbox widget box box-shadow">
            <div class="widget-content widget-content-area">
                <table id="style-3" class="table style-3  table-hover">
                    <thead>
                        <tr>
                            <th class="checkbox-column text-center"> User Id </th>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">NIP</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Nomor Telepon</th>

                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            @foreach ($user as $us)
                            <td style="width: 10px" class="text-center"> {{ $us->id }} </td>
                            <td class="text-center">
                                <span><img style="width: 100px" src="{{ asset('storage/user/' . $us->foto) }}" class="text-center"
                                        alt=""></span>
                            </td>
                            <td style="width: 150px" class="text-center"> {{ $us->nama }} </td>
                            <td style="width: 350px" class="text-center"> {{ $us->nip }} </td>
                            <td style="width: 350px" class="text-center"> {{ $us->alamat }} </td>
                            <td style="width: 350px" class="text-center"> {{ $us->no_telp }} </td>
                            <td class="text-center">
                                <ul class="table-controls text-center">
                                    <li><span class="badge badge-warning" style="width: 70px; cursor: pointer"
                                            data-toggle="modal"
                                            data-target="#updateModal-{{ $us->id }}">Update</span></li>
                                    <br>
                                    <li><span class="badge badge-danger" style="width: 70px; cursor: pointer"
                                            data-toggle="modal"
                                            data-target="#deleteModal-{{ $us->id }}">Delete</span></li>
                                </ul>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


@foreach ($user as $us)
<div class="modal fade" id="updateModal-{{ $us->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 20px;">
                <form action="/update" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="foto_backup" value="{{ $us->foto }}">
                    <input type="hidden" name="password_backup" value="{{ $us->password }}">
                    <div class="form-group">
                        <label for="foto">Foto</label>
                        <input type="file" accept="image/*" class="form-control" id="foto" name="foto">
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" value="{{ $us->nama }}">
                    </div>
                    <div class="form-group">
                        <label for="nip">NIP</label>
                        <input type="text" class="form-control" id="nip" name="nip" value="{{ $us->nip }}">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $us->email }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="*****">
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $us->alamat }}">
                    </div>
                    <div class="form-group">
                        <label for="no_telp">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" value="{{ $us->no_telp }}">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" name="id" value="{{ $us->id }}" class="btn btn-warning">Ubah</button>
            </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal-{{ $us->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Data Portfolio</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 20px;">
                <b>Hapus data pengguna ?</b>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <form action="/hapus/{{ $us->id }}" method="get">
                    @csrf
                    <button type="submit" class="btn btn-warning">Hapus</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
