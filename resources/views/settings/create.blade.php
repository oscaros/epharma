<x-app-layout :assets="$assets ?? []">
    <!-- Create Settings Form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Create Settings') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.store') }}" class="row g-3 needs-validation" novalidate enctype="multipart/form-data">
                            @csrf

                            <!-- User ID -->
                            <input type="hidden" name="user_id" value="{{ Auth::id() }}">

                            <!-- Milling -->
                            <div class="col-md-6">
                                <label for="milling" class="form-label">{{ __('Milling Price') }} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="milling" name="milling" placeholder="enter value for milling" required>
                                <div class="invalid-feedback">
                                    Please provide a value for milling.
                                </div>
                            </div>

                            <!-- Bag -->
                            <div class="col-md-6">
                                <label for="bag" class="form-label">{{ __('Bag Price') }} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="bag" name="bag" required placeholder="enter value for bag">
                                <div class="invalid-feedback">
                                    Please provide a value for bag.
                                </div>
                            </div>

                            <!-- Box -->
                            <div class="col-md-6">
                                <label for="box" class="form-label">{{ __('Box Price') }} <span class="text-danger">*</span></label>
                                <input type="number" class="form-control" id="box" name="box" required placeholder="enter value for box">
                                <div class="invalid-feedback">
                                    Please provide a value for box.
                                </div>
                            </div>

                            <!-- Formatted Milling -->
                            <div class="col-md-6">
                                <label for="formatted_milling" class="form-label">{{ __('Formatted Milling Price') }}</label>
                                <input type="text" class="form-control" id="formatted_milling" disabled>
                            </div>

                            <!-- Formatted Bag -->
                            <div class="col-md-6">
                                <label for="formatted_bag" class="form-label">{{ __('Formatted Bag Price') }}</label>
                                <input type="text" class="form-control" id="formatted_bag" disabled>
                            </div>

                            <!-- Formatted Box -->
                            <div class="col-md-6">
                                <label for="formatted_box" class="form-label">{{ __('Formatted Box Price') }}</label>
                                <input type="text" class="form-control" id="formatted_box" disabled>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">{{ __('Add New Settings') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of Create Settings Form -->
</x-app-layout>

<script>
    // Format the milling price
    document.getElementById('milling').addEventListener('input', function(event) {
        var millingValue = parseFloat(event.target.value).toLocaleString('en-US', {
            style: 'currency',
            currency: 'UGX'
        });
        document.getElementById('formatted_milling').value = millingValue;
    });

    // Format the bag price
    document.getElementById('bag').addEventListener('input', function(event) {
        var bagValue = parseFloat(event.target.value).toLocaleString('en-US', {
            style: 'currency',
            currency: 'UGX'
        });
        document.getElementById('formatted_bag').value = bagValue;
    });

    // Format the box price
    document.getElementById('box').addEventListener('input', function(event) {
        var boxValue = parseFloat(event.target.value).toLocaleString('en-US', {
            style: 'currency',
            currency: 'UGX'
        });
        document.getElementById('formatted_box').value = boxValue;
    });
</script>