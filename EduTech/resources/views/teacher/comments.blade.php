<x-teacher-master>
    @section('datatableScript')
    <script>
        $(document).ready(function() {
            $('#teacherCommentsTable').DataTable({
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
            <div class="card">
                <div class="card-header">{{ __('Comments') }}</div>

                <div class="card-body">
                    <table class="table table-striped" id="teacherCommentsTable">
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
</x-teacher-master>