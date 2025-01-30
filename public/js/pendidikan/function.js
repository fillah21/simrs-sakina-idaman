const submitPendidikan = () => {
    $("#formPendidikan").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormPendidikan")
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

                window.LaravelDataTables["pendidikan-table"].ajax.reload();

                $("#bottonCloseModalFormPendidikan").click();

                $("#submitFormPendidikan")
                    .html("Submit")
                    .prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formPendidikan").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormPendidikan")
                    .html("Submit")
                    .prop("disabled", false);
            },
        });
    });
};

const deletePendidikan = (id) => {
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
                url: baseUrl + `pendidikan/${id}`,
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
                    window.LaravelDataTables["pendidikan-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updatePendidikan = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormPendidikan").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `pendidikan/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormPendidikan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Pendidikan");

            submitPendidikan();
        },
    });
};
