@extends('dashboard')

@section('title')
Test | {{config('app.name')}}
@endsection

@section('header')

@include('dashboard.partials.header')

@endsection

@section('content')

@component('dashboard.partials.nav-panel')
	
@endcomponent


@component('dashboard.partials.content')
	@slot('headerFA')
		user
	@endslot
	@slot('headerTitle')
		Test
	@endslot
	@slot('content')
		{!! Form::open(['route' => 'test', 'files' => true]) !!}
            <div>
                {!! Form::label('file', 'CSV') !!}
                {!! Form::file('file', old('file')) !!}
                @if ($errors->has('file'))
                    <span class="error">
                        <strong>{{ $errors->first('file') }}</strong>
                    </span>
                @endif
            </div>
        

        	{!! Form::submit('Add') !!}
           
		{!! Form::close() !!}
	@endslot
@endcomponent

@endsection

@section('script')
$(document).ready(function(){
	
});
@endsection