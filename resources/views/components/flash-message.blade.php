@if (session('success'))
    <div
        x-data="{ show: true }"
        x-show="show"
        class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700">

        <div class="flex items-center justify-between gap-4">

            <p>
                {{ session('success') }}
            </p>

            <button
                type="button"
                @click="show = false"
                class="text-green-700 hover:text-green-900">
                &times;
            </button>

        </div>

    </div>
@endif