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
            
        
          
       $instrument = Instrument::find($request->instrument_id);
       $request->user()->comments()->create([
            'comment' => $request->comment,
            'instrument_id' => $request->instrument_id,
        ]);
        
        
        return redirect('instruments/' . $instrument->id);
        
    }
    
    
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $instrumentId = $comment->instrument_id;

        if (\Auth::id() === $comment->user_id) {
            $comment->delete();
        }

        return redirect('instruments/' . $instrumentId);
       
    }
}
