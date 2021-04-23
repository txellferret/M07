<?php
     
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Item;
 
class ItemController extends Controller
{
    public function index() {
        //return 'Item page';
        return view('item.index');
    }
    /*
    public function list() {
        $items = ['Item1', 'Item2', 'Item3'];
        //$items = [];
        return view('item.list', compact('items'));
    }
*/
    public function list() {
        //$items = ['Item1', 'Item2', 'Item3'];  //using array with mock data
        //$items = [];  //using empty array
        //$items = DB::table('items')->get(); //using database
        $items = Item::all();  //using model.
        return view('item.list', compact('items'));
    }
    /*
    public function list() {
        //$items = ['Item1', 'Item2', 'Item3'];  //using array with mock data
        //$items = [];  //using empty array
        $items = \DB::table('items')->get(); //using database
        return view('item.list', compact('items'));
    }
    */

    public function find($id) {
        $item = Item::find($id);
        //return $item;
        return view('item.form', compact('item'));
    }

    public function addNote(Note $note) {
        return $this->notes()->save($note);
    }
 
}

