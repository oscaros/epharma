<x-app-layout :assets="$assets ?? []">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('View Settings') }}</div>

                    <div class="card-body">
                        <p><strong>{{ __('Milling') }}:</strong> {{ $settings->milling }}</p>
                        <p><strong>{{ __('Bag') }}:</strong> {{ $settings->bag }}</p>
                        <p><strong>{{ __('Box') }}:</strong> {{ $settings->box }}</p>
                        <p><strong>{{ __('Branch ID') }}:</strong> {{ $settings->branch_id }}</p>
                        <p><strong>{{ __('Business ID') }}:</strong> {{ $settings->business_id }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
