@extends('layouts.app')

@section('title', 'Overview')

@section('content')
	<h1 class="mt-1 mb-3 h3">Available checklists</h1>


	@foreach ($checklists_folder as $folder)


	<div class="card">
		<div class="card-header">
			<a href="{{ url($folder->id) }}">
				{{ $folder->name }}
			</a>
		</div>
	</div>

	@endforeach


	@foreach ($checklists as $checklist)


	<div class="card card-file">
		<div class="card-header">
			<a href="{{ url($checklist->id) }}">
				{{ $checklist->name }}
			</a>
		</div>
	</div>

	@endforeach

@endsection
