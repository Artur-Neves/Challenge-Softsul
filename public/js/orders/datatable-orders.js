let tableOrders = undefined;

function constructDataTable(url) {
    $("#main-content").addClass("full-width");
    $("#tableOrders").one("preInit.dt", (e) => {
        let button = `<div class="dt-search ms-md-3 ms-1 pt-2">
        <button type="button" id="addOrder" class="btn py-2 px-3 btn-add-order" data-bs-toggle="modal" data-bs-target="#addOrderModal">
            <img src="/img/icons/icAdd.svg" class="pe-2 disabled" width="38" height="25" alt="Criar Pedido"/>
            Criar Novo Pedido</button>
        </div>`
        $("#tableOrders_wrapper > div > div:has(div.dt-search) > div").after(
            button
        );
    });

    function getTableHeight() {
        const container = document.querySelector('.table-orders');
        const rect = container.getBoundingClientRect();
        const subtract = (770 >= window.innerWidth) ? 220 : 163;
        return (rect.height - subtract) + 'px';
    }

    tableOrders = new DataTable("#tableOrders", {
        scrollY: getTableHeight(),
        scrollCollapse: true,
        paging: true,
        serverSide: true,
        deferRender: true,
        pagingType: "simple_numbers",
        autoWidth: false,
        pageLength: 10,
        ajax: {
            url: url,
            method: 'GET',
            error: function (error) {
                console.error("Erro ao realizar exibir os dados", error);
                Notiflix.Notify.failure("Ops.. Ocorreu um erro exibir o arquivo: " + error.responseJSON.message);
            }
        },
        order: [[1, 'desc']],
        language:
        {
            info: "Mostrando de _START_ até _END_ de _TOTAL_ pedidos",
            emptyTable:
                "<div data-type='order'>Nenhum pedido cadastrado.</div>",
            search: `
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="/img/icons/icSearch.svg"  width="24" height="24" alt="Criar Pedido" />
                    </span>
                    _INPUT_
                </div>
                `,

            searchPlaceholder: "Pesquisa...",
            paginate: {
                next: "&gt;",
                previous: "&lt;",
                first: "&laquo;",
                last: "&raquo;",
            },
            lengthMenu: `
            Pedidos por página  _MENU_
            `
        },
        columns: [
            {
                width: "10%",
                data: "id",
                name: "id",
                title: "#",
                orderable: true,
                searchable: false,
            },
            {
                width: "20%",
                data: "customer_name",
                name: "customer_name",
                title: "Cliente",
                orderable: true,
            },
            {
                width: "20%",
                data: "status",
                name: "status",
                title: "Status",
                orderable: true,
                searchable: false
            },
            {
                width: "25%",
                data: "order_date",
                name: "order_date",
                title: "Data do Pedido",
                orderable: true,
                searchable: false,
            },
            {
                width: "25%",
                data: "delivery_date",
                name: "delivery_date",
                title: "Data de Entrega",
                orderable: true,
                searchable: false,
            },
            {
                width: "10%",
                data: null,
                render: function (data, type, row) {
                    return `<div class="d-flex flex-direction-row justify-content-between">
                    <i class="bi bi-pencil-fill pe-3" data-bs-toggle="modal" id="iconEditOrder" data-bs-target="#modalEditOrder" data-order-id="${data.id}"></i>
                    <i class="bi bi-trash-fill" data-order-id="${data.id}"></i>
                    </div>
                `;

                },
                name: "acao",
                title: "",
                orderable: false,
                searchable: false,
            },
        ],
        columnDefs: [{ className: "ordersDatatable", targets: "_all" }],
        layout: {
            bottomEnd: {
                paging: {
                    buttons: 5,
                },
            },
        },
    });
}

