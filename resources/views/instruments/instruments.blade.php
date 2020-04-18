<ul class="list-unstyled">
    @foreach ($instruments as $instrument)
        <li class="media mb-3">
            <img class="mr-2 rounded" src="{!! Storage::disk('s3')->url($instrument->instrument_image); !!}">
            <div class="media-body">
                <div>
                    {!! link_to_route('user_profiles.show', $instrument->user->user_profile->name, ['id' => $instrument->user->user_profile->user_id]) !!} <span class="text-muted">posted at {{ $instrument->created_at }}</span>
                </div>
                <div>
                    <p class="mb-0">{!! link_to_route('instruments.show', $instrument->instrument_name, ['id' => $instrument->id]) !!}</p>
                </div>
            </div>
        </li>
        @include('instrument_favorite.favorite_button', ['instrument' => $instrument])
    @endforeach
</ul>
{{ $instruments->links('pagination::bootstrap-4') }}