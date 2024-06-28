<x-student-master>
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">{{ __("Current Progress : $enroll->progress") }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('enroll.update',$enroll) }}" enctype="multipart/form-data"
                                oninput="result.value = slider.value">
                                @csrf
                                @method('PATCH')
                                {{-- Progress --}}
                                <div class="row mb-10">
                                    <label for="progress"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Slider Value') }}</label>
                                    <div class="col-md-8">
                                        <output name="result" for="slider">{{ $enroll->progress }}</output>
                                        <input class="slider" type="range" id="slider" min="0" max="100"
                                            step="10" name="progress" value="{{ $enroll->progress }}"> <br />
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
</x-student-master>
