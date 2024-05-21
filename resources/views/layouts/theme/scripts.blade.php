<script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
@stack('script')
<script src="{{ asset('assets/js/Impresora.js') }}"></script>
<script src="{{ asset('assets/js/Impresora_ie11.js') }}"></script>
<script src="{{ asset('assets/js/script_establecer_impresora_silenciosa.js') }}"></script>
<script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
<script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/app.js') }}"></script>
<script>
    $(document).ready(function() {
        App.init();
    });
</script>
<script src="{{ asset('assets/js/custom.js') }}"></script>
<script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>
<script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
<script src="{{ asset('plugins/nicescroll/nicescroll.min.js') }}"></script>
<script src="{{ asset('plugins/currency/currency.js') }}"></script>

<!--Creamos un script nuevo-->
<script>
    /** Creamos una funcion */
    /** funcion global que envia notificaciones */
    function noty(Msg, option = 1)
    {
        Snackbar.show({
            text: Msg.toUpperCase(),
            actionText: 'CERRAR',
            actionTextColor: '#fff',
            backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
            pos: 'top-right'
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('global-msg', Msg => {
            noty(Msg)
        });
    })

</script>

<script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

@livewireScripts
