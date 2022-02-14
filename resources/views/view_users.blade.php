@extends('layouts.base')

@section('content')

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(51, 51, 51)">
    <div class="container">
        <a class="navbar-brand" href="#">CRUD App Laravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-flow: row-reverse;">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" aria-current="page" href="/">New User</a></li>
                <li class="nav-item"><a class="nav-link ml-4 active" href="{{url('registered-users')}}">View Users</a></li>
            </ul>
        </div>
    </div>
</nav>
<header class="py-3 bg-image-full" style="background-image: url('https://image.freepik.com/free-vector/blue-wall-with-spot-lights-background_52683-42963.jpg')">
    <div class="text-center my-5 pt-4">
    </div>
</header>
<section class="py-3">
    <div class="container my-3">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <h2>Registered Users</h2>
                <hr>
                <!-- fetch alerts -->
                <div class="form-group">
                    @include('components.alerts')
                </div>

                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">First name</th>
                            <th scope="col">Last name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Contact no</th>
                            <th scope="col">Date of birth</th>
                            <th scope="col">Gender</th>
                            <th scope="col">Account type</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->first_name}}</td>
                            <td>{{$user->last_name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->contact_number}}</td>
                            <td>{{$user->dob}}</td>
                            <td>{{$user->gender}}</td>
                            <td>
                                @if($user->role == 1)
                                    <span class="badge badge-secondary px-2">user</span>
                                @elseif($user->role == 0)
                                    <span class="badge badge-primary px-2">admin</span>
                                @endif
                            </td>
                            <td>
                                <input type="button" class="btn btn-sm btn-success shadow-sm" value="Edit" onclick="showEditModal('{{$user->id}}')">
                                <input type="button" class="btn btn-sm btn-danger shadow-sm" value="Delete" data-toggle="modal" data-target="#deleteModal-{{$user->id}}">
                            </td>

                            <!-- Delete Modal -->
                            <div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Delete Confirmation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('delete-user')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="mb-3">
                                                    <p>Are you sure want to delete this Account ?</p>
                                                    <input type="hidden" class="form-control" name="user_id" value="{{$user->id}}">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Yes</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div class="modal fade" id="editModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{url('edit-user')}}" method="POST">
                                            @csrf
                                            <div class="modal-body">
                                                <input type="hidden" name="user_id" value="{{$user->id}}">
                                                <div class="mb-3">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label for="first_name" class="form-label">First name</label>
                                                            <input type="text" class="form-control" name="first_name" value="{{$user->first_name}}" required>
                                                        </div>
                                                        <div class="col">
                                                            <label for="last_name" class="form-label">Last name</label>
                                                            <input type="text" class="form-control" name="last_name" value="{{$user->last_name}}" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" name="email" value="{{$user->email}}" readonly>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="contact_number" class="form-label">Contact number</label>
                                                    <input type="text" class="form-control" name="contact_number" value="{{$user->contact_number}}" maxlength="12" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="dob" class="form-label">Date of Birth</label>
                                                    <input type="date" class="form-control col-6" name="dob" max="{{ now()->toDateString('Y-m-d') }}" value="{{$user->dob}}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="gender" class="form-label">Gender</label><br>
                                                    <select class="form-select col-4" name="gender">
                                                        <option value="male" selected>Male</option>
                                                        <option value="female" <?php if($user->gender == "female"){ echo "selected"; } ?> >Female</option>
                                                    </select>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">User Role</label><br>
                                                    <select class="form-select col-4" name="role">
                                                        <option value="1" selected>User</option>
                                                        <option value="0" <?php if($user->role=="0"){ echo "selected"; } ?>>Admin</option>
                                                    </select>
                                                </div>
                                                <div class="form-check mb-3">
                                                    <input type="checkbox" name="pwd_check" class="form-check-input exampleCheck1" id="check_id-{{$user->id}}" onclick="isChecked('{{$user->id}}')">
                                                    <label class="form-check-label" for="exampleCheck1">Click to Change password</label>
                                                </div>
                                                <div id="password_section-{{$user->id}}">
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label">New Password</label>
                                                        <input type="password" class="form-control" name="password">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="con_password" class="form-label">Confirm new Password</label>
                                                        <input type="password" class="form-control" name="con_pwd">
                                                    </div>
                                                </div>
                                                <hr>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">Update</button>
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

@endsection
@section('additional-scripts')
<script>

$( document ).ready(function() {

});

function isChecked(id){
    if($("#check_id-"+id).prop('checked') == true){
        $('#password_section-'+id).show();
    }else {
        $('#password_section-'+id).hide();
    }
}

function showEditModal(id){

    isChecked(id);
    $('#editModal-'+id).modal('show');

}

</script>
@endsection

