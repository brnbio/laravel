{!! "@" . "extends('_layouts.app')" !!}
{!! "@" . "breadcrumb( __('" . \App\Support\Str::plural($model) . "'))" !!}
{!! "@" . "section('content')" !!}

    <p class="text-right">
        {!! '{' . '{ html()->link(route(\'' . $route . '.create\'), __(\'Create\'), [\'class\' => \'btn btn-primary\']) }' . '}' !!}
    </p>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>UUID</th>
                    @foreach ($columns as $column)<th>{{ ucfirst(\App\Support\Str::camel($column->name)) }}</th>
                    @endforeach<th></th>
                </tr>
            </thead>
            <tbody>
                {{ '@' . 'foreach ($' . $vars . ' as $' . $var . ')' }}
                    <tr>
                        <td>{!! '{' . '{ html()->link(route(\'' . $route . '.details\', $' . $var . '), $' . $var . '->getUuid()) }' . '}' !!}</td>
                        @foreach ($columns as $column)<td>{!! '{' . '{ $' . $var . '->get' . ucfirst(\App\Support\Str::camel($column->name)) . '() }' . '}' !!}</td>
                        @endforeach<td>
                            {!! '{' . '{ html()->link(route(\'' . $route . '.update\', $' . $var . '), __(\'Update\')) }' . '}' !!}
                            {!! '{' . '{ html()->postlink(route(\'' . $route . '.delete\', $' . $var . '), __(\'Delete\'), [\'confirm\' => __(\'Are you sure?\')]) }' . '}'  !!}
                        </td>
                    </tr>
                {{ '@' . 'endforeach' }}
            </tbody>
        </table>
    </div>

    {!! '{' . '{ $' . $vars . '->links() }' . '}' !!}

{{ "@" . "endsection" }}