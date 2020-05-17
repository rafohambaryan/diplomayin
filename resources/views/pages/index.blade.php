@extends('layouts.app')
@section('content')
    @auth
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Իմ բոլոր պրեզենտացիաները</h2>
                        </div>
                        <div class="col-sm-6">
                            <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i
                                    class="material-icons">&#xE147;</i> <span>Add New Employee</span></a>
                            <a href="#" class="btn btn-danger delete-present" data-count="all" data-toggle="modal"><i
                                    class="material-icons">&#xE15C;</i> <span>Delete</span></a>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover table-presents">
                    <thead>
                    <tr>
                        <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
                        </th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Url</th>
                        <th>Settings</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($presents as $present)
                        <tr id="present_{{$present->id}}">
                            <td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox_{{$present->id}}" name="options[]" value="1">
								<label for="checkbox_{{$present->id}}"></label>
							</span>
                            </td>
                            <td class="id-present">{{$present->id}}</td>
                            <td class="present-name">{{$present->name}}</td>
                            <td><a href="{{url("/present/{$present->url}")}}" target="_blank"><i class="material-icons">&#xe417;</i></a>
                            </td>
                            <td><a href="{{url("/setting/{$present->id}")}}" class="settings"><i class="material-icons"
                                                                                                  title="Settings">&#xe8b8;</i></a>
                            </td>
                            <td>
                                <a href="" class="edit edit-present-name" data-toggle="modal"><i class="material-icons"
                                                                                                 data-toggle="tooltip"
                                                                                                 title="Edit">&#xE254;</i></a>
                                <a href="#" class="delete delete-present" data-count="one" data-toggle="modal"><i
                                        class="material-icons"
                                        data-toggle="tooltip"
                                        title="Delete">&#xE872;</i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="clearfix">
                    {{$presents->links()}}
                </div>
            </div>
        </div>
        <!-- Edit Modal HTML -->
        <div id="addEmployeeModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{url('/create-present')}}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h4 class="modal-title">Add Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="name-present">Name</label>
                                <input type="text" class="form-control" id="name-present" name="name" required
                                       placeholder="Name...">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endauth
@endsection
