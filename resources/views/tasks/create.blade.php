<x-app-layout>
{{--    @section('title', 'Create Task')--}}
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <div id="kt_content_container" class="container-xxl">
                <div class="card mb-5 mb-xl-10">
                    <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse"
                         data-bs-target="#kt_account_question_details" aria-expanded="true"
                         aria-controls="kt_account_question_details">
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">Create Task</h3>
                        </div>
                    </div>

                    <div class="card-body border-top p-9">
                        @if (session()->has('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="row mb-6">
                                <label for="text" class="col-lg-4 col-form-label required fw-bold fs-6">Text:</label>
                                <div class="col-lg-8 fv-row">
                                    <input type="text" id="text"
                                           name="text"
                                           class="form-control form-control-lg form-control-solid"
                                           value="{{ old('text') }}"
                                           placeholder="Enter task text">
                                    @error('text') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row mb-6">
                                <label for="user_id" class="col-lg-4 col-form-label required fw-bold fs-6">Assign
                                    User:</label>
                                <div class="col-lg-8 fv-row">
                                    <select id="user_id" name="user_id" class="form-select form-control-lg form-control-solid">
                                        <option value="">Select User</option>
                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                                {{ $user->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('user_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-end py-6 px-9">
                                <a href="{{ route('tasks.index') }}" class="btn btn-secondary me-2">Back</a>
                                <button type="submit" class="btn btn-primary">Create Task</button>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
