@extends('admin.layout')
@section('main-content')
<div class="d-sm-flex align-items-center justify-content-between border-bottom">
    <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a  class="nav-link active ps-0" id="home-tab" href=""> User management</a>
        </li>
        <li class="nav-item">
            <a  class="nav-link "  id="profile-tab" href=""> Manage songs</a>
        </li>
        <li class="nav-item">
            <a  class="nav-link " id="contact-tab"  id="profile-tab" href=""> Manage singers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab"
                aria-selected="false">More</a>
        </li>
    </ul>
    <div>
        <div class="btn-wrapper">
            <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
            <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
            <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
        </div>
    </div>
</div>
    <div class="row flex-grow">
        <div class="col-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-sm-flex justify-content-between align-items-start">
                        <div>
                            <h4 class="card-title card-title-dash">Pending Requests</h4>
                            {{-- <p class="card-subtitle card-subtitle-dash">You have {{ $count}} new requests</p> --}}
                        </div>
                        <div>
                            <button class="btn btn-primary btn-lg text-white mb-0 me-0" type="button"><i
                                    class="mdi mdi-account-plus"></i>Add new member</button>
                        </div>
                    </div>
                    <div class="table-responsive  mt-1">
                        <table class="table select-table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check form-check-flat mt-0">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" aria-checked="false"><i
                                                    class="input-helper"></i><i class="input-helper"></i></label>
                                        </div>
                                    </th>
                                    <th>Customer</th>
                                    <th>Company</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usersAll as $userAll)
                                @if ($userAll->role == 1||$userAll->role == 2)  
                                    <tr>
                                        <td>
                                            <div class="form-check form-check-flat mt-0">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" aria-checked="false"><i
                                                        class="input-helper"></i><i class="input-helper"></i></label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex ">
                                                <img src="{{ asset($userAll->avatar) }}" alt="" style="object-fit: cover">
                                                <div>
                                                    <h6>{{$userAll->name}}</h6>
                                                    <p>{{$userAll->author}}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h6>Company name 1</h6>
                                            <p>company type</p>
                                        </td>
                                        <td>
                                            <div>
                                                <div
                                                    class="d-flex justify-content-between align-items-center mb-1 max-width-progress-wrap">
                                                    <p class="text-success">79%</p>
                                                    <p>85/162</p>
                                                </div>
                                                <div class="progress progress-md">
                                                    <div class="progress-bar bg-success" role="progressbar"
                                                        style="width: 85%" aria-valuenow="25" aria-valuemin="0"
                                                        aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="badge badge-opacity-warning">In progress</div>
                                        </td>
                                    </tr>
                                @endif
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
