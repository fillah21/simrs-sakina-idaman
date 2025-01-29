const initializeSelect2Jk = () => {
    $("#jk").select2({
        placeholder: "Pilih Jenis Kelamin",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "L", text: "Laki-Laki" },
            { id: "P", text: "Perempuan" },
        ],
    });
};

const initializeSelect2StatusNikah = () => {
    $("#status_nikah").select2({
        placeholder: "Pilih Status Nikah",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "Belum Menikah", text: "Belum Menikah" },
            { id: "Menikah", text: "Menikah" },
            { id: "Janda/Duda", text: "Janda/Duda" },
        ],
    });
};

const initAllSelect2Pasien = () => {
    initializeSelect2Jk();
    initializeSelect2StatusNikah();

    initializeSelect2({
        selectId: "#provinsi_id",
        placeholder: "Pilih Provinsi",
        url: "api/provinsi",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.nama_provinsi,
                });
            });

            return { results: results };
        },
    });

    const initKabupatenSelect2 = () => {
        initializeSelect2({
            selectId: "#kabupaten_id",
            placeholder: "Pilih Kabupaten",
            url: "api/kabupaten",
            useHeaders: true,
            data: {
                provinsi_id: $("#provinsi_id").val(),
            },
            processResultsCallback: function (data) {
                const results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.tipe_kabupaten + " " + item.nama_kabupaten,
                    });
                });

                return { results: results };
            },
        });
    };

    const initKecamatanSelect2 = () => {
        initializeSelect2({
            selectId: "#kecamatan_id",
            placeholder: "Pilih Kecamatan",
            url: "api/kecamatan",
            useHeaders: true,
            data: {
                kabupaten_id: $("#kabupaten_id").val(),
            },
            processResultsCallback: function (data) {
                const results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.nama_kecamatan,
                    });
                });

                return { results: results };
            },
        });
    };

    const initKelurahanSelect2 = () => {
        initializeSelect2({
            selectId: "#kelurahan_id",
            placeholder: "Pilih Kelurahan",
            url: "api/kelurahan",
            useHeaders: true,
            data: {
                kecamatan_id: $("#kecamatan_id").val(),
            },
            processResultsCallback: function (data) {
                const results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.nama_kelurahan,
                    });
                });

                return { results: results };
            },
        });
    };

    initializeSelect2({
        selectId: "#agama_id",
        placeholder: "Pilih Agama",
        url: "api/agama",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.agama,
                });
            });

            return { results: results };
        },
    });

    initializeSelect2({
        selectId: "#pendidikan_id",
        placeholder: "Pilih Pendidikan",
        url: "api/pendidikan",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.pendidikan,
                });
            });

            return { results: results };
        },
    });

    initializeSelect2({
        selectId: "#pekerjaan_id",
        placeholder: "Pilih Pekerjaan",
        url: "api/pekerjaan",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.nama_pekerjaan,
                });
            });

            return { results: results };
        },
    });

    initKabupatenSelect2();
    initKecamatanSelect2();
    initKelurahanSelect2();
    reinitializedSelect2OnChange("#provinsi_id", initKabupatenSelect2);
    reinitializedSelect2OnChange("#kabupaten_id", initKecamatanSelect2);
    reinitializedSelect2OnChange("#kecamatan_id", initKelurahanSelect2);

    $("#provinsi_id").change(function () {
        $("#kabupaten_id").val(null).trigger("change");
        $("#kecamatan_id").val(null).trigger("change");
        $("#kelurahan_id").val(null).trigger("change");
    });

    // $("#kabupaten_id").change(function () {
    //     $("#kecamatan_id").val(null).trigger("change");
    //     $("#kelurahan_id").val(null).trigger("change");
    // });

    // $("#kecamatan_id").change(function () {
    //     $("#kecamatan_id").val(null).trigger("change");
    // });
};

const submitPasien = () => {
    $("#formPasien").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormPasien").html(setButtonLoading()).prop("disabled", true);

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

                window.LaravelDataTables["pasien-table"].ajax.reload();

                $("#bottonCloseModalFormPasien").click();

                $("#submitFormUPasien").html("Submit").prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formPasien").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormPasien").html("Submit").prop("disabled", false);
            },
        });
    });
};

const deletePasien = (id) => {
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
                url: baseUrl + `pasien/${id}`,
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
                    window.LaravelDataTables["pasien-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const updatePasien = (id) => {
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormPasien").find(".modal-dialog").html(setBigLoading());

    $.ajax({
        url: baseUrl + `pasien/${id}/edit`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");

            $("#modalFormPasien").find(".modal-dialog").html(res);
            $("#modalTitle").text("Edit Pasien");

            initAllSelect2Pasien();
            submitPasien();

            initializeDatepicker("#tanggal_lahir");

            initializeSelect2Data("status-nikah-value", "status_nikah");
            initializeSelect2Data("jk-value", "jk");
            initializeSelect2Data("provinsi-id-value", "provinsi_id");
            initializeSelect2Data("kabupaten-id-value", "kabupaten_id");
            initializeSelect2Data("kecamatan-id-value", "kecamatan_id");
            initializeSelect2Data("kelurahan-id-value", "kelurahan_id");
            initializeSelect2Data("agama-id-value", "agama_id");
            initializeSelect2Data("pendidikan-id-value", "pendidikan_id");
            initializeSelect2Data("pekerjaan-id-value", "pekerjaan_id");
        },
    });
};
