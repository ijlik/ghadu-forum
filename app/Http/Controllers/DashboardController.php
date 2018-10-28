<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Category;
use App\Ticket;
use App\Answer;
use App\Like;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
      $user = User::find(Auth::user()->id);
      return view('profile',[
        'user' => $user,
        'status' => null,
        'message' => 0
      ]);
    }
    public function updateProfile(Request $request)
    {
      $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6|confirmed',
      ]);
      
      $user = User::find(Auth::user()->id);
      $user->name = $request->name;
      $user->password = bcrypt($request->password);
      if ($user->save()){
        return view('profile',[
          'user' => $user,
          'status' => 'success',
          'message' => 'Your information has ben updated'
        ]);
      } else {
        return view('profile',[
          'user' => $user,
          'status' => 'danger',
          'message' => 'Iam sorry, there is some problem, please try again'
        ]);
      }
      
      
    }
    public function updatePictureProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);
        $file       = $request->file('myfile');
        $fileName   = $file->getClientOriginalName();
        $path = public_path()."/assets/images/uploads/";
        $request->file('myfile')->move($path, $fileName);

        $user->avatar = $fileName;
        $user->save();
      return redirect()->back();
    }
    public function updateInfo(Request $request){
      $request->validate([
            'nik' => 'required|string|max:16',
            'alamat' => 'required|string|min:6',
            'no_telp' => 'required|string|min:6',
            'pekerjaan' => 'required|string',
      ]);
      
      $user = User::find(Auth::user()->id);
      $user->nik = $request->nik;
      $user->alamat = $request->alamat;
      $user->no_telp = $request->no_telp;
      $user->pekerjaan = $request->pekerjaan;
      if ($user->save()){
        return view('profile',[
          'user' => $user,
          'status' => 'success',
          'message' => 'Your information has ben updated'
        ]);
      } else {
        return view('profile',[
          'user' => $user,
          'status' => 'danger',
          'message' => 'I am sorry, there is some problem, please try again later'
        ]);
      }
    }
  
    public function listTicket()
    {
      $category = Category::all();
      $ticket = Ticket::where('id_user','=', Auth::user()->id)->orderBy('created_at','desc')->get();
      return view('ticket',[
        'category' => $category,
        'ticket' => $ticket,
        'status' => null
      ]);
    }
    public function createTicket(Request $request)
    {
      
      $ticket = new Ticket();
      $ticket->id_user = Auth::user()->id;
      $ticket->id_category = $request->id_category;
      $ticket->title = $request->title;
      $ticket->detail = $request->detail;
          
      if ($ticket->save()){
         $category = Category::all();
      $tickets = Ticket::where('id_user','=', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('ticket',[
          'category' => $category,
        'ticket' => $tickets,
          'status' => 'success',
          'message' => 'Your ticket has ben submited'
        ]);
      } else {
         $category = Category::all();
      $tickets = Ticket::where('id_user','=', Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('ticket',[
          'category' => $category,
        'ticket' => $tickets,
          'status' => 'danger',
          'message' => 'I am sorry, there is some problem, please try again later'
        ]);
      }
      
    }
   public function deleteTicket($id)
    {
      $ticket = Ticket::find($id);
      
      if (Auth::user()->id == $ticket->id_user){
        $ticket->delete();
        return redirect()->to('/my-ticket');
      } else {
        return view('404');
      }
      
    }
  public function reply(Request $request)
  {
    $answer = new Answer();
    $answer->id_ticket = $request->id_ticket;
    $answer->id_user = Auth::user()->id;
    $answer->jawaban = $request->jawaban;
    $answer->is_valid = 0;
    $answer->save();
    return redirect()->to('/ticket/'.$request->id_ticket);
  }
  
  public function like($id)
  {
    $like = Like::where('id_ticket','=',$id)->where('id_user','=',Auth::user()->id)->first();
    if(is_null($like)){
      $insert = new Like();
      $insert->id_ticket = $id;
      $insert->id_user = Auth::user()->id;
      $insert->is_like = 1;
      $insert->save();
    } else {
      $like->id_ticket = $id;
      $like->id_user = Auth::user()->id;
      $like->is_like = 1;
      $like->save();
    }
    return redirect()->back();
  }
  
  public function unlike($id)
  {
    $like = Like::where('id_ticket','=',$id)->where('id_user','=',Auth::user()->id)->first();
    if(is_null($like)){
      $insert = new Like();
      $insert->id_ticket = $id;
      $insert->id_user = Auth::user()->id;
      $insert->is_like = 0;
      $insert->save();
    } else {
      $like->id_ticket = $id;
      $like->id_user = Auth::user()->id;
      $like->is_like = 0;
      $like->save();
    }
    return redirect()->back();
  }
  
}
