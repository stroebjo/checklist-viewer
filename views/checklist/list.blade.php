@extends('layouts.app')

@section('title', 'Overview')

@section('content')
	<h2 class="mt-1 mb-1">Available checklists</h2>


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
