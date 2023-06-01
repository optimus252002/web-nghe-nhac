@extends('client.layout')
<style>
    .like_song:hover {
        background: #656565
    }
</style>
@section('main-content')
    <div class="header-content" style="background: #352667;height:220px;color: aliceblue">
        <label for="" style="font-weight: 600; margin: 16px 0 0 20px;">Playlist</label>
        <h2 for="" style="font-size: 280%;margin:20px 0 16px 34px;font-weight: 800">Danh sách phát của tôi #1</h2>
        <div style="display: flex;margin:34px 0 0 34px">
            <img src="{{$profile->avatar}}" alt=""
                style="object-fit: cover;width: 30px;height: 30px; border-radius: 50%">
            <p>{{$profile->name}}</p>
            <p>.1 bai hat</p>
            <p>222.0000</p>
        </div>

    </div>
    <div class="footer-content" style="background: #15131c ;color: aliceblue">
        <div style="display: flex;background: #1e1e1e; padding: 20px">
        <p style="padding-left:10px;">#</p>    
        <p style="padding-left:20px;">Title</p>    
        <p style="padding-left:30px;">Name</p>    
        <p style="padding-left:100px;">Category</p>    
        </div>          
        
    </div>

    <script src="{{ asset('client/js/likesong.js') }}"></script>
@endsection
