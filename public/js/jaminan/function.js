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
};

const initializeSelect2WajibKeteranganJaminan = () => {
    $("#wajib_keterangan_jaminan").select2({
        placeholder: "Pilih Wajib Keterangan Jaminan",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "0", text: "Tidak" },
            { id: "1", text: "Wajib" },
        ],
    });
};

const submitJaminan = () => {
    $("#formJaminan").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormJaminan").html(setButtonLoading()).prop("disabled", true);

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

                window.LaravelDataTables["jaminan-table"].ajax.reload();

                $("#bottonCloseModalFormJaminan").click();

                $("#submitFormJaminan").html("Submit").prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formJaminan").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormJaminan").html("Submit").prop("disabled", false);
            },
        });
    });
};

const deleteJaminan = (id) => {
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
                url: baseUrl + `jaminan/${id}`,
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
                    window.LaravelDataTables["jaminan-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updateJaminan = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormJaminan").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `jaminan/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormJaminan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Jaminan");
            initializeSelect2WajibKeteranganJaminan();
            initializeSelect2WajibRujukan();

            initializeSelect2Data("wajib-rujukan-value", "wajib_rujukan");
            initializeSelect2Data(
                "wajib-keterangan-jaminan-value",
                "wajib_keterangan_jaminan"
            );
            submitJaminan();
        },
    });
};
