@extends('adminlte::page')

@section('title', 'Cadastro')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Cadastro</h3>
        </div>
        <div class="card-body">

            @if(isset($contato))
                {!! Form::model($contato,['url' => route('contato.update' ,$contato), 'method'=>'put','files' => 'true'])!!}
            @else 
                {!! Form::open(['url'=>route('contato.store')])!!}
            @endif
                <div class="form-group">
                    {!! Form::label('nome', 'Nome')!!}
                    {!! Form::text('nome',null, ['class'=>'form-control','required']) !!}
                    @error('nome') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form:: label('email', 'E-mail') !!}
                    {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                    @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('idade', 'idade')!!}
                    {!! Form::text('idade',null, ['class'=>'form-control','required']) !!}
                    
                    @error('idade') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>
                <div class="form-group">
                    {!! Form::label('formacao','Formação ')!!}
                    {!! Form::select('formacao', array(
                            'pos_graduado' => 'Pós Graduado',
                            'graduado' => 'Graduado',
                            'nivel_medio' => 'Nível Médio',
                            'nivel_tecnico' => 'Nível Técnico',
                ),['class'=>'form-control']);!!}
                    @error('formacao') <span class= "text-danger">{{ $message}}</span> @enderror
                </div>


                {!! Form::submit('Salvar', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}

        </div>
    </div>
@stop

@section('css')
 
@stop

@section('js')
  
@stop