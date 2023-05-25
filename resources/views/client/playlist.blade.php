@extends('client.layout')
@section('main-content')
    <style>
        p {
            padding-left: 10px
        }
    </style>
     <div class="header-content" style="background: #352667;height:240px;color: aliceblue">
        <label for="" style=";font-weight: 600">Playlist</label>
        <h2 for="" style="font-size: 70px;padding-top:20px;font-weight: 800">Danh sách phát của tôi #1</h2>
        <div style="display: flex;padding-top:20px">
            <img src="{{$profile->avatar}}" alt=""
                style="object-fit: cover;width: 30px;height: 30px; border-radius: 50%">
            <p>{{$profile->name}}</p>
            <p>.1 bai hat</p>
            <p>222.0000</p>
        </div>

    </div>
    <div class="footer-content" style="background: #212121;height:100vh;color: aliceblue">
        <h4 style="font-weight: 800;font-size: 20px">Hãy cùng tìm nội dung cho danh sách phát của bạn</h4>
        <input for="search" class="searchPlaylist" type="text" placeholder="Bạn muốn nghe gì?">
        <div class="playlist-song">

        </div>
    </div>
    <script src="{{ asset('client/js/playlist.js') }}"></script>
@endsection
