@extends('frontend.main')

@section('content')
    {{-- ★Use for case: return view('ViewName')->with('message', $e->getMessage());★
    @if (isset($message))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif --}}
    @if (session('dangerMessage'))
        <div class="alert alert-danger">
            {{ session('dangerMessage') }}
        </div>
    @endif

    <div style="margin-top: 20px; margin-bottom: 20px">
        <a href="{{ '/user/create' }}">
            <span class="glyphicon glyphicon-pencil">Create new</span>
        </a>
    </div>
    <table class="table table-bordered">
        <tr class="success">
            <th>ID</th>
            <th>User Name</th>
            <th>Registered Email Address</th>
            <th>Recent Active</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <span class="text-success glyphicon glyphicon-ok">Active</span>
                </td>
                <td>
                    <a href="{{ '/user/' . $user->id . '/edit' }}"><span class="glyphicon glyphicon-pencil">Edit
                            |</span></a>
                    <a href="{{ '/user/' . $user->id }}"><span class="glyphicon glyphicon-eye-open">Preview |</span></a>

                    <!-- ========================= SECTION DELETE PROCESS ========================= -->
                    {{-- --★ Other way ★--
                    {!! Form::open(['method' => 'DELETE','route' => ['reports.destroy', $dummy->id],'class'=>'']) !!}
                    {{ Form::button('<i class="bi bi-trash-fill" style="color:white"></i>', ['type' => 'submit', 'class' => 'delete get-started-btn-two'] )  }}
                    {!! Form::close() !!} --}}
                    <form action="{{ route('user.destroy', $user->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <a href="#" class="btn btn-danger" title="Delete" data-toggle="tooltip"
                            onclick="this.closest('form').submit();return false;">
                            <i class="bi bi-trash-fill" style="color:white">
                                <span class="glyphicon glyphicon-trash">Delete</span>
                            </i>
                        </a>
                    </form>
                    <!-- ========================= SECTION DELETE PROCESS END// ========================= -->
                </td>
            </tr>
        @endforeach
    </table>
@endsection
