{!! "@" . "extends('_layouts.app')" !!}
{!! "@" . "breadcrumb( __('" . \App\Support\Str::plural($model) . "'), route('" . $route . ".index'))" !!}
{!! "@" . "breadcrumb( __('" . $model . " details'))" !!}
{!! "@" . "section('content')" !!}

    <h1>Details</h1>

    <dl>
        <dt>{!! "{" . "{ __('Uuid') }" . "}" !!}</dt>
        <dd>{!! '{' . '{ $' . $var . '->getUuid() }' . '}' !!}</dd>
        @foreach ($columns as $column)<dt>{!! '{' . "{ __('" . ucfirst(\App\Support\Str::camel($column->name)) . "') }" . "}" !!}</dt>
        <dd>{!! '{' . '{ $' . $var . '->get' . ucfirst(\App\Support\Str::camel($column->name)) . '() }' . '}' !!}</dd>
        @endforeach<dt>{!! '{' . '{ __(\'Created\') }' . '}' !!}</dt>
        <dd>{!! '{' . '{ $' . $var . '->getCreatedAt() }' . '}' !!}</dd>
    </dl>

    {!! "{" . "{ html()->link(route('" . $route . ".update', $" . $var . "), __('Update'), ['class' => 'btn btn-primary']) }" . "}" !!}
    {!! "{" . "{ html()->postlink(route('" . $route . ".delete', $" . $var . "), __('Delete'), ['confirm' => __('Are you sure?'), 'class' => 'btn btn-danger']) }" . "}"  !!}

{!! "@" . "endsection" !!}