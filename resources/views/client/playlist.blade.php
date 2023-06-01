@extends('client.layout')
@section('main-content')
    <style>
        p {
            padding-left: 10px
        }
    </style>
     <div class="header-content" style="background: #352667;height:220px;color: aliceblue">
        <label for="" style=" font-weight: 600; margin: 16px 0 0 20px; ">Playlist</label>
        <h2 for="" style="font-size: 280%;margin:20px 0 16px 34px;font-weight: 800">Danh sách phát của tôi #1</h2>
        <div style="display: flex;margin:34px 0 0 34px">
            <img src="{{$profile->avatar}}" alt=""
                style="object-fit: cover;width: 30px;height: 30px; border-radius: 50%">
            <p>{{$profile->name}}</p>
            <p>.1 bai hat</p>
            <p>222.0000</p>
        </div>

    </div>
    <div class="footer-content" style="background: #212121;height:100vh;color: aliceblue">
        <h4 style="font-weight: 800;font-size: 20px; margin: 0px 0 20px 26px; padding-top: 20px">Hãy cùng tìm nội dung cho danh sách phát của bạn</h4>
        <input style="margin-left: 34px; height: 36px; width: 240px; padding: 16px; border-radius: 12px; " for="search" class="searchPlaylist" type="text"  placeholder="Bạn muốn nghe gì?">
        <div style="margin-top: 24px; margin-left: 40px;" class="playlist-song">

        </div>
    </div>
    <script src="{{ asset('client/js/playlist.js') }}"></script>
@endsection
