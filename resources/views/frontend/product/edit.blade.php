@extends('frontend.main')

@section('content')
    @if (isset($message))
        <div class="alert alert-success" role="alert">{{ $message }}</div>
    @endif
    @if (count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(['url' => '/product/' . $product->id, 'class' => 'form-horizontal', 'method' => 'put', 'style' => 'margin-top: 100px; margin-bottom: 100px; margin-left: 300px']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Tên sản phẩm', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('price', 'Giá sản phẩm', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::text('price', $product->price, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('content', 'Nội dung sản phẩm', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::textarea('content', $product->content, ['class' => 'form-control', 'rows' => 3]) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('image_path', 'Ảnh sản phẩm', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-9">
            {!! Form::text('image_path', $product->image_path, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group">
        {!! Form::label('active', 'Active', ['class' => 'col-sm-3 control-label']) !!}
        <div class="col-sm-3">
            {!! Form::checkbox('active', $product->active, true) !!}
        </div>
    </div>

    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            {!! Form::submit('Chỉnh sửa sản phẩm', ['class' => 'btn btn-success', 'style' => 'margin-left: 400px']) !!}
        </div>
    </div>
    {!! Form::close() !!}
@endsection
