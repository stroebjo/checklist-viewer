@extends('layouts.app')

@section('title')
	{{ $checklist->name }}
@endsection

@section('content')

	<header class="mt-1 mb-2">
		<h1 class="h3">{{ $checklist->name }}</h1>

		<i class="text-muted small">
			Last edited at <time data-toggle="tooltip" title="{{ date('c', $checklist->changed) }}" datetime="{{ date('c', $checklist->changed) }}">{{ date('Y-m-d', $checklist->changed) }}</time>.
		</i>
	</header>

	@foreach ($checklist->items as $item)

	<div class="card">
		<div class="card-header">
			@if($item->description)
				<div class="float-right">
					<button class="btn btn-sm btn-link" type="button" data-toggle="collapse" data-target="#checklistItem{{$loop->index}}" aria-expanded="false" aria-controls="checklistItem{{$loop->index}}">
						Details
					</button>
				</div>
			@endif

			<label class="custom-control custom-checkbox mb-0">
				<input type="checkbox" class="custom-control-input">
				<span class="custom-control-indicator"></span>
				<span class="custom-control-description">
					<b>{{$loop->iteration}}.</b>
					{!! $item->nameHTML !!}
				</span>
			</label>
		</div>

		@if($item->description)

			<div class="collapse" id="checklistItem{{$loop->index}}">
				<div class="px-3 pt-3">
					{!! $item->descriptionHTML !!}
				</div>
			</div>

		@endif
	</div>


	@endforeach

	<nav class="navbar navbar-light navbar-toggleable-md mt-1">
		<ul class="navbar-nav ">
			<li class="nav-item">
				<a class="nav-link" download href="{{ url($checklist->path) }}">Download</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" onclick="window.print();">Print</a>
			</li>
		</ul>
	</nav>

@endsection
