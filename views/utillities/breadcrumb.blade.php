<nav class="breadcrumb small" style="background: transparent; padding-left: 0">
  <a class="breadcrumb-item" href="{{ url() }}">Home</a>

  @foreach(return_breadcrumb() as $item)
	  <a class="breadcrumb-item" href="{{ url($item->href) }}">{{ $item->name }}</a>
  @endforeach

</nav>
