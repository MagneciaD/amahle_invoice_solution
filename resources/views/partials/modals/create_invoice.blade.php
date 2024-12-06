<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<!-- resources/views/partials/modals/create_invoice_modal.blade.php -->
<div class="modal fade" id="createInvoiceModal" tabindex="-1" aria-labelledby="createInvoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-gradient-to-r from-green-200 to-white p-4 rounded-t-lg">
                <h5 class="modal-title text-xl font-bold" id="createInvoiceModalLabel">Create Invoice</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('invoices.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="company_id" value="{{ $company->id }}">

                    <div class="form-group">
                        <label for="invoice_type" class="form-label" style="color: black;"></label>
                        <div class="btn-group-vertical" role="group" aria-label="Invoice Type Buttons">
                            <div class="d-flex flex-wrap mb-2">
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Invoice')">Invoice</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Tax Invoice')">Tax Invoice</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Proforma Invoice')">Proforma Invoice</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Receipt')">Receipt</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Sales Receipt')">Sales Receipt</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Cash Receipt')">Cash Receipt</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Delivery Note')">Delivery Note</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Purchase Order')">Purchase Order</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Credit Note')">Credit Note</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Credit Memo')">Credit Memo</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Estimate')">Estimate</button>
                                <button type="button" class="btn btn-outline-success" onclick="setInvoiceType('Quote')">Quote</button>
                            </div>
                        </div>
                        <input type="text" id="invoice_type" name="invoice_type" class="form-control" placeholder="Invoice type" required readonly>
                    </div>
<br>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="client_id">Select Client:</label>
                                @if($clients->isEmpty())
                                <div class="alert alert-warning" style="margin-bottom: 1rem;">
                                    Please register your client first.
                                </div>
                                @else
                                <select name="client_id" id="client_id" class="form-control" required>
                                    <option value="" disabled selected>Select a client</option>
                                    @foreach($clients as $client)
                                    <option
                                        value="{{ $client->id }}"
                                        data-bill="{{ $client->name }}"
                                        data-ship="{{ $client->client_details }}">{{ $client->name }}
                                    </option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="po">po:(optional)</label>
                                <input type="number" name="po" class="form-control" placeholder="purchase order" required>
                            </div>
                        </div>
                    </div>
                    <!-- Company Details Section -->
                    <div class="row mb-4">
                        <div class="col-md-8 mx-auto">
                            <label for="company_details" class="form-label" style="color: black;">From</label>
                            <textarea class="form-control form-control-sm" rows="5" style="height: 8em;" readonly>{{ $company->name }} - {{ $company->address }}</textarea>
                        </div>

                        <div class="col-md-4">
                            <div id="logo" class="mt-2 position-relative">
                                <div class="show-modal-logo p-4 w-100" style="background-color: white; color: black;">
                                    Selected Logo
                                    <br>
                                    @if($company->company_logo)
                                    <img src="{{ $company->company_logo }}" alt="Logo" style="width: 100%; max-height: 150px;">
                                    @else
                                    <p>No logo available</p>
                                    @endif
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row my-3">
                        <div class="col-md-8 mx-auto">
                            <label for="invoice_billing" class="form-label" style="color: black;">Bill To</label>
                            <textarea id="bill_to" class="form-control form-control-sm" placeholder="Your customer's name" rows="5" style="height: 8em;" tabindex="2" maxlength="5000" name="bill_to" required></textarea>
                            <label for="invoice_billing" class="form-label" style="color: black;">Ship To</label>
                            <textarea id="ship_to" class="form-control form-control-sm" placeholder="Your customer's Address" rows="5" style="height: 8em;" tabindex="2" maxlength="5000" name="ship_to" required></textarea>
                        </div>

                        <div class="col-md-4">
                            <label for="date" class="form-label" style="color: black;">Date</label>
                            <input type="date" class="form-control datepicker form-control-sm hasDatepicker" placeholder="dd/mm/yy" tabindex="4" maxlength="100" autocomplete="off" size="100" type="text" name="date" id="date" required>
                            <label for="due_date" class="form-label" style="color: black;">Due Date</label>
                            <input type="date" class="form-control datepicker form-control-sm hasDatepicker"  placeholder="dd/mm/yy" tabindex="4" maxlength="100" autocomplete="off" size="100"  name="due_date" id="due_date" required>
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-4 text-left"><strong>Description</strong></div>
                        <div class="col-3 text-center"><strong>Unit Price</strong></div>
                        <div class="col-2 text-center"><strong>Quantity</strong></div>
                        <div class="col-2 text-center"><strong>VAT</strong></div>
                        <div class="col-1 text-center"></div>
                    </div>
                    <div id="items">
                        <div class="row mb-3" id="row_item_0">
                            <div class="col-4">
                                <textarea name="description[]" placeholder="Description" class="form-control description form-control-sm" rows="2" required></textarea>
                            </div>
                            <div class="col-3">
                                <input type="number" step="0.01" name="unit_price[]" placeholder="Unit Price" class="form-control amount form-control-sm" required oninput="calculateAmount(0)">
                            </div>
                            <div class="col-2">
                                <input type="number" name="qty[]" placeholder="Qty" class="form-control qty form-control-sm" required oninput="calculateAmount(0)">
                            </div>
                            <input type="hidden" name="amount" id="amount_0">
                            <div class="col-2">
                                <input type="hidden" name="invoice[items_attributes][0][tax_rate_id]" id="invoice_items_attributes_0_tax_rate_id" autocomplete="off">
                                <input type="hidden" name="" id="tax_0" autocomplete="off">
                                <button type="button" id="invoice_items_attributes_0_tax_rate_name" class="btn btn-info btn-sm show-modal tax-rate-name w-100" data-index="0" onclick="addTax(0)">Add a Tax</button>
                            </div>
                            <div class="col-1 text-center" style="display: none;">
                                <span class="amount-label" id="amount_label_0">0.00</span>
                            </div>
                            <i class="fas fa-times" onclick="removeItem(0)"></i>
                        </div>
                    </div>
            </div>
            <div class="d-flex justify-content-center">
                <button type="button" class="btn btn-primary" onclick="addItem()">Add New Item</button>
            </div>
            <br>
            <hr>
            <div class="row mb-3">
                <div class="col-9 text-right">
                    <strong>Subtotal:</strong>
                </div>
                <div class="col-3 text-right" id="subtotal_value" style="display: none;">
                    <span>R <span id="subtotal_value">0.00</span></span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-9 text-right">
                    <strong>Tax:</strong>
                </div>
                <div class="col-3 text-right" id="tax_value" style="display: none;">
                    <span>R <span id="tax_total">0.00</span></span>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-9 text-right">
                    <strong>Total:</strong>
                </div>
                <div class="col-3 text-right" id="total" style="display: none;">
                    <span>R <span id="total_value">0.00</span></span>
                </div>
            </div>
            <input type="hidden" name="subtotal" id="subtotal" value="0.00"> <!-- Hidden input for subtotal -->
            <input type="hidden" name="total_amount" id="total_amount" value="0.00">
            <input type="hidden" name="tax" id="tax" value="0.00"> 

            <div class="row">
                <div class="col-md-7 mx-auto"> 
                    <label for="terms_and_conditions" class="form-label me-2"><i class="fas fa-pencil-alt icon"></i></label>
                    <a class="show-footer-label-modal text-decoration-dotted form-label">
                        <span id="footer_label">Terms & Conditions</span>
                    </a>
                    <textarea class="form-control form-control-sm" placeholder="Optional" rows="5" style="height: 8em;" tabindex="-1" maxlength="5000" name="terms_and_conditions" id="terms_and_conditions"></textarea>
                </div>
                <div class="col-md-5 mx-auto">
                    <div class="show-modal-logo p-4 w-100" style="background-color:white; color: black;">
                        Selected Signature
                        <br>
                        @if($company->signature)
                        <img src="{{ $company->signature }}" alt="signature" style="width: 100%; max-height: 150px;">
                        @else
                        <p>No signature available</p>
                        @endif
                        <br>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" style="border-radius: 8px; background-color: #4CAF50; border: none;">Create Invoice</button>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    let itemIndex = 1;

    function addItem() {
        const itemsDiv = document.getElementById('items');
        const newItem = document.createElement('div');
        newItem.classList.add('row', 'mb-3');
        newItem.id = `row_item_${itemIndex}`;
        newItem.innerHTML = `
        <div class="col-4">
            <textarea name="description[]" placeholder="Description" class="form-control description form-control-sm" rows="2" required></textarea>
        </div>
        <div class="col-3">
            <input type="number" step="0.01" name="unit_price[]" placeholder="Unit Price" class="form-control amount form-control-sm" required oninput="calculateAmount(${itemIndex})">
        </div>
        <div class="col-2">
            <input type="number" name="qty[]" placeholder="Qty" class="form-control qty form-control-sm" required oninput="calculateAmount(${itemIndex})">
        </div>
        <input type="hidden" name="items[${itemIndex}][amount]" id="amount_${itemIndex}">
        <div class="col-2">
            <input type="hidden" name="invoice[items_attributes][${itemIndex}][tax_rate_id]" id="invoice_items_attributes_${itemIndex}_tax_rate_id" autocomplete="off">
            <input type="hidden" name="" id="tax_${itemIndex}" autocomplete="off"> <!-- Updated ID for tax -->
            <button type="button" id="invoice_items_attributes_${itemIndex}_tax_rate_name" class="btn btn-info btn-sm show-modal tax-rate-name w-100" data-index="${itemIndex}" onclick="addTax(${itemIndex})">Add a Tax</button>
        </div>
        <div class="col-1 text-center" style="display: none;">
            <span class="amount-label" id="amount_label_${itemIndex}">0.00</span>
        </div>
        <i class="fas fa-times" onclick="removeItem(${itemIndex})"></i>
    `;
        itemsDiv.appendChild(newItem);
        itemIndex++;
    }

    function removeItem(index) {
        const row = document.getElementById(`row_item_${index}`);
        row.remove();
        calculateTotals(); 
    }

    function calculateAmount(index) {
        const qtyInput = document.querySelector(`#row_item_${index} .qty`);
        const unitPriceInput = document.querySelector(`#row_item_${index} .amount`);

        const qty = parseFloat(qtyInput.value) || 0;
        const unitPrice = parseFloat(unitPriceInput.value) || 0;

        const amount = qty * unitPrice;
        document.getElementById(`amount_${index}`).value = amount.toFixed(2);

        document.getElementById(`amount_label_${index}`).textContent = amount.toFixed(2);

        calculateTotals();
    }

    function addTax(index) {
        const qtyInput = document.querySelector(`#row_item_${index} .qty`);
        const unitPriceInput = document.querySelector(`#row_item_${index} .amount`);

        const VAT_RATE = 0.15;

        const qty = parseFloat(qtyInput.value) || 0;
        const unitPrice = parseFloat(unitPriceInput.value) || 0;

        const amount = qty * unitPrice;
        const tax = amount * VAT_RATE;

        document.getElementById(`tax_${index}`).value = tax.toFixed(2);

        calculateTotals();
    }

    function calculateTotals() {
        let subtotal = 0;
        let totalTax = 0;

        const amounts = document.querySelectorAll('[id^="amount_"]');
        amounts.forEach((el) => {
            subtotal += parseFloat(el.value) || 0;
        });

        const taxes = document.querySelectorAll('[id^="tax_"]');
        taxes.forEach((el) => {
            totalTax += parseFloat(el.value) || 0;
        });

        const total = subtotal + totalTax;

        document.getElementById('subtotal_value').textContent = subtotal.toFixed(2);
        document.getElementById('tax_total').textContent = totalTax.toFixed(2);
        document.getElementById('total_value').textContent = total.toFixed(2);

        document.getElementById('subtotal').value = subtotal.toFixed(2);
        document.getElementById('total_amount').value = total.toFixed(2);
        document.getElementById('tax').value = totalTax.toFixed(2);

        document.getElementById('subtotal_value').style.display = subtotal > 0 ? 'flex' : 'none';
        document.getElementById('tax_value').style.display = totalTax > 0 ? 'flex' : 'none';
        document.getElementById('total').style.display = total > 0 ? 'flex' : 'none';
    }


    function setInvoiceType(type) {
        document.getElementById('invoice_type').value = type;
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const clientSelect = document.getElementById('client_id');
        const billToTextarea = document.getElementById('bill_to');
        const shipToTextarea = document.getElementById('ship_to');

        clientSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            billToTextarea.value = selectedOption.getAttribute('data-bill');
            shipToTextarea.value = selectedOption.getAttribute('data-ship');
        });
    });
</script>