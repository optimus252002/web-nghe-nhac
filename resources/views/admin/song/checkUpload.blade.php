@extends('admin.layout')
@section('main-content')
    @if (isset($data))
    <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">Yêu Cầu Đang Chờ Xử Lý</h4>
                            <p class="card-subtitle card-subtitle-dash">Bạn có {{ $sum }} yêu cầu mới </p>
                        </div>

                        <div>
                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><a
                                    href="{{ route('admin.create.song') }}"
                                    style="text-decoration: none;color: aliceblue">Thêm bài hát mới</a></button>
                        </div>

                    </div>
                    <div class="table-responsive  mt-1">
                        <table class="table select-table">
                            <div class="d-sm-flex">
                                <form action="{{ route('admin.filterdata') }}" method="post">
                                    @csrf
                                    <input type="search" placeholder="tìm kiếm" title="Search here" name="searchs">
                                </form>
                                <select id="ddlViewBy" onchange="run()">
                                    <option value="0" selected="selected">Tùy chọn bộ lọc </option>
                                    <option value="1">lọc theo thời gian</option>
                                    <option value="2">lọc theo trang thái</option>
                                    <option value="3">lọc theo thể loại</option>
                                </select>
                                <div class="date" style="display: none">
                                    <form action="{{ route('admin.filterdata') }}" method="POST">
                                        @csrf
                                        <label>
                                            <input type="date" name="date" />
                                        </label>
                                        <p><button>Submit</button></p>
                                    </form>
                                </div>
                                <div class="status" style="display: none">
                                    <form action="{{ route('admin.filterdata') }}" method="POST">
                                        @csrf
                                        <select name="status">
                                            <option value="0">Chưa thành công</option>
                                            <option value="1">Thành công</option>
                                        </select>
                                        <p><button>Submit</button></p>
                                    </form>
                                </div>
                                <div class="category" style="display: none">
                                    <form action="{{ route('admin.filterdata') }}" method="POST">
                                        @csrf
                                        <select name="category">
                                            @foreach ($categorySong as $categorySong)
                                                <option value="{{ $categorySong->name_category }}">
                                                    {{ $categorySong->name_category }}</option>
                                            @endforeach
                                        </select>
                                        <p><button>Submit</button></p>
                                    </form>
                                </div>
                            </div>
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input"
                                                    aria-checked="false"><i class="input-helper"></i><i
                                                    class="input-helper"></i></label>
                                        </div>
                                    </th>
                                    <th>Bài hát</th>
                                    <th>Thể loại</th>
                                    <th>Thời gian thêm </th>
                                    <th>Trạng thái</th>
                                    @if (request()->user()->role == 2)
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $song)
                                    {{-- @dd( $song->id) --}}
                                    <form action="{{ route('admin.song.action.submit', ['id' => $song->id]) }}"
                                        method="post">
                                        @csrf
                                        <tr>
                                            <td>
                                                <div class="form-check form-check-flat mt-0">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input"
                                                            aria-checked="false"><i class="input-helper"></i><i
                                                            class="input-helper"></i></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex ">
                                                    <img src="{{ asset($song->image_song) }}" alt="">
                                                    <div>
                                                        <h6>{{ $song->name_song }}</h6>
                                                        <p>{{ $song->name_singer }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p name="nameCategory">{{ $song->name_category }}</p>
                                            </td>
                                            <td>
                                                <div>
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                        <p class="text-success">{{ $song->created_at }}</p>

                                                    </div>
                                                    {{-- <div class="progress progress-md">
                                                        <div class="progress-bar bg-success" role="progressbar"
                                                            style="width: 85%" aria-valuenow="25" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div> --}}
                                                </div>
                                            </td>
                                            <td>
                                                <div class="badge badge-opacity-warning">
                                                    @if ($song->action == 0)
                                                        Chưa thành công
                                                    @else
                                                        Thành công
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                @if (request()->user()->role == 2)
                                                    <button
                                                        style="color: rgb(255, 255, 255); background: rgb(18, 175, 70);border: 0px;width: 70px">Chấp
                                                        nhận</button>

                                    </form>
                                    <a class="delete" onclick="myDelete()"
                                        href="{{ route('admin.song.action.delete', ['id' => $song->id]) }}">
                                        <button
                                            style="color: rgb(255, 255, 255); background: rgb(255, 34, 5);border: 0px;width: 70px">Xóa</button></a>
                                @endif

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
    @endif

    @if (!isset($data))
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Yêu Cầu Đang Chờ Xử Lý</h4>
                                <p class="card-subtitle card-subtitle-dash">Bạn có {{ $sum }} yêu cầu mới </p>
                            </div>

                            <div>
                                <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><a
                                        href="{{ route('admin.create.song') }}"
                                        style="text-decoration: none;color: aliceblue">Thêm bài hát mới</a></button>
                            </div>

                        </div>
                        <div class="table-responsive  mt-1">
                            <table class="table select-table">
                                <div class="d-sm-flex">
                                    <form action="{{ route('admin.filterdata') }}" method="post">
                                        @csrf
                                        <input type="search" placeholder="tìm kiếm" title="Search here" name="searchs">
                                    </form>
                                    <select id="ddlViewBy" onchange="run()">
                                        <option value="0" selected="selected">Tùy chọn bộ lọc </option>
                                        <option value="1">lọc theo thời gian</option>
                                        <option value="2">lọc theo trang thái</option>
                                        <option value="3">lọc theo thể loại</option>
                                    </select>
                                    <div class="date" style="display: none">
                                        <form action="{{ route('admin.filterdata') }}" method="POST">
                                            @csrf
                                            <label>
                                                <input type="date" name="date" />
                                            </label>
                                            <p><button>Submit</button></p>
                                        </form>
                                    </div>
                                    <div class="status" style="display: none">
                                        <form action="{{ route('admin.filterdata') }}" method="POST">
                                            @csrf
                                            <select name="status">
                                                <option value="0">Chưa thành công</option>
                                                <option value="1">Thành công</option>
                                            </select>
                                            <p><button>Submit</button></p>
                                        </form>
                                    </div>
                                    <div class="category" style="display: none">
                                        <form action="{{ route('admin.filterdata') }}" method="POST">
                                            @csrf
                                            <select name="category">
                                                @foreach ($categorySong as $categorySong)
                                                    <option value="{{ $categorySong->name_category }}">
                                                        {{ $categorySong->name_category }}</option>
                                                @endforeach
                                            </select>
                                            <p><button>Submit</button></p>
                                        </form>
                                    </div>
                                </div>
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="form-check form-check-flat mt-0">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input"
                                                        aria-checked="false"><i class="input-helper"></i><i
                                                        class="input-helper"></i></label>
                                            </div>
                                        </th>
                                        <th>Bài hát</th>
                                        <th>Thể loại</th>
                                        <th>Thời gian thêm </th>
                                        <th>Trạng thái</th>
                                        @if (request()->user()->role == 2)
                                            <th>Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($listSong as $song)
                                        {{-- @dd( $song->id) --}}
                                        <form action="{{ route('admin.song.action.submit', ['id' => $song->id]) }}"
                                            method="post">
                                            @csrf
                                            <tr>
                                                <td>
                                                    <div class="form-check form-check-flat mt-0">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" class="form-check-input"
                                                                aria-checked="false"><i class="input-helper"></i><i
                                                                class="input-helper"></i></label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex ">
                                                        <img src="{{ asset($song->image_song) }}" alt="">
                                                        <div>
                                                            <h6>{{ $song->name_song }}</h6>
                                                            <p>{{ $song->name_singer }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p name="nameCategory">{{ $song->name_category }}</p>
                                                </td>
                                                <td>
                                                    <div>
                                                        <div
                                                            class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                            <p class="text-success">{{ $song->created_at }}</p>

                                                        </div>
                                                        {{-- <div class="progress progress-md">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: 85%" aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div> --}}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="badge badge-opacity-warning">
                                                        @if ($song->action == 0)
                                                            Chưa thành công
                                                        @else
                                                            Thành công
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    @if (request()->user()->role == 2)
                                                        <button
                                                            style="color: rgb(255, 255, 255); background: rgb(18, 175, 70);border: 0px;width: 70px">Chấp
                                                            nhận</button>

                                        </form>
                                        <a class="delete" onclick="myDelete()"
                                            href="{{ route('admin.song.action.delete', ['id' => $song->id]) }}">
                                            <button
                                                style="color: rgb(255, 255, 255); background: rgb(255, 34, 5);border: 0px;width: 70px">Xóa</button></a>
                                    @endif

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
    @endif

    <script>
        function myDelete() {
            alert('Do you want to delete ?')
        }

        function myConfirm() {
            alert('Do you want to confirm ?')
        }


        function run() {
            const values = document.getElementById("ddlViewBy").value;
            if (values == 1) {
                document.querySelector(".date").style.display = "flex"
            } else {
                document.querySelector(".date").style.display = "none"
            }
            if (values == 2) {
                document.querySelector(".status").style.display = "flex"
            } else {
                document.querySelector(".status").style.display = "none"
            }
            if (values == 3) {
                document.querySelector(".category").style.display = "flex"
            } else {
                document.querySelector(".category").style.display = "none"
            }

        }
    </script>
@endsection

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="">User</a></li>
    </ol>
@endsection
