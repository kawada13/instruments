<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Instrument; 
use App\Comment;

class CommentsController extends Controller
{
    public function store(Request $request)
    {
       
        $this->validate($request, [
            'comment' => 'required|max:191',
            ]);
            
        
          
       $instrument = Instrument::where('user_id', $request->instrument_id)->first();
       $request->user()->comments()->create([
            'comment' => $request->comment,
            'instrument_id' => $request->instrument_id,
        ]);
        
        
        return redirect('instruments/' . $instrument->user_id);
        
    }
    
    
    public function destroy($id)
    {
        $instrument = Instrument::where('user_id', $id)->first();
        $comment = Comment::where('user_id', \Auth::user()->id)->first();

        if (\Auth::id() === $comment->user_id) {
            $comment->delete();
        }

        return redirect('instruments/' . $instrument->user_id);
       
    }
}
