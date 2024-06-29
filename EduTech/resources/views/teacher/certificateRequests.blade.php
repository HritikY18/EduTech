<x-teacher-master>
    @section('datatableScript')
    <script>
        $(document).ready(function() {
            $('#certificateRequestsTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('teacher.getCertificateRequests') }}',
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
                        data: 'uploadCertificateButton',
                        name: 'uploadCertificateButton'
                    },
                ]
            });
        });
    </script>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
            <div class="card">
                <div class="card-header">{{ __('Certificate Requests') }}</div>
                <div class="card-body">
                    <table class="table table-striped" id="certificateRequestsTable">
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

                        <form action="{{ route('teacher.certificateStore') }}" method= 'POST' enctype="multipart/form-data">
                            @csrf
                            @method('PATCH')
                            <div class="modal-body">
                                <input type="file" name ="certificate"   required placeholder="Certificate" >
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
</x-teacher-master>
