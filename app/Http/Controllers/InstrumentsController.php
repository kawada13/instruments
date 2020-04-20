<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Instrument;

use App\Comment;

use Storage;

class InstrumentsController extends Controller
{
    public function index()
    {
        $data = [];
       
        if (\Auth::check()) {
            $exist = \Auth::user()->user_profile()->exists();
        
        if (!$exist) {
            return redirect('/user_profiles/create');
        } else {
            
            $user = \Auth::user();
            
             $instruments = Instrument::orderBy('created_at', 'desc')->paginate(10);
            
            $data = [
                'user' => $user,
                'instruments' => $instruments,
            ];
        }
        
        }
        
        return view('welcome', $data);
        
        
    }
    
    public function show($id)
    {
        $instrument = Instrument::find($id);
        

        return view('instruments.show', [
            'instrument' => $instrument,
            
        ]);
    }
    
    public function create()
    {
        $instrument = new Instrument;
        
        return view('instruments.create', [
            'instrument' => $instrument,
        ]);
    }
    
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'type' => 'required|max:191',
            'maker' => 'required|max:191',
            'price' => 'required|max:191',
            'comment' => 'required|max:191',
            'instrument_name' => 'required|max:191',
        ]);
        

        
        
       $request->user()->instruments()->create([
            'type' => $request->type,
            'maker' => $request->maker,
            'price' => $request->price,
            'comment' => $request->comment,
            'instrument_name' => $request->instrument_name,
            'instrument_image' => 'instrument.png',
        ]);
        
        
        return redirect('/');
    }
    
    
    public function image_upload(Request $request)
    {
        
        // 自分のプロフィールかどうかチェックする
        
        
        $instrument = Instrument::where('user_id', \Auth::user()->id)->first();
        
        if (\Auth::id() === $instrument->user_id) {
            
            
            
        $instrument_image = $request->file('instrument_image');
        
        $path = Storage::disk('s3')->putFile('myprefix', $instrument_image, 'public');
        
        $instrument->instrument_image = $path;
        
        // プロフィール画像のアップロード処理
        // S3に保存
        // DBに保存
        $instrument->save();
        
        return redirect('instruments/' . $instrument->user_id);
        
        }
    }
    
    public function destroy($id)
    {
        $instrument = Instrument::where('user_id', $id)->first();

        if (\Auth::id() === $instrument->user_id) {
            $instrument->delete();
        }

        return redirect('/');
    }
    
    public function edit($id)
    {
        $instrument = Instrument::where('user_id', $id)->first();
        
        

        return view('instruments.edit', [
            'instrument' => $instrument,
        ]);
    }
    
    
    public function update(Request $request, $id)
    {
   
        $instrument = Instrument::where('user_id', $id)->first();
        $instrument->type = $request->type;
        $instrument->maker = $request->maker;
        $instrument->instrument_name = $request->instrument_name;
        $instrument->price = $request->price;
        $instrument->comment = $request->comment;
       
        $instrument->save();
        
        
 
        return redirect('instruments/' . $instrument->user_id);
    }
   
}

