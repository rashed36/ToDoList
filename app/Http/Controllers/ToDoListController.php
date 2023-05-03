<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Auth;

class ToDoListController extends Controller
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Data Validation.
        $request->validate([
            'new_task' => 'required',
            'date' => 'required|date',
        ]);

        // Insert Data In Database.
        $toDoList = new ToDoList();
        $toDoList->user_id = Auth::id();
        $toDoList->task_name = $request->new_task;
        $toDoList->date = $request->date;
        $toDoList->save();
        if($toDoList->save()){
            // Set the success message
            $message = 'New Task Added Successfully';

            return redirect()->route('home')->with('success', $message);
        }else{
           // Set the Error message
           $message = 'Data saved successfully';

           return redirect()->route('home')->with('error', $message);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $data['allTask'] = ToDoList::where('user_id',Auth::user()->id)->where('status',0)->orderBy('date', 'ASC')->get();
        return view('To_do_list.complete_task',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['editTask'] = ToDoList::find($id);
        return view('To_do_list.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Data Validation.
        $request->validate([
            'new_task' => 'required',
            'date' => 'required|date',
        ]);
        // Task Updated.
        $data = ToDoList::find($id);
        $data->task_name = $request->new_task;
        $data->date = $request->date;
        if($data->user_id == Auth::id()){
            $data->save();
            $message = 'Task Updated successfully';

            return redirect()->route('home')->with('success', $message);
        }else{
            $message = 'Task Update Not Posible!';

           return redirect()->route('home')->with('error', $message);
        }
    }

    /**
     * Show the form for completing task todo list.
     *
     * @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $data = ToDoList::find($id);
        $data->status = 0;
        if($data->user_id == Auth::id()){
            $data->save();
            $message = 'Task Are Completed successfully';

            return redirect()->back()->with('success', $message);
        }else{
            $message = 'Task Update Not Posible!';

           return redirect()->back()->with('error', $message);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ToDoList::findOrFail($id);
        if($data->user_id == Auth::id()){  

            $data->delete();
            $message = 'Task Deleted successfully';

            return redirect()->back()->with('error', $message);
        }else{
           
            $message = 'Task Deleted Not Posible!';

           return redirect()->back()->with('error', $message);
        }
       
    }
}
