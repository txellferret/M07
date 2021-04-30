<?php
     
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Item;
use App\Models\Note;
class ItemController extends Controller {
    public function index() {
        //return 'Item page';
        return view('item.index');
    }
    public function list() {
        $data['items']  = Item::all();  //using model.
        return view('item.list', compact('data'));
    }
    

    public function find($id) {
        $item = Item::find($id);
        //return $item;
        return view('item.form', compact('item'));
    }

    public function addNote(Note $note) {
        return $this->notes()->save($note);
    }

    public function delete($id) {

        try{
            $item = Item::find($id);
            $item->delete();
            $data['items'] = Item::all();  //using model.
            return view('item.list', compact('data'));

        } catch(\Illuminate\Database\QueryException $ex){ 
            $data['msg'] = "error deleting item";
            $data['items'] = Item::all();  
            return view('item.list', compact('data'));
        }
    }

    public function addForm(){
        return view('item.addform');
    }

    public function store (Request $request) {
        try{
            $item = new Item;
            $item->title = $request->title;
            $item->content = $request->content;
            $item->save();
            $data['items'] = Item::all();  
            return view('item.list', compact('data'));
        } catch(\Illuminate\Database\QueryException $ex){ 
            $data['msg'] = "Error creating item";  
            return view('item.addform', compact('data'));
        }
        
    }

    public function update(Request $request, Item $item) {
        try{
            $item->title = $request->title;
            $item->content = $request->content;
            $item->save();
            $data['items']  = Item::all();  //using model.
            return view('item.list', compact('data'));
        } catch(\Illuminate\Database\QueryException $ex){ 
            $data['msg'] = "error updating item";
            $data['items'] = Item::all();  
            return view('item.list', compact('data'));
        }
     }
    
 
}

