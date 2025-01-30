const submitAgama = () => {
    $("#formAgama").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormAgama").html(setButtonLoading()).prop("disabled", true);

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

                window.LaravelDataTables["agama-table"].ajax.reload();

                $("#bottonCloseModalFormAgama").click();

                $("#submitFormAgama").html("Submit").prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formAgama").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormAgama").html("Submit").prop("disabled", false);
            },
        });
    });
};

const deleteAgama = (id) => {
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
                url: baseUrl + `agama/${id}`,
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
                    window.LaravelDataTables["agama-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updateAgama = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormAgama").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `agama/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormAgama").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Agama");

            submitAgama();
        },
    });
};
