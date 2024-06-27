<x-student-master>
    @section('datatableScript')
        <script>
            $(document).ready(function() {
                $('#coursematesTable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: '{{ route('student.getCoursemates', $course_id) }}',
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
                            data: 'name',
                            name: 'name',
                        },
                        {
                            data: 'surname',
                            name: 'surname',
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },
                        {
                            data: 'phone',
                            name: 'phone',
                            orderable: false
                        },
                        {
                            data: 'gender',
                            name: 'gender',
                            orderable: false
                        },
                        {
                            data: 'address',
                            data: 'address'
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
                    <div class="card-header">{{ __('Coursemates') }}</div>

                    <div class="card-body">
                        <table class="table table-striped" id="coursematesTable">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Profile</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Surname</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col">Gender</th>
                                    <th scope="col">Address</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-student-master>
