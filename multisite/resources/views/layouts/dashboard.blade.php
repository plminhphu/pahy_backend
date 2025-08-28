<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h4 fw-semibold text-dark mb-0">
                {{ __('Dashboard') }}
            </h2>
        </div>
    </x-slot>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0">
                    <div class="card-body">
                        <p class="mb-0 text-dark">
                            {{ __("You're logged in!") }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
