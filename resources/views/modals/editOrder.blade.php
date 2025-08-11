<div class="modal fade" id="modalEditOrder" tabindex="-1" aria-labelledby="modalEditOrderLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditOrderLabel">Editar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editOrderForm" class="needs-validation d-flex flex-column justify-content-between gap-3">
                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <label for="editOrderCustomerName" class="form-label">Nome do Cliente</label>
                            <input type="text" class="form-control" id="editOrderCustomerName" name="customerName"
                                required>
                        </div>
                        <div class="col-12 col-md-6 mt-3 mt-md-0">
                            <label for="editSelectOrderStatus" class="form-label">Status</label>
                            <select id="editSelectOrderStatus" class="form-select">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}"> {{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <label for="editOrderOrderDate" class="form-label">Data do pedido</label>
                            <input type="datetime-local" step="1"
                                class="form-control px-2 form-control event-start" id="editOrderOrderDate"
                                name="OrderDate" no-val required>
                        </div>
                        <div class="col-12 col-md-6 mt-3 mt-md-0">
                            <label for="editOrderDeliveryDate" class="form-label">Data da entrega</label>
                            <input type="datetime-local" step="1" class="form-control" id="editOrderDeliveryDate"
                                name="OrderDeliveryDate">
                        </div>
                    </div>
                    <div class="row d-flex justify-content-end">
                        <div class="col-12 col-sm-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-100 justify-content-center d-flex mb-0" id="submitEditUser">Editar Pedido</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
