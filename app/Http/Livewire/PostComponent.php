<?php

namespace App\Http\Livewire;

use App\Post;
use Illuminate\Support\Arr;
use Livewire\Component;

class PostComponent extends Component
{

    public $data, $title, $description, $selected_id;
    public $updateMode = false;
    public $dataTable;
    public $headings = [
        ['key' => 'id', 'value' => 'ID'],
        ['key' => 'title', 'value' => 'Titulo'],
        ['key' => 'description', 'value' => 'Descripcion']
    ];

    public function render()
    {


        $this->data = Post::all()->toArray();
        $this->dataTable = Arr::add($this->dataTable, 'posts', $this->data);
        $this->dataTable = Arr::add($this->dataTable, 'headings', $this->headings);
        $this->data = Post::all();
        $dataset = json_encode($this->dataTable);
        return view('livewire.post-component', compact('dataset'));
    }
    private function resetInput()
    {
        $this->title = null;
        $this->description = null;
    }

    public function store()
    {
        $this->validate([
            'title' => 'required|min:5',
            'description' => 'required'
        ]);

        Post::create([
            'title' => $this->title,
            'description' => $this->description
        ]);

        $this->resetInput();
    }

    public function edit($id)
    {
        $record = Post::findOrFail($id);

        $this->selected_id = $id;
        $this->title = $record->title;
        $this->description = $record->description;

        $this->updateMode = true;
    }

    public function update()
    {
        $this->validate([
            'selected_id' => 'required|numeric',
            'title' => 'required|min:5',
            'description' => 'required'
        ]);

        if ($this->selected_id) {
            $record = Post::find($this->selected_id);
            $record->update([
                'title' => $this->title,
                'description' => $this->description
            ]);

            $this->resetInput();
            $this->updateMode = false;
        }
    }

    public function destroy($id)
    {
        if ($id) {
            $record = Post::where('id', $id);
            $record->delete();
        }
    }
}