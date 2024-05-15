{{-- <x-app-layout :assets="$assets ?? []">
    <!-- Role Details -->
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Role Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <p id="name">{{ $role->name }}</p>
</div>
<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <p id="description">{{ $role->description }}</p>
</div>
<div class="mb-3">
    <label for="created_at" class="form-label">Created At</label>
    <p id="created_at">{{ $role->created_at->format('Y-m-d H:i:s') }}</p>
</div>
<div class="mb-3">
    <label for="updated_at" class="form-label">Last Updated At</label>
    <p id="updated_at">{{ $role->updated_at->format('Y-m-d H:i:s') }}</p>
</div>
<div>
    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-primary">Edit</a>
    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger">Delete</button>
    </form>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- End of Role Details -->
</x-app-layout> --}}



<x-app-layout :assets="$assets ?? []">
    <!-- Role Details -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Role Details</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name:</label>
                            <p>{{ $role->name }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <p>{{ $role->description }}</p>
                        </div>
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions:</label>
                            <ul>
                                @foreach ($roles as $key => $value)
                                <li>
                                    <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $key }}" <?= in_array($key, $staff_permissions) ? "checked" : "" ?>>
                                    <span style="font-size:19px; font-weight:bold"><?= $key ?></span>
                                    @if (is_array($value) && !empty($value))
                                    <ul>

                                        @foreach ($value as $key1 => $value1)
                                        <li>
                                            <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $key1 }}" <?= in_array($key, $staff_permissions) ? "checked" : "" ?>>
                                            <span style="font-size:14px; font-weight:bold"><?= $key1 ?></span>
                                            @if (is_array($value) && count($value1))
                                            <ul>
                                                @foreach ($value1 as $item)
                                                <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $item }}" <?= in_array($key, $staff_permissions) ? "checked" : "" ?>>
                                                <span style="font-size:14px;"><?= $item ?></span>
                                                <br />
                                                @endforeach

                                            </ul>
                                            @endif

                                        </li>
                                        @endforeach




                                    </ul>
                                    @endif

                                </li>
                                @endforeach


                            </ul>
                        </div>
                        <a href="{{ route('roles.index') }}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Role Details -->
</x-app-layout>