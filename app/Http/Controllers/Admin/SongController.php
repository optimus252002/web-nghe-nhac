<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\NavbarController;
use App\Models\Category;
use App\Models\CategorySong;
use App\Models\Session;
use App\Models\Singer;
use App\Models\SingerSong;
use App\Models\Song;

class SongController extends Controller
{
    public function view()
    {
        $name = "admin.song.createSong";
        $extendNavbar = new NavbarController($name);
        return $extendNavbar->navbarAdmin();
    }

    public function checkUpload()
    {
        $name = "admin.song.checkUpload";
        $extendFilterData = new FilterDataController($name);
        return $extendFilterData->filterData();
    }
    public function filterSong($id)
    {$admin = request()->user();
        $categorySong = Category::all();
        $songs = Song::join('singer_songs', 'singer_songs.song_id', "=", "songs.id")
            ->join('singers', 'singers.id', "=", "singer_songs.singer_id")->where('song_id', $id)->get();
        return  view('admin.song.doedit', compact('songs', 'categorySong','admin'));
    }
    public function listSong()
    {
        $name = "admin.song.listSong";
        $extendFilterData = new FilterDataController($name);
        return $extendFilterData->filterDatas();
    }

    public function editSong()
    {
        $name = "admin.song.editsong";
        $extendFilterData = new FilterDataController($name);
        return $extendFilterData->filterDatas();
        
    }
    public function doEdit($song_id)
    {
        $nameSinger = request()->nameSinger;
        $checkSinger = Singer::where('name_singer', $nameSinger)->first()->name_singer;
        if ($checkSinger == $nameSinger) {
            $path = request()->file('path');
            $image = request()->file('image');
            $fileImage = time() . '.' . $image->getClientOriginalName();
            $filePath = time() . '.' . $path->getClientOriginalName();
            $path->storeAs('path', $filePath, 'public');
            $image->storeAs('image_song', $fileImage, 'public');
            $path = 'storage/path/' . $filePath;
            $image = 'storage/image_song/' . $fileImage;
            $nameCategory = request()->nameCategory;
            $categoryID = Category::select('id')->where('name_category', $nameCategory)->first()->id;
            $updateSong =  Song::find($song_id);
            $updateCategory =  CategorySong::where('song_id', $song_id)->first();
            $updateSong->update([
                'path' => $path,
                'image_song' => $image,
                'name_song' => request()->nameSong,
                'lyric' => request()->lyric,
            ]);
            $updateCategory->update([
                'category_id' => $categoryID
            ]);
            return redirect()->route('admin.search.song');
        }
    }

    public function deleteSong($id)
    {
        $deleteSong =  Song::find($id)->delete();
        $deleteSingerSong =  SingerSong::where('song_id',$id)->delete();
        $deleteCategorySong =  CategorySong::where('song_id',$id)->delete();
        return redirect()->route('admin.search.song');
    }


    public function sessionSong()
    {
        // $validated = request()->validate([
        //                 'nameSong' => 'required',
        //                 'nameSinger' => 'required',
        //                 'image_song' => 'required|JPEG|JPG',
        //                 'path' => 'required|file',
        // ]);     
        $nameSinger = request()->nameSinger;
        $checkSinger  = Singer::where('name_singer', $nameSinger)->first();
        $path = request()->file('path');
        $image = request()->file('image');
        $fileImage = time() . '.' . $image->getClientOriginalName();
        $filePath = time() . '.' . $path->getClientOriginalName();
        $path->storeAs('path', $filePath, 'public');
        $image->storeAs('image_song', $fileImage, 'public');
        $path = 'storage/path/' . $filePath;
        $image = 'storage/image_song/' . $fileImage;
        $nameCategory = request()->nameCategory;
        $listSong =  Session::create([
            'name_singer' => request()->nameSinger,
            'name_song' => request()->nameSong,
            'name_category' => $nameCategory,
            'path' => $path,
            'image_song' => $image,
            'lyric' => request()->lyric,
            'action' =>  0,
        ]);
        return redirect()->route('admin.check.upload');
    }
    public function actionSubmit($id)
    {
        $updateAction = Session::where('id', $id)->first()->action;
        if ($updateAction == 1) {
            echo ('loi');
        } else if ($updateAction == 0) {
            $data = ['action' => 1];
            $updateAction = Session::where('id', $id)->update($data);
            $nameSinger =  Session::select('name_singer')->where('id', $id)->first()->name_singer;
            $nameSong =  Session::select('name_song')->where('id', $id)->first()->name_song;
            $path =  Session::select('path')->where('id', $id)->first()->path;
            $image_song =  Session::select('image_song')->where('id', $id)->first()->image_song;
            $lyric =  Session::select('lyric')->where('id', $id)->first()->lyric;
            $createSong =  Song::create([
                'name_song' =>  $nameSong,
                'path' => $path,
                'image_song' => $image_song,
                'lyric' => $lyric,
            ]);
            $songID = Song::select('id')->where('name_song', $nameSong)->first()->id;
            $singerID = Singer::select('id')->where('name_singer', $nameSinger)->first()->id;
            $createSongSinger =  SingerSong::create([
                'song_id' => $songID,
                'singer_id' => $singerID
            ]);
            $nameCategory = Session::where('id', $id)->first()->name_category;
            $categoryID = Category::select('id')->where('name_category', $nameCategory)->first()->id;
            // dd($categoryID);

            $createSongSinger =  CategorySong::create([
                'song_id' => $songID,
                'category_id' => $categoryID
            ]);
            return redirect()->route('admin.check.upload');
        }
    }
    public function actionDelete($id)
    {
        $deleteSong =  Session::find($id)->delete();;
        return redirect()->route('admin.check.upload');
    }
}
