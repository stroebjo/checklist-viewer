@extends('layouts.app')

@section('title')
	{{ $checklist->name }}
@endsection

@section('content')

	<h2 class="mt-1 mb-1">{{ $checklist->name }}</h2>

	@foreach ($checklist->items as $item)

	<div class="card">
		<div class="card-header">
			@if($item->description)
				<div class="float-xs-right">
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
				<div class="p-1">
					{!! $item->descriptionHTML !!}
				</div>
			</div>

		@endif
	</div>


	@endforeach

@endsection
