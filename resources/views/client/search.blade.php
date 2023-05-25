@extends('client.layout')
@section('searchSong')
<div style="margin-right: 33%; font-size: 24px;">
</div>
<div>
    <i class="lens fas fa-search" style=""></i>
    <input for="search" class="search_bar" type="text" placeholder="Bạn muốn nghe gì?">
</div>
@endsection
@section('main-content')
<div class="main-content" >
    <div class="row songNew" style="margin: 16px 0;">
        <h4 class="head-content" style="color: #fff;">nhac mot</h4>
    </div>
    <div class="row songHot" style="margin: 16px 0;">
        <h4 class="head-content" style="color: #fff;">nhac hot</h4>
    </div>
</div>
@endsection
@section('main-footer')
<div class="music">
    <div class="music-thumb">
        <img src="" alt="" class="imageSong" />
    </div>
    <div>
        <div class="marquee">
            <div>
                <h3 class="music-name">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati eius sapiente facere
                    aliquam culpa vel? Exercitationem quas, quasi amet, quisquam neque impedit, dolores
                    molestiae illum saepe sequi aut adipisci excepturi?
                </h3>
            </div>
        </div>
        <div style="display: flex; color: aliceblue; font-size: 12px; padding-top: 10px">
            <p class="singer-name">
                Lorem ipsum
        </div>

    </div>
    <div class="controlbar">
        <div class="controlbarflashPlayer">
            <div class="remaining">00:00</div>
            <input type="range" class="range" value="0" step="1" min="0"
                max="100" />
            <audio id="audio" src="" autoplay></audio>
            <div class="duration">00:00</div>

        </div>
        <div class="controls">
            <i class="my-favorite fa-solid fa-heart" id="button"></i>
            <i class="play-infinite fa-solid fa-shuffle" id="button" value="0"></i>

            <i class="play-back fa-solid fa-backward-step" id="button"></i>
            <div class="play">
                <div class="player-inner" onclick="playPause()">
                    <i class="play-icon fa-sharp fa-solid fa-circle-pause" style="font-size: 30px"></i>
                </div>
            </div>
            <i class="play-forward fa-solid fa-forward-step" id="button"></i>
            <div style="width: 30px;position: relative;" onmousemove="moveVolumes()"
                onmouseleave="blurVolumes()">
                <input type="range" id="set-volume" min=0 max=1 step=0.01 value='1'
                    style="display: none;position: absolute;transform: rotate(-90deg); bottom: 75px;right: -40px;
            accent-color:#f8f8f8;">
                <i class="volume fa-solid fa-volume-high" id="volume"></i>
            </div>
            <i class="play-repeat fa-sharp fa-solid fa-rotate-right" id="button"></i>
        </div>
    </div>
</div>

<script src="{{ asset('client/js/search.js') }}"></script>
@endsection