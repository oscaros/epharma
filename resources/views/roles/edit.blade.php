<x-app-layout :assets="$assets ?? []">
    <!-- Edit Role Form -->
    <div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">
        <div class="grid grid-cols-1">
            <div class="col-span-1 md:col-span-3">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <div class="mb-6">
                        <h5 class="text-lg font-semibold justify-center">Edit Role</h5>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $role->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <input type="text" class="form-control" id="description" name="description"
                                    value="{{ $role->description }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permissions:</label>
                                <div class="row">
                                    <ul>
                                        @foreach ($roles as $key => $value)
                                            <li style="padding-left: 20px;"> <!-- Adjust padding as needed -->
                                                <input type="checkbox" name="permissions_menu[]" id=""
                                                    value="{{ $key }}"
                                                    <?= in_array($key, $permissions) ? 'checked' : '' ?>>
                                                <span style="font-size:19px; font-weight:bold">{{ $key }}</span>
                                                @if (is_array($value) && !empty($value))
                                                    <ul>

                                                        @foreach ($value as $key1 => $value1)
                                                            <li style="padding-left: 20px;"> <!-- Adjust padding as needed -->
                                                                <input type="checkbox" name="permissions_menu[]"
                                                                    id="" value="{{ $key1 }}"
                                                                    <?= in_array($key, $permissions) ? 'checked' : '' ?>>
                                                                <span
                                                                    style="font-size:14px; font-weight:bold">{{ $key1 }}</span>
                                                                @if (is_array($value) && count($value1))
                                                                    <ul>
                                                                        @foreach ($value1 as $item)
                                                                            <li style="padding-left: 20px;"> <!-- Adjust padding as needed -->
                                                                                <input type="checkbox"
                                                                                    name="permissions_menu[]"
                                                                                    id=""
                                                                                    value="{{ $item }}"
                                                                                    <?= in_array($key, $permissions) ? 'checked' : '' ?>>
                                                                                <span
                                                                                    style="font-size:14px;">{{ $item }}</span>
                                                                                <br />
                                                                            </li>
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
                            </div>
                            <button type="submit" class="btn btn-primary bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Update Role</button>
                        </form>
                    </div>

                </div>
            </div>
            <!-- End of Edit Role Form -->
        </div>
    </div>
</x-app-layout>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script>
    // jQuery Code starts from here

    $(function() {
        $("input[type='checkbox']").change(function() {
            $(this).siblings('ul')
                .find("input[type='checkbox']")
                .prop('checked', this.checked);

        });
    });
</script>
