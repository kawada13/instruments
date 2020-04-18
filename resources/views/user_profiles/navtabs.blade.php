<ul class="nav nav-tabs nav-justified mb-3">
   <li class="nav-item"><a href="{{ route('user_profiles.show', ['id' => $user->id]) }}" class="nav-link {{ Request::is('user_profiles/' . $user->user_profile->id) ? 'active' : '' }}">TimeLine <span class="badge badge-secondary"></span></a></li>
    <li class="nav-item"><a href="{{ route('user_profiles.followings', ['id' => $user->id]) }}" class="nav-link {{ Request::is('user_profiles/*/followings') ? 'active' : '' }}">Followings <span class="badge badge-secondary"></span></a></li>
    <li class="nav-item"><a href="{{ route('user_profiles.followers', ['id' => $user->id]) }}" class="nav-link {{ Request::is('user_profiles/*/followers') ? 'active' : '' }}">Followers <span class="badge badge-secondary"></span></a></li>
    <li class="nav-item"><a href="{{ route('user_profiles.favorites', ['id' => $user->id]) }}" class="nav-link {{ Request::is('user_profiles/*/favorites') ? 'active' : '' }}">Favorites <span class="badge badge-secondary"></span></a></li>
</ul> 
