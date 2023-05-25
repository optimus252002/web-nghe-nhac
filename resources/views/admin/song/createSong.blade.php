@extends('admin.layout')
@section('main-content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title"> Form Create</h4>
                <form class="forms-sample" action="{{ route('admin.session.song') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name singer</label>
                        <select name="nameSinger" id="nameSinger">
                            @foreach ($singers as $singer)
                            <option value="{{$singer->name_singer}}">{{$singer->name_singer}}</option>
                             @endforeach
                        </select>
                            
                        @error('nameSinger')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Name song</label>
                        <input type="name" class="form-control" id="exampleInputEmail1" placeholder="Name song" name="nameSong">
                        @error('nameSong')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputUsername1">Category</label>
                        <select name="nameCategory" id="nameCategory">
                            @foreach ($categorys as $category)
                            <option value="{{$category->name_category}}">{{$category->name_category}}</option>
                             @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">File</label>
                        <input type="file" class="form-control" id="exampleInputPassword1" name="path" >
                        @error('path')
                        <span style="color: red">{{ $message }}</span>
                    @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Image</label>
                        <input type="file" class="form-control" id="exampleInputConfirmPassword1"
                            name="image">
                            @error('image')
                            <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="exampleInputConfirmPassword1">Lyric</label>
                        <input type="text" class="form-control" id="exampleInputConfirmPassword1"
                            name="lyric">
                    </div>
                   
                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
@endsection

{{-- @section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
        <li class="breadcrumb-item "><a href="">Song</a></li>
        <li class="breadcrumb-item ">Create</li>
    </ol>
@endsection --}}
{{-- <div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Create Song</h3>
    </div>

    <form action="{{ route('admin.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputSong1">Name Singer</label>
                <input type="name" class="form-control" id="exampleInputSinger1" placeholder="Enter name singer"
                    name="nameSinger">
                    @error('nameSinger')
                    <span style="color: red">{{$message}}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputSong1">Name Song</label>
                <input type="name" class="form-control" id="exampleInputSong1" placeholder="Enter name song"
                    name="nameSong">
                    @error('nameSong')
                        <span style="color: red">{{$message}}</span>
                    @enderror
            </div>
            <div class="form-group">
                <label for="exampleInputFileImage">File Path</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="path">
                        <label class="custom-file-label" for="exampleInputFile">Choose path</label>
                        @error('image')
                        <span style="color: red">{{$message}}</span>
                    @enderror
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputFileImage">File image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                        <label class="custom-file-label" for="exampleInputFile">Choose image</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="exampleInputLyric1">Lyric</label>
                <input type="name" class="form-control" id="exampleInputLyric1" placeholder="lyric song"
                    name="lyric">
            </div>

            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1" name="confirm">
                <label class="form-check-label" for="exampleCheck1">confirm</label><br>
                @error('confirm')
                <span style="color: red">{{$message}}</span>
            @enderror
                <a href="{{ route('admin.view.singer') }}" style="float: right">Create singer</a>
            </div>
        </div>

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div> --}}
