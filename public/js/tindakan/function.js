const initializeSelect2Layanan = () => {
    initializeSelect2({
        selectId: "#layanan_id",
        placeholder: "Pilih layanan",
        url: "api/layanan-full",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.kode_layanan + " - " + item.nama_layanan,
                });
            });

            return { results: results };
        },
    });
};

const submitTindakan = () => {
    $("#formTindakan").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormTindakan")
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

                window.LaravelDataTables["tindakan-table"].ajax.reload();

                $("#bottonCloseModalFormTindakan").click();

                $("#submitFormTindakan").html("Submit").prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formTindakan").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormTindakan").html("Submit").prop("disabled", false);
            },
        });
    });
};

const deleteTindakan = (id) => {
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
                url: baseUrl + `tindakan/${id}`,
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
                    window.LaravelDataTables["tindakan-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updateTindakan = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormTindakan").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `tindakan/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormTindakan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Tindakan");
            initializeSelect2Layanan();

            initializeSelect2Data("layanan-id-value", "layanan_id");

            submitTindakan();
        },
    });
};
