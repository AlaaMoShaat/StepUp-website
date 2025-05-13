@if (session('success'))
    <div class="row mt-1">
        <button class="btn-outline-success" id="type-success">
            {{ session('success') }}
        </button>
    </div>
@endif
