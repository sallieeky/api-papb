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
                            <th class="text-center">Nama</th>
                            <th class="text-center">Jam Check In</th>
                            <th class="text-center">Status</th>

                        </tr>
                    </thead>
                    
                    <tbody>
                        <tr>
                            @foreach ($checkin as $ci)
                            <td style="width: 10px" class="text-center"> {{ $loop->iteration }} </td>
                            <td style="width: 350px" class="text-center"> {{ $ci->user->nama }} </td>
                            <td style="width: 350px" class="text-center"> {{ $ci->jam }} </td>
                            <td style="width: 350px" class="text-center"> {{ $ci->keterangan }} </td>
                            {{-- <td class="text-center">
                                <ul class="table-controls text-center">
                                    <li><span class="badge badge-danger" style="width: 100px; cursor: pointer"
                                            data-toggle="modal"
                                            data-target="#deleteModal-">Delete</span></li>
                                </ul>
                            </td> --}}
                            @endforeach
                        </tr>
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="deleteModal-" tabindex="-1" aria-hidden="true">
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
            <form action="/delete-portfolio/" method="POST">
                {{ csrf_field() }}
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <input  type="submit" class="btn btn-warning" value="Hapus">
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
