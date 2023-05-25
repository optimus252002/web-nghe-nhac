@extends('admin.layout')

@section('main-content')
    <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">Song Requests</h4>
                            @if (isset($singers) || isset($singerSongs))
                                <p class="card-subtitle card-subtitle-dash">You have {{ $sum }} singer</p>
                            @endif
                        </div>
                        <div>
                            <form action="{{ route('admin.find.singer') }}" method="post">
                                @csrf
                                <input type="search" placeholder="Search singer" title="Search here" name="singerSong">
                            </form>
                        </div>
                    </div>
                    <div class="table-responsive  mt-1">
                        <table class="table select-table">
                            @if (isset($singers))
                                <thead>
                                    <tr>
                                        <th>Singer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($singers as $singer)
                                        <tr>
                                            <td>
                                                <img src="{{ asset($singer->image_singer) }}" alt=""
                                                    style="object-fit: cover">
                                                <a
                                                    href="{{ route('admin.list.singerSong', ['singer_id' => $singer->id]) }}">{{ $singer->name_singer }}</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
                            @if (isset($singerSongs))
                                <thead>
                                    <tr>
                                        <th>Song</th>
                                        <th>Category</th>
                                        <th></th>
                                        @if (request()->user()->role == 2)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($singerSongs as $singerSong)
                                        <tr>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="{{ asset($singerSong->image_song) }}" alt=""
                                                        style="object-fit: cover">
                                                    <div>
                                                        <h6>{{ $singerSong->name_song }}</h6>
                                                        <p>{{ $singerSong->name_singer }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p>{{ $singerSong->name_category }}</p>
                                            </td>
                                            <td></td>
                                            <td>
                                                <div>
                                                    @if (request()->user()->role == 2)
                                                        <a
                                                            href="{{ route('admin.edit.song', ['id' => $singerSong->song_id]) }}"><button
                                                                style="color: rgb(255, 255, 255); background: rgb(18, 175, 70);border: 0px">edit</button></a>
                                                        <a onclick="myDelete()"
                                                            href="{{ route('admin.delete.song', ['id' => $singerSong->song_id]) }}"><button
                                                                style="color: rgb(255, 255, 255); background: rgb(255, 0, 0);border: 0px">delete</button></a>
                                                    @endif

                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endif
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
    </script>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="">User</a></li>
    </ol>
@endsection
