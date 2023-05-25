@extends('admin.layout')
@section('main-content')

    <div style="border: 1px solid rgb(246, 246, 246) ;background: rgb(246, 246, 246)">
        <div class="d-sm-flex align-items-center justify-content-between border-bottom"
            style="background: rgb(246, 246, 246);">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link " id="home-tab" href="" style="margin-left: 0">Bảng điều khiển</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="profile-tab" href=""> Các tin nhắn chưa đọc</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " id="contact-tab" id="profile-tab" href=""> Manage singers</a>
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
        <div class="col-sm-12" style="padding-top: 25px;border: 1px solid rgb(246, 246, 246)">
            <div class="statistics-details d-flex align-items-center justify-content-between">
                <div>
                    <p class="statistics-title">Tổng số bài hát</p>
                    <h3 class="rate-percentage">{{ $totalSongs->count() }}</h3>
                    <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span>{{ $formatSong }} so tháng
                            trước</span>
                    </p>
                </div>

                <div>
                    <p class="statistics-title">Tổng số ca sĩ </p>
                    <h3 class="rate-percentage">{{ $totalSingers->count() }}</h3>
                    <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>{{ $formatSinger }} so tháng
                            trước</span>
                    </p>
                </div>
                <div>
                    <p class="statistics-title">Các bài hát chưa phê duyệt</p>
                    <h3 class="rate-percentage">{{ $unapprovedSongs->count() }}</h3>
                    <p class="text-success d-flex"><a href="{{ route('admin.check.upload') }}">xem ngay</a></p>

                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">Các tin nhắn chưa đọc</p>
                    <h3 class="rate-percentage">{{ $unreadMessages->count() }}</h3>
                    <p class="text-success d-flex"><a href="">xem ngay</a></p>
                </div>
                <div class="d-none d-md-block">
                    <p class="statistics-title">Thể loại nhạc</p>
                    <h3 class="rate-percentage">{{ $totalCategorys->count() }}</h3>
                    <p class="text-success d-flex"><a href="">xem ngay</a></p>
                </div>
            </div>
        </div>
        <div class="row flex-grow">
            <div class="col-12 grid-margin stretch-card">
                <div class="card card-rounded">
                    <div class="card-body">
                        <div class="d-sm-flex justify-content-between align-items-start">
                            <div>
                                <h4 class="card-title card-title-dash">Market Overview</h4>
                                <p class="card-subtitle card-subtitle-dash">Lorem ipsum dolor sit amet consectetur
                                    adipisicing elit</p>
                            </div>
                            <div>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle toggle-dark btn-lg mb-0 me-0"
                                        type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false"> This month </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2" style="">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Action</a>
                                        <a class="dropdown-item" href="#">Another action</a>
                                        <a class="dropdown-item" href="#">Something else here</a>
                                        <div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="#">Separated link</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="d-sm-flex align-items-center mt-1 justify-content-between">
                            <div class="d-sm-flex align-items-center mt-4 justify-content-between">
                                <h2 class="me-2 fw-bold">$36,2531.00</h2>
                                <h4 class="me-2">USD</h4>
                                <h4 class="text-success">(+1.37%)</h4>
                            </div>
                            <div class="me-3">
                                <div id="marketing-overview-legend">
                                    <div class="chartjs-legend">
                                        <ul>
                                            <li class="text-muted text-small"><span
                                                    style="background-color:#52CDFF"></span>Last week</li>
                                            <li class="text-muted text-small"><span
                                                    style="background-color:#1F3BB3"></span>This week</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="chartjs-bar-wrapper mt-3">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <canvas id="marketingOverview" style="display: block; height: 150px; width: 544px;"
                                width="680" height="187" class="chartjs-render-monitor"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-6 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h4 class="card-title card-title-dash" _msttexthash="2258880" _msthash="455">Hoạt động</h4>
                        <p class="mb-0" _msttexthash="6425887" _msthash="456">20 đã hoàn thành, 5 chiếc còn lại</p>
                    </div>
                    <ul class="bullet-line-list">
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="13230009" _msthash="457"><span class="text-light-green"
                                        _istranslated="1">Ben Tossell</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="2001948" _msthash="458">Vừa rồi</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="13226759" _msthash="459"><span class="text-light-green"
                                        _istranslated="1">Oliver Noah</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="15275" _msthash="460">1h</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="13680394" _msthash="461"><span class="text-light-green"
                                        _istranslated="1">Jack William</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="15275" _msthash="462">1h</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="12320230" _msthash="463"><span class="text-light-green"
                                        _istranslated="1">Leo Lucas</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="15275" _msthash="464">1h</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="13686491" _msthash="465"><span class="text-light-green"
                                        _istranslated="1">Thomas Henry</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="15275" _msthash="466">1h</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="13230009" _msthash="467"><span class="text-light-green"
                                        _istranslated="1">Ben Tossell</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="15275" _msthash="468">1h</p>
                            </div>
                        </li>
                        <li>
                            <div class="d-flex justify-content-between">
                                <div _msttexthash="13230009" _msthash="469"><span class="text-light-green"
                                        _istranslated="1">Ben Tossell</span> giao cho bạn một nhiệm vụ</div>
                                <p _msttexthash="15275" _msthash="470">1h</p>
                            </div>
                        </li>
                    </ul>
                    <div class="list align-items-center pt-3">
                        <div class="wrapper w-100">
                            <p class="mb-0">
                                <a href="#" class="fw-bold text-primary" _msttexthash="5750342"
                                    _msthash="471">Hiển thị tất cả <i class="mdi mdi-arrow-right ms-2"
                                        _istranslated="1"></i></a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


@section('dashboard')

    @if (isset($information) == 1)
        <script>
            var answer = confirm("Vui lòng nhập thông tin cá nhân ")
            window.location = "http://127.0.0.1:8000/profile"
        </script>
    @endif


@show
@endsection
{{-- 
    I'm going to cut my hair tomorrow 
    Yesterday my father went to do service 
my mother made me cook rice
    --}}
