<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\UserProfile;

use App\User;
use App\Instrument;

use Storage;

class UserProfilesController extends Controller
{
    public function index()
    {
        $users = User::orderBy('id', 'desc')->paginate(10);

        return view('user_profiles.index', [
            'users' => $users,
        ]);
    }
    
    public function show($id)
    {
       
        
        $user = User::find($id);
        $instruments = $user->feed_instruments()->orderBy('created_at', 'desc')->paginate(10);

        return view('user_profiles.show', [
            'user' => $user,
            'instruments' => $instruments,
        ]);
    }
    
    
    public function create()
    {
        $user_profile = new UserProfile;
        
        return view('user_profiles.create', [
            'user_profile' => $user_profile,
        ]);
    }
    
    
    
    
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:191',
            'gender' => 'required|max:191',
            'birth_place' => 'required|max:191',
            'comment' => 'required|max:191',
        ]);
        
        
        
       $request->user()->user_profile()->create([
            'name' => $request->name,
            'gender' => $request->gender,
            'profile_image' => 'profile.png',
            'birth_place' => $request->birth_place,
            'comment' => $request->comment,
        ]);
        
        
        return redirect('/');
    }
    
    
    public function edit($id)
    {
        $user_profile = UserProfile::where('user_id', $id)->first();
        
        

        return view('user_profiles.edit', [
            'user_profile' => $user_profile,
        ]);
    }
    
    
    public function update(Request $request, $id)
    {
   
        $user_profile = UserProfile::where('user_id', $id)->first();
        $user_profile->name = $request->name;
        $user_profile->gender = $request->gender;
        $user_profile->birth_place = $request->birth_place;
        $user_profile->comment = $request->comment;
        
       
        $user_profile->save();
        
        
 
        return redirect('/user_profiles/' . $user_profile->user_id);
    }
    
    public function image_upload(Request $request)
    {
        
        // 自分のプロフィールかどうかチェックする
        
        
        $user_profile = UserProfile::where('user_id', \Auth::user()->id)->first();
        
        if (\Auth::id() === $user_profile->user_id) {
            
            
            
        $profile_image = $request->file('profile_image');
        
        $path = Storage::disk('s3')->putFile('myprefix', $profile_image, 'public');
        
        $user_profile->profile_image = $path;
        
        // プロフィール画像のアップロード処理
        // S3に保存
        // DBに保存
        $user_profile->save();
        
        return redirect('user_profiles/' . $user_profile->user_id);
        
        }
    }
    
    
    public function followings($id)
    {
        $user = User::find($id);
        $followings = $user->followings()->paginate(10);

        $data = [
            'users' => $followings,
            'user' => $user,
        ];

        $data += $this->counts($user);

        return view('user_profiles.followings', $data);
    }

    public function followers($id)
    {
        $user= User::find($id);
        $followers = $user->followers()->paginate(10);

        $data = [
            'users' => $followers,
            'user' => $user,
        ];

        $data += $this->counts($user);

        return view('user_profiles.followers', $data);
    }
    
    public function favorites($id)
    {
        $user = User::find($id);
        $favorites = $user->favorites()->paginate(10);

        $data = [
            'user' => $user,
            'instruments' => $favorites,
        ];

        $data += $this->counts($user);

        return view('user_profiles.favorites', $data);
    }
    
}
