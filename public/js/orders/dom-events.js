const baseUrl = "/api/orders/datatable";
var orderId = null;
$(document).ready(function () {
    const formCreate = $("#createFormOrder");
    const btnCreateOrder = $("#submitCreateOrder");
    const btnEditeOrder = $("#submitEditOrder");
    const formsEdit = $("#editOrderForm");
    $(window).on('resize', constructDataTable(baseUrl));

    formCreate.on('submit', async function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!formCreate.get(0).checkValidity()) {
            formCreate.addClass('was-validated')
        }
        else {
            $.ajax({
                type: "POST",
                url: "/api/orders",
                data: getDatasCreateOrderByInputs(),
                beforeSend: function () {
                    btnCreateOrder.prop("disabled", true);
                    btnCreateOrder.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>    Aguarde...</span>'
                    );
                },
                success: async function (response) {
                    updateDataTableRows(baseUrl);
                    Notiflix.Notify.success("Pedido criado com sucesso!");
                    closeModalCreateOrder();
                },
                error: function (error) {
                    Notiflix.Notify.warning(error.responseJSON.message);
                    btnCreateOrder.html("Criar Pedido");
                    btnCreateOrder.prop("disabled", false);
                },
            });
        }
    });

    $("#tableOrders").on("click", "#iconEditOrder", async function (event) {
        orderId = $(event.currentTarget).data('order-id');
        $.ajax({
            type: "GET",
            url: `api/orders/${orderId}`,
            success: function (data) {
                setDatasInInputsEdit(data);
            },
            error: function (error) {
                console.error("Erro ao buscar o pedido", error);
                Notiflix.Notify.failure("Ops.. Ocorreu um erro ao tentar buscar o pedido");
            },
        });
    });

    formsEdit.on("submit", async function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!formsEdit.get(0).checkValidity()) {
            formsEdit.addClass('was-validated')
            console.error(formsEdit.get(0).checkValidity());
        }
        else {
            $.ajax({
                type: "PUT",
                url: `api/orders/${orderId}`,
                data: getDatasEditOrderByInputs(),
                beforeSend: function () {
                    btnEditeOrder.prop("disabled", true);
                    btnEditeOrder.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>    Aguarde...</span>'
                    );
                },
                success: function (data) {
                    updateDataTableRows(baseUrl);
                    Notiflix.Notify.success("Pedido editado com sucesso!");
                    closeModalEditOrder();
                },
                error: function (error) {
                    console.error("Erro ao editar pedido", error);
                    Notiflix.Notify.warning(error.responseJSON.message);
                },
            });
        }
    });

    function closeModalCreateOrder() {
        formCreate.trigger("reset");
        $("#addOrderModal").modal("hide");
        formCreate.removeClass('was-validated');
        btnCreateOrder.prop("disabled", false);
        btnCreateOrder.html("Criar Pedido");
    };

    function closeModalEditOrder() {
        formsEdit.trigger("reset");
        $("#modalEditOrder").modal("hide");
        formsEdit.removeClass('was-validated');
        btnEditeOrder.prop("disabled", false);
        btnEditeOrder.html("Editar Pedido");
    };

    function updateDataTableRows(url) {
        datatable = $(`#tableOrders`).DataTable();
        datatable.destroy();
        constructDataTable(url);
    }

    function getDatasCreateOrderByInputs() {
        const customer_name = $("#createOrderCustomerName").val();
        const status = $("#createSelectOrderStatus").val();
        const order_date = $("#createOrderOrderDate").val();
        const delivery_date = $("#createOrderDeliveryDate").val();

        const order = {
            customer_name: customer_name,
            status: status,
            order_date: order_date,
            delivery_date: delivery_date,
        }

        return order
    }

    function getDatasEditOrderByInputs() {
        const customer_name = $("#editOrderCustomerName").val();
        const status = $("#editSelectOrderStatus").val();
        const order_date = $("#editOrderOrderDate").val();
        const delivery_date = $("#editOrderDeliveryDate").val();

        const order = {
            customer_name: customer_name,
            status: status,
            order_date: order_date,
            delivery_date: delivery_date,
        }

        return order
    }

    function formatDateToInput(dateStr) {
        const [datePart, timePart] = dateStr.split(' ');
        const [day, month, year] = datePart.split('/');
        const [hour, minute, seconds] = timePart.split(':');

        return `${year}-${month.padStart(2, '0')}-${day.padStart(2, '0')}T${hour.padStart(2, '0')}:${minute.padStart(2, '0')}:${seconds.padStart(2, '0')}`;
    }

    function setDatasInInputsEdit(data) {
        $("#editOrderCustomerName").val(data.customer_name);
        $("#editSelectOrderStatus").val(data.status);
        $("#editOrderOrderDate").val(formatDateToInput(data.order_date));
        $("#editOrderDeliveryDate").val(formatDateToInput(data.delivery_date));
    }

    $('#tableOrders tbody').on('click', '.bi-trash-fill', function (e) {
        const $icon = $(this);
        const orderId = $icon.data('order-id'); // pega do data-order-id

        Notiflix.Confirm.show(
            '⚠️ Confirmação de Exclusão',
            `Deseja realmente excluir o pedido de id nº ${orderId} do cliente ${$icon.closest('tr').find('td').eq(1).text()}? Esta ação é irreversível.`,
            'Sim, excluir',
            'Cancelar',
            function okCb() {
                deleteOrder(orderId);
            },
            function cancelCb() {
            },
            {
                width: '350px',
                okButtonBackground: '#d33',
                titleColor: '#d33'
            }
        );
    });

    function deleteOrder(orderId) {
        $.ajax({
            type: "DELETE",
            url: `api/orders/${orderId}`,
            success: function (data) {
                updateDataTableRows(baseUrl);
                Notiflix.Notify.success("Pedido excluído com sucesso!");
            },
            error: function (error) {
                console.error("Erro ao excluir pedido", error);
                Notiflix.Notify.warning(error.responseJSON.message);
            },
        });
    }
});