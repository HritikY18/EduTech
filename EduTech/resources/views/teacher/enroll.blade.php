<x-teacher-master>
    @section('content')
    <div class="container">
            <form method="POST" action="{{route('enroll.store')}}" class="row justify-content-center" enctype="multipart/form-data">
                @csrf    
                <select name="users[]" multiple  required  class="form-control @error('price') is-invalid @enderror">
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
                </select>  
                <input type="hidden" value="{{ $course_id }}" name = 'course_id'/>
                @error('users[]')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <button type="submit" class="btn btn-primary">Enroll</button>
            </form>
    </div>
    @endsection
</x-teacher-master>
