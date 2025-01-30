const submitPekerjaan = () => {
    $("#formPekerjaan").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormPekerjaan")
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

                window.LaravelDataTables["pekerjaan-table"].ajax.reload();

                $("#bottonCloseModalFormPekerjaan").click();

                $("#submitFormPekerjaan")
                    .html("Submit")
                    .prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formPekerjaan").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormPekerjaan")
                    .html("Submit")
                    .prop("disabled", false);
            },
        });
    });
};

const deletePekerjaan = (id) => {
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
                url: baseUrl + `pekerjaan/${id}`,
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
                    window.LaravelDataTables["pekerjaan-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updatePekerjaan = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormPekerjaan").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `pekerjaan/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormPekerjaan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Pekerjaan");

            submitPekerjaan();
        },
    });
};
