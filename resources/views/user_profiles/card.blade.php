<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->user_profile->name }}</h3>
        <h3 class="card-title">{{ $user->user_profile->gender }}</h3>
        <h3 class="card-title">{{ $user->user_profile->birth_place }}</h3>
        <h3 class="card-title">{{ $user->user_profile->comment }}</h3>
    </div>
    <div class="card-body">
     <img src="{!! Storage::disk('s3')->url($user->user_profile->profile_image) !!}">
    </div>
</div>
@include('user_follow.follow_button', ['user' => $user])