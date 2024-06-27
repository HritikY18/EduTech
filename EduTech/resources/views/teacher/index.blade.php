<x-teacher-master>
    @section('datatableScript')
        <script>
            $(document).ready(function() {
                $('#coursesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('teacher.getCourses') }}',
                    columns: [{
                            data: 'id',
                            name: 'id'
                        },
                        {
                            data: 'image',
                            name: 'image',
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'name',
                            name: 'name'
                        },
                        {
                            data: 'price',
                            name: 'price'
                        },
                        {
                            data: 'actions',
                            name: 'actions',
                            orderable: false,
                            searchable: false
                        },
                    ]
                });
            });
        </script>
    @endsection
    @section('content')
        <div class="container">
            <div class="row justify-content-center">
                @if (session('danger'))
                    <div class = "alert alert-danger">
                        {{ session('danger') }}
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                    {{-- @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                    @endif --}}
                <div class="card">
                    <div class="card-header">{{ __('Your courses') }}</div>

                    <div class="card-body">
                        <table class="table table-striped" id="coursesTable">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Course</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Actions</th>
                                    {{-- <th>Created_at</th>
                            <th>Updated_at</th>
                            <th>Edit</th>
                            <th>Status</th> --}}
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-teacher-master>
