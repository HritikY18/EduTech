
                                <div class="row mb-3">
                                <label for="cvv" class="col-md-4 col-form-label text-md-end">{{ __('CVV') }}</label>

                                    <div class="col-md-6">
                                        <input id="cvv" type="number" class="form-control @error('cvv') is-invalid @enderror" name="cvv" value="{{ old('cvv') }}" placeholder="Enter CVV" required min='3' max='3>

                                        @error('cvv')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>