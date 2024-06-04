@extends('layouts.master')
@section('content')
    <div class="page-wrapper">
        <div class="content container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <h3 class="page-title">Settings</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="settings.html">Settings</a></li>
                            <li class="breadcrumb-item active">General Settings</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">Website Details</h5>
                        </div>
                        <div class="card-body pt-0">
                            <form action="{{ route('setting/update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="settings-form">
                                    <div class="form-group">
                                        <label>Website Name <span class="star-red">*</span></label>
                                        <input type="text" class="form-control" name="website_name" placeholder="Enter Website Name" value="{{$settings['website_name']->value ?? config('app.name')}}">
                                    </div>
                                    <div class="form-group">
                                        <p class="settings-label">Logo <span class="star-red">*</span></p>
                                        <div class="settings-btn">
                                            <input type="file" accept="image/*" name="logo" id="file" class="hide-input">
                                            <label for="file" class="upload">
                                                <i class="fe fe-upload"></i>
                                            </label>
                                        </div>
                                        <h6 class="settings-size">Ukuran gambar yang disarankan adalah <span>150px x
                                                150px</span></h6>
                                        <div class="upload-images">
                                            <img src="{{ Storage::url($settings['logo']->value ?? 'img/logo.png') }}" alt="Image">
                                            <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                <i class="feather-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <p class="settings-label">Favicon <span class="star-red">*</span></p>
                                        <div class="settings-btn">
                                            <input type="file" accept="image/*" name="favicon" id="favicon" class="hide-input">
                                            <label for="favicon" class="upload">
                                                <i class="fe fe-upload"></i>
                                            </label>
                                        </div>
                                        <h6 class="settings-size">
                                            Ukuran gambar yang disarankan adalah <span>16px x 16px or 32px x 32px</span>
                                        </h6>
                                        <h6 class="settings-size mt-1">Format yang diterima: hanya png dan ico</h6>
                                        <div class="upload-images upload-size">
                                            <img src="{{ Storage::url($settings['favicon']->value ?? 'img/favicon.png') }}" alt="Image">
                                            <a href="javascript:void(0);" class="btn-icon logo-hide-btn">
                                                <i class="feather-x-circle"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group mb-0">
                                        <div class="settings-btns">
                                            <button type="submit" class="btn btn-orange">Update</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
