@extends('admin.layout')
@section('main-content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Form Sửa</h4>
                @foreach ($songs as $song)
                    <form class="forms-sample"action="{{ route('admin.doEdit.song',['song_id'=> $song->song_id])}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputUsername1">Name singer</label>
                            <input type="name" class="form-control" id="exampleInputUsername1" placeholder="Name singer"
                                name="nameSinger" value="{{ $song->name_singer }}">
                            @error('nameSinger')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" >Category</label>
                                <select name="nameCategory" id="categorySong">
                                    @foreach ($categorySong as $category)
                                        <option value="{{ $category->name_category }}">
                                            {{ $category->name_category }}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1" >Name song</label>
                            <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Name song"
                                name="nameSong" value="{{ $song->name_song  }}">
                            @error('nameSong')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">File</label>
                            <input type="file" class="form-control" id="exampleInputPassword1" name="path">
                            @error('path')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Image</label>
                            <input type="file" class="form-control" id="exampleInputConfirmPassword1" name="image">
                            @error('image')
                                <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword1">Lyric</label>
                            <input type="text" class="form-control" id="exampleInputConfirmPassword1" name="lyric">
                        </div>
                       <a  onclick="submit()"><button type="submit" class="btn btn-primary me-2" >Submit</button></a> 
                        <button class="btn btn-light">Cancel</button>
                    </form>
                @endforeach
            </div>
        </div>
    </div>
    <script>
        function submit() {
            alert('Do you want to edit ?')
        }
    </script>
@endsection
