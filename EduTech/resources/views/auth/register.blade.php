@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                      {{-- role --}}
                        <div class="row mb-3">
                            <div class="form-group col-md-4">
                                <label for="role" class="col-md-4 col-form-label text-md-end">{{ __('Role') }}</label>
                                {{-- <div class="col-md-6">  --}}
                                    <select id="role" name="role" class="form-select" aria-label="Default select example" required value="{{ old('role') }}">
                                        <option value=""  disabled selected> Select Role</option>
                                        <option value="student" >Student</option>
                                        <option value="teacher">Teacher</option>
                                      </select>
                                {{-- </div> --}}
                              </div>
                        </div>

                        {{-- name --}}
                        <div class="row mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Name and Surname</span>
                                <input type="text" name='name' aria-label="First name" class="form-control" placeholder="Name" value="{{ old('name') }}"required>
                                <input type="text" name='surname' aria-label="Last name" class="form-control" placeholder="Surname" value="{{ old('surname') }}"required>
                              </div>
                        </div>
                        {{-- profile --}}
                        <div class="row mb-3">
                            <label for="profile" class="col-md-4 col-form-label text-md-end">{{ __('Profile') }}</label>

                            <div class="col-md-6">
                                <input id="profile" type="file" name="profile"  class="form-control @error('profile') is-invalid @enderror" value="{{ old('profile') }}" required autocomplete="profile" autofocus>

                                @error('profile')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- email --}}
                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror"  value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- phone --}}
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" name="phone"  class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" placeholder="Phone" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- password --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('password') }}" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- confirm password --}}
                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>


                        {{-- gender --}}
                        {{-- <div class="row mb-3"> --}}
                            <div class="form-check form-check-inline">
                                <label for="role" class="form-check-label">Gender</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="male" value="male" value="{{ old('gender') }}" required >
                                <label class="form-check-label" for="male">Male</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="gender" id="female" value="female" value="{{ old('gender') }}" required>
                                <label class="form-check-label" for="female">Female</label>
                              </div>

                              @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                        {{-- </div> --}}

                        {{-- dob --}}
                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('DOB') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control  @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" >
                                @error('dob')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>


                        {{-- address --}}
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" placeholder="Address" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
