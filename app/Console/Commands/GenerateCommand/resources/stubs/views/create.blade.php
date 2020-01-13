{!! "@" . "extends('_layouts.app')" !!}
{!! "@" . "breadcrumb( __('" . \App\Support\Str::plural($model) . "'), route('" . $route . ".index'))" !!}
{!! "@" . "breadcrumb( __('Create'))" !!}
{!! "@" . "section('content')" !!}

    <h1>{!! "{" . "{ __('Create') }" . "}" !!}</h1>

    {!! "{" . "{ form()->create($" . $var . ") }" . "}" !!}
    @foreach ($attributes as $attribute){!! "{" . "{ form()->control('" . $attribute['name'] . "') }" . "}" !!}
    @endforeach{!! "{" . "{ form()->submit(__('Save'), ['class' => 'btn btn-primary']) }" . "}" !!}
    {!! "{" . "{ html()->link(route('" . $route . ".index'), __('Cancel'), ['class' => 'btn btn-light']) }" . "}" !!}
    {!! "{" . "{ form()->end() }" . "}" !!}

{!! "@" . "endsection" !!}