@extends('admin.layout')
@section('main-content')
    <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create Singer</h4>
                <form class="forms-sample" method="POST" action="{{route('admin.doEdit.singer',['singer_id' => $singerSongs->id])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputUsername1">Name Singer</label>
                        <input type="name" class="form-control" id="exampleInputUsername1" placeholder="Create singer" name="nameSinger" value="{{$singerSongs->name_singer}}">
                    </div>
                    @error('nameSinger')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                    <div class="form-group">
                        <label for="exampleInputEmail1">Image Singer</label>
                        <input type="file" class="form-control" id="exampleInputEmail1" placeholder="Create image" name="imageSinger">
                    </div>
                    @error('imageSinger')
                    <span style="color: red">{{ $message }}</span>
                @enderror
                    <button class="btn btn-primary">submit</button>
                    <button class="btn btn-light">Cancel</button>
                </form>
            </div>
        </div>
    </div>
   
@endsection