<x-teacher-master>
    @section('datatableScript')
    <script>
        $(document).ready(function() {
            $('#paymentRequestsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('teacher.getPaymentRequests') }}',
                columns: [
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
                        data: 'image',
                        name: 'image',
                        searchable: false,
                        orderable: false
                    },
                    {
                        data: 'course.name',
                        name: 'course.name'
                    },
                    {
                        data: 'paymentRequestButtons',
                        name: 'paymentRequestButtons'
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
                    <table class="table table-striped" id="paymentRequestsTable">
                        <thead>
                            <tr>
                                <th scope="col">Profile</th>
                                <th scope="col">Name</th>
                                <th scope="col">Surname</th>
                                <th scope="col">CourseImage</th>
                                <th scope="col">Course Name</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-teacher-master>