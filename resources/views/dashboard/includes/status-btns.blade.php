<div class="btn-group btn-toggle" role="group" aria-label="Status Toggle">
    <button type="button" class="btn {{ $isActive ? 'btn-outline-danger' : 'btn-danger' }}" id="btn-inactive"
        onclick="setStatus('0')">{{ __('static.status.inactive') }}</button>
    <button type="button" class="btn {{ $isActive ? 'btn-primary' : 'btn-outline-primary' }}" id="btn-active"
        onclick="setStatus('1')">{{ __('static.status.active') }}</button>
</div>

<!-- Hidden Input to store the value -->
<input type="hidden" name="status" id="status" value="{{ $isActive ? '1' : '0' }}">

<script>
    // JavaScript to handle status switching
    function setStatus(value) {
        document.getElementById('status').value = value;
        // Toggle button styles
        if (value === '1') {
            document.getElementById('btn-active').classList.remove('btn-outline-primary');
            document.getElementById('btn-active').classList.add('btn-primary');
            document.getElementById('btn-inactive').classList.remove('btn-danger');
            document.getElementById('btn-inactive').classList.add('btn-outline-danger');
        } else {
            document.getElementById('btn-active').classList.remove('btn-primary');
            document.getElementById('btn-active').classList.add('btn-outline-primary');
            document.getElementById('btn-inactive').classList.remove('btn-outline-danger');
            document.getElementById('btn-inactive').classList.add('btn-danger');
        }
    }

    // Automatically set the initial status based on the database value
    document.addEventListener('DOMContentLoaded', function() {
        const initialStatus = document.getElementById('status').value;
        setStatus(initialStatus); // Apply the styles based on the initial value
    });
</script>
