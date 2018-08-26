<table class="table table-responsive" id="configurations-table">
    <thead>
        <tr>
            <th>Key</th>
        <th>Value</th>
            <th colspan="3">Action</th>
        </tr>
    </thead>
    <tbody>
    @foreach($configurations as $configuration)
        <tr>
            <td>{!! $configuration->key !!}</td>
            <td>{!! $configuration->value !!}</td>
            <td>
                {!! Form::open(['route' => ['configurations.destroy', $configuration->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('configurations.show', [$configuration->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('configurations.edit', [$configuration->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>