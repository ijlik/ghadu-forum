<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Category;
use App\Ticket;
use App\Answer;

class HomeController extends Controller
{
   
    public function index()
    {
        $ticket = Ticket::all();
        return view('home',[
          'ticket' => $ticket
        ]);
    }
    public function topic()
    {
      $category = Category::all();
      $data = array();
      
      $index = 0;
      for($i=0; $i<ceil($category->count()/3); $i++)
        {
           for($j=0; $j<3; $j++){
             if ($index == $category->count()){
               break;
             }
             $data[$i][$j] = $category[$index++];
           }
        }
      
        return view('topic',[
          'category' => $data
        ]);
    }
  public function showTicket($id)
    {
      $ticket = Ticket::find($id);
      $answer = Answer::where('id_ticket','=', $ticket->id)->get();
        return view('detail',[
          'ticket' => $ticket,
          'answer' => $answer
        ]);
      
    }
    
}
