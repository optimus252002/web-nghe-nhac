@extends('admin.layout')
@section('main-content')
    <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">Pending Requests</h4>
                            <p class="card-subtitle card-subtitle-dash">You have new requests</p>
                        </div>
                        <div>
                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><a href=""
                                    style="text-decoration: none;color: aliceblue">Add new Song</a></button>
                        </div>
                    </div>
                    <div class="table-responsive  mt-1">
                        <table class="table select-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" aria-checked="false"><i
                                                    class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                    </th>
                                    <th>Song</th>
                                    <th>file</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                              
                                @foreach ($findSinger as $singer)
                                <tr>
                                    <td>
                                        <div class="d-flex ">
                                            <div>
                                                <h6>{{ $singer->name_singer }}</h6>

                                            </div>
                                        </div>
                                    </tr>
                                @endforeach
                                @foreach ($findSong as $song)
                                    <tr>
                                       
                                        <td>
                                            <div class="d-flex ">
                                                <img src="{{ asset($song->image) }}" alt="">
                                                <div>
                                                    <h6>{{ $song->name }}</h6>

                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function myDelete() {
            alert('Do you want to delete ?')
        }

        function myConfirm() {
            alert('Do you want to confirm ?')
        }
    </script>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="">User</a></li>
    </ol>
@endsection
