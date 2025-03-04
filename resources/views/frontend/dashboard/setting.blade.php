@extends('layouts.frontend.app')

@section('title')
    Setting
@endsection

@section('body')
    <!-- Dashboard Start-->

    <div class="dashboard container">
        <!-- Sidebar -->
        @include('frontend.dashboard._sidebar',['setting_active' => 'active'])
        <!-- Main Content -->
        <div class="main-content">
            <!-- Settings Section -->

            <section id="settings" class="content-section active">
                <h2>Settings</h2>
                <form class="settings-form" method="post" action="{{route('frontend.dashboard.setting.update')}}" enctype="multipart/form-data">
                   @csrf
                   <div class="form-group">
                    <label for="username">Name:</label>
                    <input name="name" type="text" id="username" value="{{$user->name}}" />
                    @error('name')
                    <small class="text-danger">{{$message}}</small>

                    @enderror
                </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input name="username" type="text" id="username" value="{{$user->username}}" />
                        @error('username')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input name="email" type="email" id="email" value="{{$user->email}}" />
                        @error('email')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="profile-image">Profile Image:</label>
                        <input name="image" type="file" id="profile-image" accept="image/*" />
                        @error('image')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <img id="profile_image" class="img-thumbnail" src="{{asset($user->image)}}" width="180px">
                    </div>
                    <div class="form-group">
                        <label for="country">Country:</label>
                        <input name="country" type="text" id="country" placeholder="Enter your country" value="{{$user->country}}" />
                        @error('country')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="city">City:</label>
                        <input name="city" type="text" id="city" placeholder="Enter your city"  value="{{$user->city}}"/>
                        @error('city')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">Street:</label>
                        <input name="street" type="text" id="street" placeholder="Enter your street" value="{{$user->street}}" />
                        @error('street')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="street">phone:</label>
                        <input name="phone" type="text" id="phone" placeholder="Enter your phone" value="{{$user->phone}}" />
                        @error('phone')
                        <small class="text-danger">{{$message}}</small>

                        @enderror
                    </div>
                    {{-- <div class="form-group">
                        <label for="bio">Bio:</label>
                        <textarea id="bio" placeholder="Tell us about yourself..."></textarea>
                    </div> --}}
                    <button type="submit" class="save-settings-btn">
                        Save Changes
                    </button>
                </form>

                <!-- Form to change the password -->
                <form class="change-password-form" method="post" action="{{route('frontend.dashboard.setting.change-password')}}">
                   @csrf
                    <h2>Change Password</h2>
                    <div class="form-group">
                        <label for="current-password">Current Password:</label>

                        <input name="current_password" type="password" id="current-password" placeholder="Enter Current Password" />
                        @error('current_password')
                        <strong class="text-danger">{{$message}}</strong>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="new-password">New Password:</label>
                        <input name="password" type="password" id="new-password" placeholder="Enter New Password" />
                        @error('password')
                        <strong class="text-danger">{{$message}}</strong>

                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm New Password:</label>
                        <input name="password_confirmation" type="password" id="confirm-password" placeholder="Enter Confirm New " />
                        @error('password_confirmation')
                        <strong class="text-danger">{{$message}}</strong>

                        @enderror
                    </div>
                    <button type="submit" class="change-password-btn">
                        Change Password
                    </button>
                </form>
            </section>
        </div>
    </div>

    <!-- Dashboard End-->
@endsection


@push('js')
<script>
     $(document).on('change','#profile_image', function (e) {
        e.preventDefault();
        var file =this.files[0];
        if(file){
            var reader =new FileReader();
            reader.onload =function(e){
                $('#profile_image').attr('src',e.target.result);
            }
            reader.readAsDataURL(file);
        }

     });
</script>
@endpush
