let tableOrders = undefined;


$(document).ready(async function () {
    constructDataTable(baseUrl);
    const localityChekbox = "tr .table-users__checked input[type='checkbox']";
    configureCheckbox(tableOrders, localityChekbox);
});

function constructDataTable(url) {
    $("#main-content").addClass("full-width");
    $("#tableOrders").one("preInit.dt", (e) => {
        let button = `<div class="dt-search ms-md-3 ms-1 pt-2">

        <button type="button" id="addOrder" class="btn btn-danger py-2 px-3" data-bs-toggle="modal" data-bs-target="#addOrderModal">
            <!-- <img src="/img/icons/icAdd.svg" class="pe-2 disabled" width="38" height="25" alt="Criar Pedido"/> -->
            Criar Novo Pedido</button>
        </div>`
        $("#tableOrders_wrapper > div > div:has(div.dt-search) > div").after(
            button
        );
    });

    tableOrders = new DataTable("#tableOrders", {
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
        order: [[9, 'desc']],
        language: {

            emptyTable:
                "<div class='empty_users addLinha' data-type='order'>Nenhum pedido cadastrado.</div>",
            search: `
                <div class="input-group flex-nowrap">
                    <span class="input-group-text" id="addon-wrapping">
                        <img src="/img/icons/icSearch.svg"  width="24" height="24" alt="Criar Usuário" />
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
            Usuários por página  _MENU_
            `
        },
        columns: [
            {
                width: "5%",
                data: "id",
                name: "id",
                title: "#",
                orderable: true,
                searchable: false,
            },
            {
                width: "15%",
                data: "customer_name",
                name: "customer_name",
                title: "Cliente",
                orderable: true,
            },
            {
                width: "15%",
                data: "status",
                name: "status",
                title: "Status",
                orderable: true,
                searchable: false
            },
            {
                width: "20%",
                data: "order_date",
                name: "order_date",
                title: "Data do Pedido",
                orderable: true,
                searchable: false,
            },
            {
                width: "20%",
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
                    <i class="bi bi-eye-fill viewLinhaUser pe-3 btnAcao-datatable-users" data-bs-toggle="modal" id="iconViewUser" data-bs-target="#modalViewUser" data-user-id="${data.id}" data-user-email="${data.email}""></i>
                    <i class="bi bi-pencil-fill editarLinhaUser btnAcao-datatable-users" data-bs-toggle="modal" id="iconEditUser" data-bs-target="#modalEditUser" data-user-id="${data.id}" data-user-email="${data.email}""></i>
                    </div>
                `;

                },
                name: "acao",
                title: "",
                orderable: false,
                searchable: false,
            },
        ],
        columnDefs: [{ className: "usuariosDatatable", targets: "_all" }],
        layout: {
            bottomEnd: {
                paging: {
                    buttons: 5,
                },
            },
        },
    });
}

