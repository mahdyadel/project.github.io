<?php

namespace App\Http\Controllers\Dashboard;

use App\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class taskController extends Controller
{   
    public function index(Request $request)
    {
        $tasks = Task::when($request->search, function ($q) use ($request) {

                return $q->where('name', 'like', '%' . $request->search . '%');
                
            })->latest()->paginate(5);

        return view('dashboard.tasks.index', compact('tasks'));

    }//end of index
    public function create()
    {
        return view('dashboard.tasks.create');

    }//end of create
    public function store(Request $request)
    {
        $rules = [

            'name' => 'required',
            'title' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'total' => 'required',
            'credit' => 'required',

        ];
        $msg =  [
           
            'name.required' => ' الاسم ',
            'title.required' => ' العنوان',
            'email.required' => ' البريد الالكترونى',
            'phone.required' => ' رقم الهاتف',
            'total.required' => 'الاجمالى',
            'credit.required' => 'فيزا كارد',

            
        ];
        $this->validate($request , $rules , $msg);


        Task::create($request->all());
        session()->flash('success', __('site.added_successfully'));
        return redirect()->route('dashboard.tasks.index');

    }//end of store

    public function edit(Task $tasks , $id)
    {
        $tasks = Task::findOrFail($id);
        return view('dashboard.tasks.edit', compact('tasks'));

    }//end of edit

    public function update(Request $request, Task $task )
    {
        $rules = [

            'name' => 'required',
            'title' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'total' => 'required',
            'credit' => 'required',
        ];
        $msg =  [
           
            'name.required' => ' الاسم ',
            'title.required' => ' العنوان',
            'email.required' => ' البريد الالكترونى',
            'phone.required' => ' رقم الهاتف',
            'total.required' => 'الاجمالى',
            'credit.required' => 'فيزا كارد',

            
        ];
        $this->validate($request , $rules , $msg);

        $task->update($request->all());
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('dashboard.tasks.index');

    }//end of update

    public function destroy(Task $task)
    {
        $task->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.tasks.index');

    }//end of destroy

}//end of controller

