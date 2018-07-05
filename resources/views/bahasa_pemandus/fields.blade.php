<!-- Id Pemandu Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_pemandu', 'Id Pemandu:') !!}
    {!! Form::text('id_pemandu', null, ['class' => 'form-control']) !!}
</div>

<!-- Id Bahasa Field -->
<div class="form-group col-sm-6">
    {!! Form::label('id_bahasa', 'Id Bahasa:') !!}
    {!! Form::text('id_bahasa', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('bahasaPemandus.index') !!}" class="btn btn-default">Cancel</a>
</div>
