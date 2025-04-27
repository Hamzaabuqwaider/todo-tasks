<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Livewire\Attributes\Layout;
use App\Services\Tasks;
use Livewire\Component;

#[Layout('layouts.app')]
class Index extends Component
{
    public $date_from,$date_to,$status,$user_id,$emailFilter;

    public function render()
    {
        return view('livewire.tasks.index',[
            'tasks' =>$this->query()->paginate(2)
        ]);
    }

    public function query()
    {
        return Tasks::filter(Task::with('user'),[
            'date_from' => $this->date_from,
            'date_to' => $this->date_to,
            'emailFilter' => $this->emailFilter,
        ]);
    }

    public function delete(Task $task)
    {
        $task->delete();

    }
}
