@extends('frontend.main')

@section('content')
    {{-- ★Use for case: return view('ViewName')->with('message', $e->getMessage());★
    @if (isset($message))
        <div class="alert alert-danger">
            {{ $message }}
        </div>
    @endif --}}
    @if (session('message'))
        <div class="alert alert-danger">
            {{ session('message') }}
        </div>
    @endif

    <div style="margin-top: 20px; margin-bottom: 20px">
        <a href="{{ '/product/create' }}">
            <span class="glyphicon glyphicon-pencil">Create new</span>
        </a>
    </div>
    <table class="table table-bordered">
        <tr class="success">
            <th>ID</th>
            <th>Tên sản phẩm</th>
            <th>Giá sản phẩm</th>
            <th>Nội dung</th>
            <th>Ảnh sản phẩm</th>
            <th>Đăng bán</th>
            <th>Action</th>
        </tr>
        @foreach ($products as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td class="text-right">{{ number_format($p->price) }}</td>
                <td>{{ $p->content }}</td>
                <td>
                    <img src="{{ Asset($p->image_path) }}" alt="{{ $p->name }}" width="120" height="120">
                </td>
                <td>
                    @if ($p->active)
                        <span class="text-success glyphicon glyphicon-ok">Active</span>
                    @else
                        <span class="text-danger glyphicon glyphicon-remove">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ '/product/' . $p->id . '/edit' }}"><span class="glyphicon glyphicon-pencil">Edit
                            |</span></a>
                    <a href="{{ '/product/' . $p->id }}"><span class="glyphicon glyphicon-eye-open">Preview |</span></a>

                    <!-- ========================= SECTION DELETE PROCESS ========================= -->
                    {{-- <a href="{{ '/product/' . $p->id }}" data-method="delete" data-confirm="Are you sure?"><span class="glyphicon glyphicon-trash">Delete</span></a> --}}
                    {{-- <button class="delete" data-target="{{ '/product/' . $p->id }}" data-method="delete"
                        data-confirm="Are you sure?">Delete</button> --}}

                    {{-- --★ Other way ★--
                    {!! Form::open(['method' => 'DELETE','route' => ['reports.destroy', $dummy->id],'class'=>'']) !!}
                    {{ Form::button('<i class="bi bi-trash-fill" style="color:white"></i>', ['type' => 'submit', 'class' => 'delete get-started-btn-two'] )  }}
                    {!! Form::close() !!} --}}
                    <form action="{{ route('product.destroy', $p->id) }}" method="post">
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
