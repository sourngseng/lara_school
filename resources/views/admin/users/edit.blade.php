@extends('layouts.auth_admin')

@section('title', 'កែប្រែព័ត៌មានអ្នកប្រើប្រាស់')

@push('custom_css')
<!-- Toastr CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content_header')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">កែប្រែ អ្នកប្រើប្រាស់</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">ទំព័រដើម</a></li>
                    <li class="breadcrumb-item active">កែប្រែ អ្នកប្រើប្រាស់</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')

<div class="container-fluid">
    <form id="userForm" enctype="multipart/form-data">
        @csrf
         @method('PUT') <!-- This is necessary for update -->
        <div class="row">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">បញ្ជី អ្នកប្រើប្រាស់</h3>
                    </div>
                    <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="name">ឈ្មោះ</label>
                                        <input type="text" name="name" class="form-control" id="name" value="{{ $user->name }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">អ៊ីមែល</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ $user->email }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="username">ឈ្មោះអ្នកប្រើ</label>
                                        <input type="text" name="username" class="form-control" id="username" value="{{ $user->username }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="telegram_id">Telegram ID</label>
                                        <input type="text" name="telegram_id" class="form-control" id="telegram_id" value="{{ $user->telegram_id }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">លេខសំងាត់</label>
                                        <input type="password" name="password" class="form-control" id="password" >
                                    </div>
                                    <div class="form-group">
                                        <label for="type">ប្រភេទ</label>
                                        <select name="type" class="form-control" id="type">
                                            <option {{ $user->type==0?'selected':'' }} value="0">User</option>
                                            <option {{ $user->type==1?'selected':'' }} value="1">Admin</option>
                                            <option {{ $user->type==2?'selected':'' }} value="2">Super Admin</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="phone">លេខទូរស័ព្ទ</label>
                                        <input type="text" name="phone" class="form-control" id="phone" value="{{ $user->phone }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">អាសយដ្ឋាន</label>
                                        <input type="text" name="address" class="form-control" id="address" value="{{ $user->address }}">
                                    </div>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">បញ្ចូលរូបភាព</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="avatar">រូបសញ្ញា</label>
                            <input type="file" name="avatar" class="form-control" id="avatar" accept="image/*">
                            {{-- <img id="avatarPreview" src="#" alt="Avatar Preview" style="display: none; max-width: 200px; margin-top: 10px;" /> --}}
                            @if($user->avatar)
                                <img id="avatarPreview" src="{{ asset($user->avatar) }}" alt="Avatar Preview" style="max-width: 200px; margin-top: 10px;" />
                            @else
                                <img id="avatarPreview" src="#" alt="Avatar Preview" style="display: none; max-width: 200px; margin-top: 10px;" />
                            @endif
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input type="checkbox" name="status" class="form-check-input" id="status" value="1" {{ $user->status ? 'checked' : '' }} >
                                <label class="form-check-label" for="status">ស្ថានភាព (Active)</label>
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary btn-block" id="updateUser">កែប្រែ</button>
                        {{-- <button type="button" class="btn btn-danger btn-block" id="cancelUser">ត្រឡប់ក្រោយ</button> --}}
                        <a href="{{route('admin.users.index')}}" class="btn btn-danger btn-block">ត្រឡប់ក្រោយ</a>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>
@endsection

@push('custom_js')

<!-- Toastr JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        // Avatar preview
        $('#avatar').change(function() {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#avatarPreview').attr('src', e.target.result).show();
            }
            reader.readAsDataURL(this.files[0]);
        });

        $('#updateUser').on('click', function() {
            var formData = new FormData($('#userForm')[0]);

            $.ajax({
                url: "{{ route('admin.users.update', $user->id) }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        toastr.success('User updated successfully!');
                        setTimeout(function() {
                            window.location.href = "{{ route('admin.users.index') }}";
                        }, 2000);
                    } else {
                        toastr.error('Failed to update user.');
                    }
                },
                error: function(response) {
                    var errors = response.responseJSON.errors;
                    var errorMessages = '';
                    for (var key in errors) {
                        if (errors.hasOwnProperty(key)) {
                            errorMessages += errors[key][0] + '\n';
                        }
                    }
                    toastr.error(errorMessages);
                }
            });
        });
    });
</script>

@endpush
