const initializeSelect2Role = () => {
    $("#role").select2({
        placeholder: "Pilih Role",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "admin", text: "Admin" },
            { id: "pegawai", text: "Pegawai" },
        ],
    });
};

const submitUser = () => {
    $("#formUser").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormUser").html(setButtonLoading()).prop("disabled", true);

        $.ajax({
            type: "POST",
            url,
            data: $(this).serialize(),
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (res) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: res.message,
                    showConfirmButton: false,
                    timer: 2000,
                });

                window.LaravelDataTables["user-table"].ajax.reload();

                $("#bottonCloseModalFormUser").click();

                $("#submitFormUser").html("Submit").prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formUser").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormUser").html("Submit").prop("disabled", false);
            },
        });
    });
};

const deleteUser = (id) => {
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Anda tidak dapat mengembalikan data ini!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya!",
        cancelButtonText: "Tidak",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: baseUrl + `user/${id}`,
                method: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                dataType: "json",
                success: function (res) {
                    Swal.fire({
                        icon: "success",
                        title: res.message,
                        showConfirmButton: false,
                        timer: 2000,
                    });
                    window.LaravelDataTables["user-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updateUser = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormUser").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `user/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormUser").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit User");

            initializeSelect2Role();
            submitUser();

            initializeSelect2Data("role-value", "role");
        },
    });
};
