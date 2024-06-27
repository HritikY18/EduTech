{{-- @if($user->role == 'teacher')
    <x-teacher-master />
@elseif($user->role == 'student')
    <x-student-master />
@endif --}}
{{-- <x-teacher-master> --}}
    @section('content')
    {{-- <h1 class="h3 mb-4 text-gray-800">Profile page</h1> --}}
    <div class="d-flex justify-content-center">

        <div class="card" style="width: 25rem;">
            <div class="text-center">

                <img src="{{$user->profile}}" class="img-thumbnail" alt="..." >
              </div>
            <div class="card-body">
              <h5 class="card-title">{{ $user->name . " "  . $user->surname}}</h5>
              <table class="table">
                <tbody>
                  <tr>
                    <th scope="row">Role</th>
                    <td>{{ $user->role }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Email</th>
                    <td>{{ $user->email }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Phone</th>
                    <td>{{ $user->phone }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Gender</th>
                    <td>{{ $user->gender }}</td>
                  </tr>
                  <tr>
                    <th scope="row">DOB</th>
                    <td>{{ $user->dob }}</td>
                  </tr>
                  <tr>
                    <th scope="row">Address</th>
                    <td>{{ $user->address }}</td>
                  </tr>
                </tbody>
              </table>


            </div>
          </div>
    </div>
    @endsection
{{-- </x-teacher-master> --}}
@if($user->role == 'teacher')
    <x-teacher-master />
@elseif($user->role == 'student')
    <x-student-master />
@endif



