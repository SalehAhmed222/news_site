@extends('layouts.admin.app')
@section('title')
    Update Settings
@endsection
@section('body')
    @push('css')
        {{-- dropify css file --}}
        <link href="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/css/dropify.min.css" rel="stylesheet">
    @endpush

    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.setting.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card-body shadow mb-4 " style="min-width:100ch">
                <h2>Update Settings</h2>
                <br>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">

                            site_name:<input value="{{$getSetting->site_name}}"  type="text" name="site_name" placeholder="Enter  site_name"
                                class="form-control">
                            @error('site_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            email:<input value="{{$getSetting->email}}"   type="text" name="email" placeholder="Enter  email" class="form-control">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            phone:<input value="{{$getSetting->phone}}"  type="text" name="phone" placeholder="Enter a phone" class="form-control">
                            @error('phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            country:<input value="{{$getSetting->country}}"  type="text" name="country" placeholder="Enter a country" class="form-control">
                            @error('country')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            city:<input value="{{$getSetting->city}}"  type="text" name="city" placeholder="Enter a city" class="form-control">
                            @error('city')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            street:<input value="{{$getSetting->street}}"  type="text" name="street" placeholder="Enter a street" class="form-control">
                            @error('street')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            facebook:<input value="{{$getSetting->facebook}}"  type="text" name="facebook" placeholder="Enter a  facebook link"
                                class="form-control">
                            @error('facebook')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            twitter:<input value="{{$getSetting->twitter}}"  type="text" name="twitter" placeholder="Enter a twitter link"
                                class="form-control">
                            @error('twitter')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            instagram:<input value="{{$getSetting->instagram}}" type="text" name="instagram" placeholder="Enter a instagram link"
                                class="form-control">
                            @error('instagram')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            youtube:<input value="{{$getSetting->youtube}}" type="text" name="youtube" placeholder="Enter a youtube link"
                                class="form-control">
                            @error('youtube')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                                small_desc:<textarea  type="text" name="small_desc" placeholder="Enter  small_desc "
                                    class="form-control" >{{$getSetting->small_desc}}</textarea>
                            @error('small_desc')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            logo: <input  type="file"  name="logo" placeholder="Enter a logo" class="dropify"
                                >
                            @error('logo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <img src="{{asset($getSetting->logo)}}" class="img-thumbnail" alt="Thumbnail image">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            favicon: <input  type="file" name="favicon" placeholder="Enter a favicon" class="dropify"
                               >
                            @error('favicon')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <img src="{{asset($getSetting->favicon)}}" class="img-thumbnail" alt="Thumbnail image">
                        </div>
                    </div>
                </div>
                <br>

                <input hidden name="setting_id" value="{{$getSetting->id}}" >

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Update Settings</button>
                </div>

            </div>

        </form>
    </div>
@endsection

@push('js')
    {{-- dropify --}}
    <script src="https://cdn.jsdelivr.net/npm/dropify@0.2.2/dist/js/dropify.min.js"></script>
    <script>
        $('.dropify').dropify({
            messages: {
                'default': 'Drag and drop a file here',
                'replace': 'Drag and drop or click to replace',
                'remove': 'Remove',
                'error': 'Ooops, something wrong happended.'
            }
        });
    </script>
@endpush
