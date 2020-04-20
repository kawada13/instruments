<div class="card">
  <img src="{!! Storage::disk('s3')->url($user->user_profile->profile_image) !!}" class="card-img-top" alt="...">
  <h5 class="card-header">{{ $user->user_profile->name }}</h5>
  <div class="card-body">
    <h5 class="card-title">性別</h5>
    <p class="card-text">{{ $user->user_profile->gender }}</p>
    <h5 class="card-title">出身地</h5>
    <p class="card-text">{{ $user->user_profile->birth_place }}</p>
    <h5 class="card-title">一言</h5>
    <p class="card-text">{{ $user->user_profile->comment }}</p>
  </div>
</div>
@include('user_follow.follow_button', ['user' => $user])