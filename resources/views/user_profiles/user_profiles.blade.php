@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                <img src="{!! Storage::disk('s3')->url($user->user_profile->profile_image) !!}">
                <div class="media-body">
                    <div>
                        {{ $user->user_profile->name }}
                    </div>
                    <div>
                        <p>{!! link_to_route('user_profiles.show', 'View profile', ['id' => $user->user_profile->user_id]) !!}</p>
                    </div>
                    @include('user_follow.follow_button', ['user' => $user])
                </div>
            </li>
        @endforeach
    </ul>
@endif