@extends('layouts.app')

@section('title')
	Overview
@endsection

@section('content')
	<h2 class="mt-1 mb-1">Available checklists</h2>

	@foreach ($checklists as $checklist)


	<div class="card">
		<div class="card-header">
			<a href="{{ url($checklist->id) }}">
				{{ $checklist->name }}
			</a>
		</div>
	</div>


	@endforeach

@endsection
