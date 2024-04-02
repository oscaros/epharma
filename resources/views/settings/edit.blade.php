
<x-app-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Settings') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('settings.update', $settings->id) }}">
                            @csrf
                            @method('PUT')

                            <!-- Milling -->
                            <div class="mb-3">
                                <label for="milling" class="form-label">{{ __('Milling') }}</label>
                                <input type="text" class="form-control" id="milling" name="milling" value="{{ $settings->milling }}" required>
                            </div>

                            <!-- Bag -->
                            <div class="mb-3">
                                <label for="bag" class="form-label">{{ __('Bag') }}</label>
                                <input type="text" class="form-control" id="bag" name="bag" value="{{ $settings->bag }}" required>
                            </div>

                            <!-- Box -->
                            <div class="mb-3">
                                <label for="box" class="form-label">{{ __('Box') }}</label>
                                <input type="text" class="form-control" id="box" name="box" value="{{ $settings->box }}" required>
                            </div>

                            <!-- Branch ID -->
                            <div class="mb-3">
                                <label for="branch_id" class="form-label">{{ __('Branch ID') }}</label>
                                <input type="text" class="form-control" id="branch_id" name="branch_id" value="{{ $settings->branch_id }}" required>
                            </div>

                            <!-- Business ID -->
                            <div class="mb-3">
                                <label for="business_id" class="form-label">{{ __('Business ID') }}</label>
                                <input type="text" class="form-control" id="business_id" name="business_id" value="{{ $settings->business_id }}" required>
                            </div>

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
