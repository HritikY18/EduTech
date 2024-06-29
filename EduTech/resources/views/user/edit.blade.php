{{-- @if($user->role == 'teacher')
<x-teacher-master/>
@elseif($user->role == 'student')
<x-student-master/>
@endif --}}

{{-- <x-teacher-master> --}}

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Profile') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('user.update',$user) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')
                        {{-- name --}}
                        <div class="row mb-3">
                            <div class="input-group">
                                <span class="input-group-text">Name and Surname</span>
                                <input type="text" name='name' aria-label="First name" class="form-control" value={{ $user->name }} required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <input type="text" name='surname' aria-label="Last name" class="form-control" value={{ $user->surname }} required>
                                @error('surname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                              </div>
                        </div>



                        {{-- profile --}}
                            <div class="text-center">
                                <img src="{{ $user->profile }}" alt="" height="120px" class="rounded" >
                            </div>

                            <div class="row mb-3">
                                <label for="profile" class="col-md-4 col-form-label text-md-end">{{ __('Profile') }}</label>
                                <div class="col-md-6">
                                    <input id="profile" type="file" name="profile"  class=" @error('profile') is-invalid @enderror" autofocus>

                                    @error('profile')
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
                                <input id="phone" type="number" name="phone"  class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" placeholder="Phone" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>





                        {{-- dob --}}
                        <div class="row mb-3">
                            <label for="dob" class="col-md-4 col-form-label text-md-end">{{ __('DOB') }}</label>

                            <div class="col-md-6">
                                <input id="dob" type="date" class="form-control  @error('dob') is-invalid @enderror" name="dob" value={{ $user->dob }} placeholder="DOB" required autocomplete="dob" >
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
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $user->address }}" placeholder="Address" required autocomplete="address">

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
                                    {{ __('Update') }}
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
{{-- </x-teacher-master> --}}
@if($user->role == 'teacher')
<x-teacher-master/>
@elseif($user->role == 'student')
<x-student-master/>
@endif


