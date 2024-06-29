<x-student-master>
    @section('datatableScript')
    <script>
        $(document).ready(function() {
            $('#coursesTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('student.getCourses') }}',
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
                           data: 'user.name',
                            name: 'user.name'
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
                                <th>Teacher Name</th>
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

    <script>
        function buttonClick(enroll) {
            // Set the value of the hidden input field in the form
            document.getElementById('enroll_input').value = enroll;
            // Return true to proceed with the default behavior (opening the modal)
            return true;
              }
      </script>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">

            <div class="modal-dialog modal-dialog-centered">
                @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

                <div class="modal-content">

                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Upload Certificate</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <form action="{{ route('student.rating') }}" method= 'POST' enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body" >
                                <input type="number" name = "rating"   required min=1 max =5 placeholder="rate" >
                                <span>*<?php //echo "$certificate_error"?></span>
                                <input type="hidden" id="enroll_input" name="enroll" >
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">submit</button> -->
                                <input type="submit" name="submit_rating" class="btn btn-primary" value="Upload">
                            </div>
                        </form>
                </div>
            </div>
        </div>

@endsection
</x-student-master>

