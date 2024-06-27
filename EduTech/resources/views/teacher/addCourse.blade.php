<x-teacher-master>
    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">{{ __('Add New Course') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('course.store') }}" enctype="multipart/form-data">
                            @csrf

                              {{-- name --}}
                              <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Course Title') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Enter Course Title" required autocomplete="name">

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                             {{-- price --}}
                             <div class="row mb-3">
                                <label for="price" class="col-md-4 col-form-label text-md-end">{{ __('Price') }}</label>

                                <div class="col-md-6">
                                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}" placeholder="price" required min='1'>

                                    @error('price')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            {{-- image --}}
                            <div class="row mb-3">
                                <label for="image" class="col-md-4 col-form-label text-md-end">{{ __('Course File') }}</label>

                                <div class="col-md-6">
                                    <input id="image" type="file" name="image"  class="@error('image') is-invalid @enderror"  required  autofocus>

                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>



                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
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
</x-teacher-master>