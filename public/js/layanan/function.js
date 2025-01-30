const initializeSelect2WajibRujukan = () => {
    $("#wajib_rujukan").select2({
        placeholder: "Pilih Wajib Rujukan",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "0", text: "Tidak" },
            { id: "1", text: "Wajib" },
        ],
    });

    initializeSelect2({
        selectId: "#instalasi_id",
        placeholder: "Pilih Instalasi",
        url: "api/instalasi",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.kode_instalasi + " - " + item.nama_instalasi,
                });
            });

            return { results: results };
        },
    });
};

const submitLayanan = () => {
    $("#formLayanan").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormLayanan").html(setButtonLoading()).prop("disabled", true);

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

                window.LaravelDataTables["layanan-table"].ajax.reload();

                $("#bottonCloseModalFormLayanan").click();

                $("#submitFormLayanan").html("Submit").prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formLayanan").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormLayanan").html("Submit").prop("disabled", false);
            },
        });
    });
};

const deleteLayanan = (id) => {
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
                url: baseUrl + `layanan/${id}`,
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
                    window.LaravelDataTables["layanan-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updateLayanan = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormLayanan").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `layanan/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormLayanan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Layanan");
            initializeSelect2WajibRujukan();

            initializeSelect2Data("instalasi-id-value", "instalasi_id");
            initializeSelect2Data("wajib-rujukan-value", "wajib_rujukan");

            submitLayanan();
        },
    });
};
