<x-app-layout :assets="$assets ?? []">
    <!-- Edit Role Form -->
    <div class="container">
        <div class="row">
            <div class="col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Role</h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('roles.update', $role->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name:</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description:</label>
                                <input type="text" class="form-control" id="description" name="description" value="{{ $role->description }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="permissions" class="form-label">Permissions:</label>
                                <div class="row">
                                    <ul>
                                        @foreach ($roles as $key => $value)
                                        <li>
                                            <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $key }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                            <span style="font-size:19px; font-weight:bold"><?= $key ?></span>
                                            @if (is_array($value) && !empty($value))
                                            <ul>

                                                @foreach ($value as $key1 => $value1)
                                                <li>
                                                    <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $key1 }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
                                                    <span style="font-size:14px; font-weight:bold"><?= $key1 ?></span>
                                                    @if (is_array($value) && count($value1))
                                                    <ul>
                                                        @foreach ($value1 as $item)
                                                        <input type="checkbox" name="persmissions_menu[]" id="" value="{{ $item }}" <?= in_array($key, $permissions) ? "checked" : "" ?>>
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
                            </div>
                            <button type="submit" class="btn btn-primary">Update Role</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Edit Role Form -->
</x-app-layout>
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