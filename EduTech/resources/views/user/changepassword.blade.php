{{-- @if($user->role == 'teacher')
    <x-teacher-master/>
@elseif($user->role == 'student')
<x-student-master/>
@endif --}}
{{-- <x-teacher-master> --}}
    @section('content')
    <div class="container">
        @if(session('password-not-matched'))
            <div class="alert alert-danger">
                {{ session('password-not-matched') }}
            </div>
        @endif  
      <div class="row justify-content-center">
          <div class="col-md-8">
              <div class="card">
                  <div class="card-header">{{ __('ChangePassword') }}</div>
  
                  <div class="card-body">
                      <form method="POST" action="{{ route('user.changePasswordStore') }}" enctype="multipart/form-data">
                          @csrf
                          @method('PATCH')
                          {{-- currentPassword --}}
                          <div class="row mb-3">
                              <label for="currentPassword" class="col-md-4 col-form-label text-md-end">{{ __('Current Password') }}</label>
  
                              <div class="col-md-6">
                                  <input id="currentPassword" type="password" name="currentPassword"  class="form-control @error('currentPassword') is-invalid @enderror"  placeholder="Enter Current Password" required autocomplete="currentPassword">
  
                                  @error('currentPassword')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                  @enderror
                              </div>
                          </div>
  
                            {{-- password --}}
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('New Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="New Password" name="password" required autocomplete="new-password">

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
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required autocomplete="new-password">
                            </div>
                        </div>
  
  
                          <div class="row mb-0">
                              <div class="col-md-6 offset-md-4">
                                  <button type="submit" class="btn btn-primary">
                                      {{ __('Change') }}
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
@if(auth()->user()->role == 'teacher')
<x-teacher-master/>
@elseif(auth()->user()->role == 'student')
<x-student-master/>
@endif






