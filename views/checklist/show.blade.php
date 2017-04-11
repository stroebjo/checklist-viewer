@extends('layouts.app')

@section('title')
	{{ $checklist->name }}
@endsection

@section('head')
<script>


	var checklist = {
		name: {!! json_encode($checklist->name) !!},

		items: {!! json_encode($checklist->getItems()) !!}
	};

</script>
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

			@if (getenv('TRELLO_APP_KEY'))
			<li class="nav-item">
				<a class="nav-link js-trello-open_modal" href="#">Add to Trello</a>
			</li>
			@endif

			<li class="nav-item">
				<a class="nav-link" download href="{{ url($checklist->path) }}">Download</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="#" onclick="window.print();">Print</a>
			</li>
		</ul>
	</nav>


<div class="modal" id="modal-trello" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add to Trello</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>

			<div class="modal-body">

				<div class="form-group row">
					<label for="trello-boards" class="col-4 col-form-label">Your boards</label>

					<div class="col-8">
						<select id="trello-boards" class="custom-select w-100 js-trello-boards">
							<option value="false">- Select -</option>
						</select>
					</div>
				</div>

				<div class="form-group row">
					<label for="trello-lists" class="col-4 col-form-label">List on the board</label>

					<div class="col-8">
						<select id="trello-lists" class="custom-select w-100 js-trello-lists">
							<option>- select a board first-</option>
						</select>
					</div>
				</div>



				<div class="form-group row">

					<div class="col-8 push-4">
						<div class="form-check">
							<label class="form-check-label">
								<input class="form-check-input js-trello-individual" type="checkbox"> Create individual cards instead of a checklist on a single card.							</label>
						</div>
					</div>
				</div>


			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary js-trello-add_cards">Add to Trello</button>

				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


@endsection
