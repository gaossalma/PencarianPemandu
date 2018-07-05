<table class="table table-responsive" id="pemandus-table">
    <thead>
        <th>Fullname</th>
        <th>Email</th>
        <th>Jenis Kelamin</th>
        <th>Nomor Tlp</th>
        <th>Longitude</th>
        <th>Latitude</th>
        <th colspan="3">Action</th>
    </thead>
    <tbody>
    @foreach($pemandus as $pemandu)
        <tr>
            <td>{!! $pemandu->fullname !!}</td>
            <td>{!! $pemandu->email !!}</td>
            <td>{!! $pemandu->jenis_kelamin !!}</td>
            <td>{!! $pemandu->nomor_tlp !!}</td>
            <td>{!! $pemandu->longitude !!}</td>
            <td>{!! $pemandu->latitude !!}</td>
            <td>
                {!! Form::open(['route' => ['pemandus.destroy', $pemandu->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    <a href="{!! route('pemandus.show', [$pemandu->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-eye-open"></i></a>
                    <a href="{!! route('pemandus.edit', [$pemandu->id]) !!}" class='btn btn-default btn-xs'><i class="glyphicon glyphicon-edit"></i></a>
                    {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>