<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.livewire.on('show-modal', Msg => {
            $('#theModal').modal('show');
        });
        window.livewire.on('category-added', Msg => {
            $('#theModal').modal('hide');
            noty(Msg)
        });
        window.livewire.on('category-updated', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('category-deleted', Msg => {
            $('#theModal').modal('hide')
            noty(Msg)
        });
        window.livewire.on('scan-ok', Msg => {
            noty(Msg)
        })
        window.livewire.on('search-product', Msg => {
            noty(Msg)
        })
        window.livewire.on('clear-efecty', Msg => {
            noty(Msg)
        })
        window.livewire.on('scan-notfound', Msg => {
            noty(Msg, 2)
        })
        window.livewire.on('no-stock', Msg => {
            noty(Msg, 2)
        })
        window.livewire.on('no-stock-WP', Msg => {
            noty(Msg, 2)
        })
        window.livewire.on('sale-error', Msg => {
            noty(Msg, 2)
        })
        ///modal mensaje fronted
        window.livewire.on('sale-ok', Msg => {
            noty(Msg)
        })
        ///impresión de Tickets
        window.livewire.on('print-ticket', saleId => {
            console.log('print-ticket');
            window.open("print://" + saleId, '_self').close()
        })
    })

</script>
