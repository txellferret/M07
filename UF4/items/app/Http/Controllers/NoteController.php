<?php
    namespace App\Http\Controllers;
     
    use Illuminate\Http\Request;
     
    use App\Models\Item;
    use App\Models\Note;
     
    class NoteController extends Controller{
        public function store(Request $request, Item $item) {
            //return $request->all();  //only to test data has been received.
            $note = new Note;
            $note->content = $request->content;
            $item->notes()->save($note);
            //or alternatively:
            //$item->notes()->create(['content' => $request->content]);
            //or with a method addNote in Item:
            $item->addNote($note);
            //return \Redirect::to('url');  //with a facade
            //return redirect('url');   //with function
            return back();  //return back.
        }

        public function list(){
            $data['notes']  = Note::all();  //using model.
            return view('note.list', compact('data'));
        }
        
        public function edit(Note $note) {
            return view('note.form', compact('note'));
        }

        public function update(Request $request, Note $note) {
            try{
                $note->content = $request->content;
                $note->save();
                $notes = Note::all();
                return view('note.list', compact('notes'));

            }catch(\Illuminate\Database\QueryException $ex){ 
                $data['msg'] = "error updating note";
                $data['notes'] = Item::all();  
                return view('note.list', compact('data'));
            }
         }

         public function storee(Request $request, Item $item) {
            //validation:
            $this->validate($request, [
                'content' => 'required|min:10'
            ]);
            $note = new Note;
            $note->content = $request->content;
            $item->addNote($note);
            return back();  //return back.
        }
        public function find($id) {
            $note = Note::find($id);
            //return $item;
            return view('note.form', compact('note'));
        }

        public function delete($id) {
            $note = Note::find($id);
            $note->delete();
            $notes = Note::all();
            return view('note.list', compact('notes'));
            

        }
        
    }


