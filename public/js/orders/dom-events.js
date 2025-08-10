const baseUrl = "/api/orders/datatable";
var userId = null;
$(document).ready(function () {
    const formCreate = $("#createFormUser");
    const btnCreateUser = $("#submitCreateUser");
    const btnEditeUser = $("#submitEditUser");
    const formsEdit = $("#editUserForm");

    formCreate.on('submit', async function (event) {
        event.preventDefault();
        event.stopPropagation();

        if (!formCreate.get(0).checkValidity()) {
            formCreate.addClass('was-validated')
        }
        else {
            $.ajax({
                type: "POST",
                url: "/api/users/store",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                data: JSON.stringify(getDatasCreateUserByInputs()),
                beforeSend: function () {
                    btnCreateUser.prop("disabled", true);
                    btnCreateUser.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>    Aguarde...</span>'
                    );
                },
                success: async function (response) {
                    updateDataTableRows(baseUrl + getValueFields());
                    Notiflix.Notify.success("Usuário criado com sucesso!!");
                    closeModalCreateUser();
                },
                error: function (error) {
                    Notiflix.Notify.warning(error.responseJSON.message);
                    btnCreateUser.html("Criar Usuário");
                    btnCreateUser.prop("disabled", false);
                },
            });
        }
    });

    $('#btnLimpar').on('click', function () {
        $("#formFilterUser").trigger("reset");
    })

    $("#tableOrders").on("click", "#iconEditUser", async function (event) {
        userId = $(event.currentTarget).data('user-id');
        await customFetch(`api/users/show/${userId}`, {
            method: 'GET',
            onSuccess: function (data) {
                setDatasInInputsEdit(data);
            },
            onError: function (error) {
                console.error("Erro ao buscar usuário", error);
                Notiflix.Notify.failure("Ops.. Ocorreu um erro ao tentar buscar o usuário");
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
            await customFetch(`api/users/update/${userId}`, {
                method: 'PUT',
                body: getDatasEditUserByInputs(),
                beforeSend: function () {
                    btnEditeUser.prop("disabled", true);
                    btnEditeUser.html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span><span>    Aguarde...</span>'
                    );
                },
                onSuccess: function (data) {
                    updateDataTableRows(baseUrl + getValueFields());
                    Notiflix.Notify.success("Usuário editado com sucesso!");
                    closeModalEditUser();
                },
                onError: function (error) {
                    console.error("Erro ao editar usuário", error);
                    Notiflix.Notify.failure(error.message);
                },
            });
        }
    });

    function closeModalCreateUser() {
        formCreate.trigger("reset");
        $("#addUsersModal").modal("hide");
        $('#createRoleUsuario').val(null).trigger('change');
        formCreate.removeClass('was-validated');
        btnCreateUser.prop("disabled", false);
        btnCreateUser.html("Criar Usuário");
    };

    function closeModalEditUser() {
        formsEdit.trigger("reset");
        $("#modalEditUser").modal("hide");
        // $('#editRoleUsuario').val(null).trigger('change');
        formsEdit.removeClass('was-validated');
        btnEditeUser.prop("disabled", false);
        btnEditeUser.html("Editar Usuário");
    };


    function updateDataTableRows(url) {
        datatable = $(`#tableOrders`).DataTable();
        datatable.destroy();
        constructDataTable(url);
    }

    function getDatasCreateUserByInputs() {
        const client_ddd_phone = $("#createUserDDD").val();
        const client_ddi_phone = $("#createUserDDI").val();
        const client_number_phone = $("#createUserTelefone").val();
        const data_de_compra = $("#createUserDataDeCompra").val();
        const data_de_renovacao = $("#createUserDataDeRenovacao").val().trim().length === 0 ? null : $("#createUserDataDeRenovacao").val();
        const client_name = $("#createUserName").val();
        const client_email = $("#createUserEmail").val();
        const telefone = `${client_ddi_phone}${client_ddd_phone}${client_number_phone}`;
        const plan = ($("#createSelectPlan").val() == "MENSAL" || $("#createSelectPlan").val() == "ANUAL") ? "CLIENTE" : $("#createSelectPlan").val();
        const isReembolso = $("#createSelectStatusPlan").val() == "REEMBOLSO";
        const role = [(isReembolso) ? "REEMBOLSO" : plan];

        const user = {
            name: client_name,
            email: client_email,
            telefone: telefone,
            data_de_compra: data_de_compra,
            data_de_renovacao: data_de_renovacao,
            roles: role
        }

        return user
    }

    function getDatasEditUserByInputs() {
        const client_name = $("#editUserName").val();
        const data_de_compra = $("#editUserDataDeCompra").val();
        const data_de_renovacao = $("#editUserDataDeRenovacao").val().trim().length === 0 ? null : $("#editUserDataDeRenovacao").val();
        const plan = ($("#editSelectPlan").val() == "MENSAL" || $("#editSelectPlan").val() == "ANUAL") ? "CLIENTE" : $("#editSelectPlan").val();
        const isReembolso = $("#editSelectStatusPlan").val() == "REEMBOLSO";

        const role = [(isReembolso) ? "REEMBOLSO" : plan];

        const user = {
            name: client_name,
            roles: role,
            data_de_compra: data_de_compra,
            data_de_renovacao: data_de_renovacao
        }

        return user
    }


    function setDatasInInputsEdit(data) {
        $("#editUserName").val(data.name);
        $("#editUserEmail").val(data.email);
        $("#editUserTelefone").val(data.telefone);
        $("#editUserDataDeRenovacao").val(data.data_de_renovacao);
        $("#editUserDataDeCompra").val(data.data_de_compra);
        $("#editSelectPlan").val(data.plan);
        $("#editSelectStatusPlan").val(data.status_plan);
    }
});
