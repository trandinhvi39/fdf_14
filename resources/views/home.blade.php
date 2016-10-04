@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('label.list_product') }}</div>
                <div class="panel-body">
                    {!! Form::open(['route' => 'filter-product']) !!}
                        <div class="form-group col-sm-3">
                            {!! Form::label('category', trans('product.category')) !!}
                            {!! Form::select('category_id', ['' => config('settings.all')] + $categories->toArray(), empty($inputs) ? null : $inputs['category_id'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-3">
                            {!! Form::label('price', trans('product.price')) !!}
                            {!! Form::select('price', config('settings.filter.price'), empty($inputs) ? null : $inputs['price'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-3">
                            {!! Form::label('rating', trans('product.rate_average')) !!}
                            {!! Form::select('rating', config('settings.filter.orderby'), empty($inputs) ? null : $inputs['rating'], ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group col-sm-12">
                            {!! Form::button(trans('label.filter'), ['type' => 'submit', 'class' => 'btn btn-info']) !!}
                        </div>
                    {!! Form::close() !!}
                    <div class="list-product">
                        @if ($products->count())
                            @foreach ($products as $product)
                                <div class="form-group col-sm-6">
                                    <strong> {{ $product->name }} </strong> <i> ({{ $product->showStatus() }}) </i>
                                    <br>
                                    <i class="statistic"> {{ trans('product.view_count') }}: {{ $product->view_count }} </i>
                                    <i class="statistic"> {{ trans('product.rate_count') }}: {{ $product->rate_count }} </i>
                                    <i class="statistic"> {{ trans('product.rate_average') }}: {{ $product->rate_average }} </i>
                                    <br><br>
                                    <img class="img-product" src="{{ $product->getImagePath() }}">
                                    <br>
                                    <a class="btn btn-infor" href="{{ URL::action('User\ProductController@show', ['id' => $product->id]) }}">{{ trans('label.view_details') }}</a>
                                </div>
                            @endforeach
                        @else
                            <div class="form-group col-sm-6">
                                {{ trans('label.product_not_found') }}
                            </div>
                        @endif
                    </div>
                </div>
                {!! $products->render() !!}
            </div>
        </div>
    </div>
</div>
@endsection
