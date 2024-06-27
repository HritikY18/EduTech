<x-student-master>
    @section('datatableScript')
    <script>
        $(document).ready(function() {
            $('#commentsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('comment.getComments', $course->id) }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'profile',
                        name: 'profile',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'user.surname',
                        name: 'user.surname',
                    },
                    {
                        data: 'comment_text',
                        name: 'comment_text'
                    },
                ]
            });
        });
    </script>
@endsection

    @section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __("Comment on  $course->name Course") }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('comment.store',$course->id) }}" enctype="multipart/form-data">
                            @csrf
                              {{-- name --}}
                              <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Comment') }}</label>

                                <div class="col-md-6">
                                    <input id="comment" type="text" class="form-control @error('comment') is-invalid @enderror" name="comment"   required >

                                    @error('comment')
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">{{ __('Comments') }}</div>

                <div class="card-body">
                    <table class="table table-striped" id="commentsTable">
                        <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Profile</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">Comment</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-student-master>