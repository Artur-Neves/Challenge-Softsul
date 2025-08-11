<div class="modal fade" id="addOrderModal" tabindex="-1" aria-labelledby="modalCreateOrderLabel" aria-hidden="true"
    data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateOrderLabel">Criar Pedido</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createFormOrder" class="needs-validation d-flex flex-column justify-content-between gap-3"
                    novalidate>

                    <div class="row">
                        <div class="col-12 col-md-6">
                            <label for="createOrderCustomerName" class="form-label-sm">Nome do Cliente</label>
                            <input type="text" class="form-control w-100" id="createOrderCustomerName"
                                name="customerName" required>
                            <div class="invalid-feedback">
                                Este campo é obrigatório.
                            </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3 mt-md-0">
                            <label for="createSelectOrderStatus" class="form-label">Status</label>
                            <select id="createSelectOrderStatus" class="form-select ">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}"> {{ $status }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row ">
                        <div class="col-12 col-md-6">
                            <label for="createOrderOrderDate" class="form-label">Data do pedido</label>
                            <input type="datetime-local" step="1"
                                class="form-control px-2 form-control event-start" id="createOrderOrderDate"
                                name="OrderDate" no-val required>
                                <div class="invalid-feedback">
                                    Este campo é obrigatório.
                                </div>
                        </div>
                        <div class="col-12 col-md-6 mt-3 mt-md-0">
                            <label for="createOrderDeliveryDate" class="form-label">Data da entrega</label>
                            <input type="datetime-local" step="1" class="form-control"
                                id="createOrderDeliveryDate" name="OrderDeliveryDate" no-val required>
                                <div class="invalid-feedback">
                                    Este campo é obrigatório.
                                </div>
                        </div>
                    </div>

                    <div class="row d-flex justify-content-end">
                        <div class="col-12 col-sm-6 d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary w-100 justify-content-center d-flex mb-0" id="submitCreateOrder">Criar Novo
                                Pedido</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
