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
            //$item->addNote($note);
            //return \Redirect::to('url');  //with a facade
            //return redirect('url');   //with function
            return back();  //return back.
        }
        public function edit(Note $note) {
            return view('notes.edit', compact('note'));
        }

        public function update(Request $request, Note $note) {
            $note->update($request->all());
            return back(); //redirection
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
    }


