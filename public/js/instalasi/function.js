const initializeSelect2IsAntrian = () => {
    $("#is_antrian").select2({
        placeholder: "Pilih Butuh Antrian",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "0", text: "Tidak" },
            { id: "1", text: "Butuh" },
        ],
    });
};

const submitInstalasi = () => {
    $("#formInstalasi").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormInstalasi")
            .html(setButtonLoading())
            .prop("disabled", true);

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

                window.LaravelDataTables["instalasi-table"].ajax.reload();

                $("#bottonCloseModalFormInstalasi").click();

                $("#submitFormInstalasi")
                    .html("Submit")
                    .prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formInstalasi").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormInstalasi")
                    .html("Submit")
                    .prop("disabled", false);
            },
        });
    });
};

const deleteInstalasi = (id) => {
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
                url: baseUrl + `instalasi/${id}`,
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
                    window.LaravelDataTables["instalasi-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updateInstalasi = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormInstalasi").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `instalasi/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormInstalasi").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Instalasi");
            initializeSelect2IsAntrian();

            initializeSelect2Data("is-antrian-value", "is_antrian");

            submitInstalasi();
        },
    });
};
