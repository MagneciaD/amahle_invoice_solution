<!-- Search Results Modal -->
<div class="modal fade" id="searchResultsModal" tabindex="-1" aria-labelledby="searchResultsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchResultsModalLabel">Search Results</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5>Clients</h5>
                <ul>
                    @foreach ($clients as $client)
                        <li>{{ $client->name }}</li>
                    @endforeach
                </ul>
                <h5>Invoices</h5>
                <ul>
                    @foreach ($invoices as $invoice)
                        <li>{{ $invoice->invoice_type }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
