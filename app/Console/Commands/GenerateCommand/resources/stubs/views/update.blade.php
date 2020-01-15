{!! "@" . "extends('_layouts.app')" !!}
{!! "@" . "breadcrumb( __('" . \App\Support\Str::plural($model) . "'), route('" . $route . ".index'))" !!}
{!! "@" . "breadcrumb( __('" . \App\Support\Str::plural($model) . "'), route('" . $route . ".details', __('" . $model . " details')))" !!}
{!! "@" . "breadcrumb( __('Update'))" !!}
{!! "@" . "section('content')" !!}

    <h1>{!! "{" . "{ __('Update') }" . "}" !!}</h1>

    {!! "{" . "{ form()->create($" . $var . ") }" . "}" !!}
    @foreach ($columns as $column){!! "{" . "{ form()->control('" . $column->name . "') }" . "}" !!}
    @endforeach{!! "{" . "{ form()->submit(__('Save'), ['class' => 'btn btn-primary']) }" . "}" !!}
    {!! "{" . "{ html()->link(route('" . $route . ".details', $" . $var . "), __('Cancel'), ['class' => 'btn btn-light']) }" . "}" !!}
    {!! "{" . "{ form()->end() }" . "}" !!}

{!! "@" . "endsection" !!}