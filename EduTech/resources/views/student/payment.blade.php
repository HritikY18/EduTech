<x-student-master>
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">

                    <div class="card">
                        <div class="card-header">{{ __($course->name . ' Course Payment') }}</div>

                        <div class="card-body">
                            <form method="POST" action="{{ route('payment.store',$course->id) }}" enctype="multipart/form-data">
                                @csrf

                                {{-- card number --}}
                                <div class="row mb-3">
                                    <label for="card_number"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Card Number') }}</label>

                                    <div class="col-md-6">
                                        <input id="card_number" type="number"
                                            class="form-control @error('card_number') is-invalid @enderror"
                                            name="card_number" value="{{ old('card_number') }}"
                                            placeholder="Enter Card Number" required minlength='16' maxlength="16">

                                        @error('card_number')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- card number --}}

                                <div class="row mb-3">
                                    <label for="cvv"
                                        class="col-md-4 col-form-label text-md-end">{{ __('CVV') }}</label>

                                    <div class="col-md-6">
                                        <input id="cvv" type="number"
                                            class="form-control @error('cvv') is-invalid @enderror" name="cvv"
                                            value="{{ old('cvv') }}" placeholder="Enter CVV" required minlength='3'
                                            maxlength="3">

                                        @error('cvv')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- name --}}
                                <div class="row mb-3">
                                    <label for="card_holder_name"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Card Holder Name') }}</label>

                                    <div class="col-md-6">
                                        <input id="card_holder_name" type="text"
                                            class="form-control @error('card_holder_name') is-invalid @enderror"
                                            name="card_holder_name" value="{{ old('card_holder_name') }}"
                                            placeholder="Enter Name" required autocomplete="name">

                                        @error('card_holder_name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                  {{-- expiry_date --}}
                                  <div class="row mb-3">
                                    <label for="expiry_date"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Expiry Date') }}</label>

                                    <div class="col-md-6">
                                        <input id="expiry_date" type="date"
                                            class="form-control @error('expiry_date') is-invalid @enderror"
                                            name="expiry_date" value="{{ old('expiry_date') }}"
                                            placeholder="Enter Card expiry_date" required >

                                        @error('expiry_date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- price --}}
                                <div class="row mb-3">
                                    <label for="price"
                                        class="col-md-4 col-form-label text-md-end">{{ __('Amount') }}</label>

                                    <div class="col-md-6">
                                        <input id="price" type="text"
                                            class="form-control @error('price') is-invalid @enderror   text-success"
                                            name="amount" value="{{ $course->price }}" placeholder="price" readonly>

                                        @error('price')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-success">
                                            {{ __('Pay') }}
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
