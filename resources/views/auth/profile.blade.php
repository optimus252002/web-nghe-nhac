<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('auth/css/auth.css') }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css"
        integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<style>
    i {
        color: #e40046
    }

    .form__field {
        padding: 20px 0 0 40px;
        width: 300px
    }


</style>

<body>

    @if (request()->user()->role == 0)
        <div style="width: 100%;height: 70px;background: black">
            <a href="{{ route('client.index') }}"><img style="width: 70px ;height: 70px; margin-left:60px"
                    src="https://images.complex.com/complex/images/c_crop,h_920,w_1636,x_109,y_0/c_fill,g_center,h_640,w_640/fl_lossy,pg_1,q_auto/ryd9nmid8thz3xe4vda8/spotify-logo"
                    alt=""></a>
        </div>
    @endif
    @if (request()->user()->role == 1)
        <div style="width: 100%;height: 70px;background:#f4f4f4 ;padding: 25px 0 0 30px">
            <a class="navbar-brand brand-logo" href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('adminlte/images/logo.svg') }}" alt="logo" />
            </a>

        </div>
    @endif
    @if (isset($profile))
        <div class="container">
            <div class="profile-header"style="display: block">
                <div class="profile-img" style="position: relative">
                    <img src="{{ asset($profile->avatar) }}" width="200" alt="Profile Image">
                    <a href="" style="padding-left: 80%;padding-top:250px ;position: absolute">
                            <i class="fas fa-pencil-alt" style="transform: rotate(360deg);"></i>
                    </a>
                </div>
                <div class="profile-nav-info">
                    <h3 class="user-name">{{ $profile->name }}
                        <a href=""><i class="fas fa-pencil-alt"
                                style="transform: rotate(360deg);padding-left: 10px;font-size: 25px;"></i></a>
                    </h3>
                </div>
                <div class="profile-option">
                    <div class="notification">
                        <i class="fa fa-bell"></i>
                        <span class="alert-message">3</span>
                    </div>
                </div>
            </div>

            {{-- @dd(isset( $user->phone)) --}}
            <div class="main-bd">
                <div class="left-side">
                    <div class="profile-side">
                        {{-- <p class="mobile-no"><i class="fa fa-user"></i>{{ $role->author }} --}}
                        </p>
                        <p class="mobile-no"><i class="fa fa-phone"></i>{{ $profile->phone }}
                        </p>
                        <p class="user-mail"><i class="fas fa-map-marker-alt"></i>{{ $profile->address }}
                        </p>
                        <p class="user-mail"><i class="fa fa-envelope"></i>{{ $profile->email }}
                        </p>
                        <div class="profile-btn">
                            <button class="chatbtn" id="chatBtn"><i class="fa fa-comment" ></i> Chat</button>
                            <button class="createbtn" id="Create-post" onclick="clickBtn()"><i
                                    class="fa fa-plus"></i>Update Profile</button>
                        </div>
                        <div class="user-rating">
                            <h3 class="rating">4.5</h3>
                            <div class="rate">
                                <div class="star-outer">
                                    <div class="star-inner">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="right-side" style="background:#353535 ;width: 400px;display: none">
                    <form
                        action="{{ route('auth.edit.profile', ['infor_id' => $profile->infor_id, 'user_id' => $profile->user_id]) }}"
                        method="POST">
                        @csrf
                        <h4 style="padding-left:40px ">Update profile</h4>
                        <div class="form__field">
                            <input type="text" name="phone" class="form__input"
                                placeholder="Enter your phone number">
                        </div>
                        <div class="form__field">
                            <input type="text" name="address" class="form__input" placeholder="Enter your address">
                        </div>
                        <div class="form__field">
                            <button>add profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    @if (isset($users))
        <div class="container">
            <div class="profile-header"style="display: block">
                <div class="profile-img" style="position: relative">
                    <img src="" width="200" alt="Profile Image">
                    <a href="" style="padding-left: 80%;padding-top:250px ;position: absolute"><i
                            class="fas fa-pencil-alt" style="transform: rotate(360deg);"></i></a>

                </div>
                <div class="profile-nav-info">

                    <h3 class="user-name">{{ $users->name }}
                        <a href=""><i class="fas fa-pencil-alt"
                                style="transform: rotate(360deg);padding-left: 10px;font-size: 25px;"></i></a>
                    </h3>

                </div>
                <div class="profile-option">
                    <div class="notification">
                        <i class="fa fa-bell"></i>
                        <span class="alert-message">3</span>
                    </div>
                </div>
            </div>

            {{-- @dd(isset( $user->phone)) --}}
            <div class="main-bd">
                <div class="left-side">
                    <div class="profile-side">
                        {{-- <p class="mobile-no"><i class="fa fa-user"></i>{{ $role->author }} --}}
                        </p>
                        <p class="mobile-no"><i class="fa fa-phone"></i> Cần cập nhật
                        </p>

                        <p class="user-mail"><i class="fas fa-map-marker-alt"></i> Cần cập nhật
                        </p>
                        <p class="user-mail"><i class="fa fa-envelope"></i>{{ $users->email }}
                        </p>
                        <div class="profile-btn">
                            <button class="chatbtn" id="chatBtn" ><i class="fa fa-comment" onclick="chat()" ></i> Chat</button>
                            <button class="createbtn" id="Create-post" onclick="clickBtn()"><i
                                    class="fa fa-plus"></i> Create</button>
                        </div>
                        <div class="user-rating">
                            <h3 class="rating">4.5</h3>
                            <div class="rate">
                                <div class="star-outer">
                                    <div class="star-inner">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                </div>
                                <span class="no-of-user-rate"><span>123</span>&nbsp;&nbsp;reviews</span>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="right-side" style="background:#353535 ;width: 400px;display: none">
                    <form action="{{ route('auth.create.profile', ['user_id' => $users->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <h4 style="padding-left:40px ">Update profile</h4>
                        <div class="form__field">
                            <input type="text" name="phone" class="form__input"
                                placeholder="Enter your phone number">
                        </div>
                        <div class="form__field">
                            <input type="file" name="avatar" class="form__input">
                        </div>
                        <div class="form__field">
                            <input type="text" name="address" class="form__input"
                                placeholder="Enter your address">
                        </div>
                        <div class="form__field">
                            <button>add profile</button>
                        </div>
                    </form>
                </div>
                <div class="chat" style="background:#353535 ;width: 400px;display: none">
                    <form action="{{ route('auth.post.message') }}" method="POST">
                        @csrf
                        <h4 style="padding-left:40px ">Update profile</h4>
                        <div class="form__field">
                            <input type="text" name="message" class="form__input"
                                placeholder="chat for admin">
                        </div>
                      
                        <div class="form__field">
                            <button>add profile</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif
    <script>
        function clickBtn() {
            document.querySelector('.right-side').style.display = "block"
        }
        document.querySelector('#chatBtn').addEventListener('click', function () {
            document.querySelector('.chat').style.display = "block"
        });
    </script>
</body>

</html>
