
@extends('app')

@section('content')
	<h1> Tags Usuarios</h1>

	@foreach ($tags as $index => $tag)
		<li><a href="/tags/{{ $index }}">{{$tag}}</a></li>
	@endforeach
@stop