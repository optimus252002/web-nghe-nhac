<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Singer;
use App\Models\Song;

class SingerSongController extends Controller
{
    public function listCreateDB()
    {
        $song = Singer::join('singer_songs', 'singer_songs.singer_id', "=", "singers.id")
            ->join('songs', 'songs.id', "=", "singer_songs.song_id")->get();
        return view('admin.song.listSong', compact('song'));
    }
    public function editSingerSong($song_id, $singer_id)
    {
        $editSinger =  Singer::find($singer_id);
        $editSong =  Song::find($song_id);
        return view('admin.song.editSingerSong', compact('editSong', 'editSinger'));
    }
    public function doEdit($song_id, $singer_id)
    {
        $updateSong =  Song::find($song_id);

        $updateSong->update([
            'name' => request()->nameSong,
            'lyric' => request()->lyric,
        ]);
        $updateSinger =  Singer::find($singer_id);

        $updateSinger->update([
            'name_singer' => request()->nameSinger,
        ]);
    }
    public function searchSingerSong()
    {
        $searchSingerSong = request()->search;
        $findSong = song::where('name', 'LIKE', '%' . $searchSingerSong . '%')->get();
        $findSinger = Singer::where('name_singer', 'LIKE', '%' . $searchSingerSong . '%')->get();
        return view('admin.search.search',compact('findSinger','findSong'));
    }
}
