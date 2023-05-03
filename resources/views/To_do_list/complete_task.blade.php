@extends('layouts.app') 
@section('content') 
<div class="container">
    <section class="vh-100">
      <div class="py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
          <div class="col">
            <div class="card" id="list1" style="border-radius: .75rem; background-color: #eff1f2;">
              <div class="card-body py-4 px-4 px-md-5">
                <p class="h1 text-center mt-3 mb-4 pb-3 text-primary">
                  <i class="fas fa-check-square me-1"></i>
                  <u>My Complete Todo-s</u>
                </p>
                <hr class="my-4">
                <div class="row">
                  <div class="col-md-6">
                    <a href="{{ route('home') }}" class="btn btn-danger">Go Back</a>
                  </div>
                  <div class="col-md-6 d-flex justify-content-end align-items-center pb-1">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Add New</button>
                  </div>
                </div>
                {{-- set Flash message  --}} 
                @if (session()->has('success')) 
                    <div class="alert alert-success">
                        {{ session()->get('success') }}
                    </div>
                @endif
                @if (session()->has('error'))
                   <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div> 
                @endif 
                @foreach($allTask as $key => $item)
                <ul class="list-group list-group-horizontal rounded-0 bg-transparent">
                    <li class="list-group-item d-flex align-items-center ps-0 pe-3 py-1 rounded-0 border-0 bg-transparent">
                     <span>{{$key+1}}</span>
                    </li>
                    <hr class="my-4">
                    <li class="list-group-item px-3 py-1 d-flex align-items-center flex-grow-1 border-0 bg-transparent">
                      <p class="lead fw-normal mb-0">{{ $item->task_name }}</p>
                    </li>
                    @php
                      $currentDate = \Carbon\Carbon::now();
                      $date1 = \Carbon\Carbon::parse($currentDate);
                      $formattedCurrentDate= $date1->format('jS M Y');

                      $date = \Carbon\Carbon::parse($item->date);
                      $formattedDate = $date->format('jS M Y');
                    @endphp 
                    @if($formattedCurrentDate == $formattedDate)
                      <li class="list-group-item px-3 py-1 d-flex align-items-center border-0 bg-transparent">
                          <div class="py-2 px-3 me-2 border border-warning rounded-3 d-flex align-items-center bg-light">
                            <p class="small mb-0">
                              <a href="#!" data-mdb-toggle="tooltip" title="Due on date">
                                <i class="fas fa-hourglass-half me-2 text-warning"></i>
                              </a>
                              {{ $formattedDate }}
                            </p>
                          </div>
                      </li>
                    @endif
                    <li class="list-group-item ps-3 pe-0 py-1 rounded-0 border-0 bg-transparent">
                      <div class="d-flex flex-row justify-content-end mb-1">
                       
                        <a href="{{ route('tasks.destroy', $item->id) }}" class="text-danger" data-mdb-toggle="tooltip" title="Delete todo">
                          <i class="fas fa-trash-alt"></i>
                        </a>
                      </div>
                      <div class="text-end text-muted">
                        <a href="#!" class="text-muted" data-mdb-toggle="tooltip" title="Created date">
                          <p class="small mb-0">
                            <i class="fas fa-info-circle me-2"></i>{{ $formattedDate }}
                          </p>
                        </a>
                      </div>
                    </li>
                  </ul>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add New Task</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="{{route('tasks.store')}}" method="POST">
             @csrf 
            <div class="modal-body">
              <div class="mb-3">
                <label for="new-task" class="col-form-label">Enter a task here:</label>
                <textarea class="form-control" name="new_task" id="new-task" required></textarea>
              </div>
              <div class="mb-3">
                <label for="date" class="col-form-label">Date:</label>
                <input type="date" class="form-control" name="date" id="date" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Tasks</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  @endsection