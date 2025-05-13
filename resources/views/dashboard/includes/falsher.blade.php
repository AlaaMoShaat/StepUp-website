@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                showCloseButton: true,
                customClass: {
                    popup: 'custom-toast'
                }
            });
        });
    </script>
@endif

@if (session('error'))
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                showCloseButton: true,
                customClass: {
                    popup: 'custom-toast'
                }
            });
        });
    </script>
@endif

<style>
    .custom-toast {
        background-color: #ffffff;
        /* اللون الأبيض */
        color: #0056b3;
        /* الأزرق الداكن */
        border: 1px solid #0056b3;
        /* إطار أزرق */
        font-family: Arial, sans-serif;
        /* خط بسيط */
    }

    .custom-toast .swal2-title {
        font-size: 14px;
        font-weight: bold;
    }

    .custom-toast .swal2-icon {
        color: #0056b3;
        /* تغيير لون الأيقونة */
    }
</style>
