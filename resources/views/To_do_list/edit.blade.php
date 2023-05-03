@extends('layouts.app')

@section('content')
<section class="vh-100">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-8 col-lg-6">
        <div class="card" style="border-radius: .75rem; background-color: #eff1f2;">
          <div class="card-body py-4 px-4 px-md-5">
            <h2>Edit Task</h2>
            <form action="{{route('tasks.update',[$editTask->id])}}" method="post">
              @csrf
              <div class="modal-body">
                <div class="mb-3">
                  <label for="new-task" class="col-form-label">Enter a task here:</label>
                  <textarea class="form-control" name="new_task" id="new-task" required>{{ old('new_task', isset($editTask) ? $editTask->task_name : '') }}</textarea>
                </div>
                <div class="mb-3">
                  <label for="date" class="col-form-label">Date:</label>
                  <input type="date" class="form-control" name="date" id="date" value="{{ old('date', isset($editTask) ? $editTask->date : '') }}" required>
                </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update Tasks</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
