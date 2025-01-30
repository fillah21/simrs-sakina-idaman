const initCaraMasukSelect2 = () => {
    $("#cara_masuk").select2({
        placeholder: "Pilih Cara Masuk",
        allowClear: true,
        data: [
            { id: "", text: "" },
            { id: "Sendiri", text: "Sendiri" },
            { id: "Diantar Keluarga/Rekan", text: "Diantar Keluarga/Rekan" },
            { id: "Diantar Polisi", text: "Diantar Polisi" },
            { id: "Ambulance", text: "Ambulance" },
            { id: "Rujukan", text: "Rujukan" },
        ],
    });
};

const initializeAllSelect2InPendaftaran = () => {
    initializeSelect2({
        selectId: "#pasien_id",
        placeholder: "Nama Pasien - NIK - Tanggal Lahir",
        url: "api/pasien",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text:
                        item.nama_pasien +
                        " - " +
                        item.nik +
                        " - " +
                        item.tanggal_lahir,
                });
            });

            return { results: results };
        },
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

    const initLayananSelect2 = () => {
        initializeSelect2({
            selectId: "#layanan_id",
            placeholder: "Pilih Layanan",
            url: "api/layanan",
            useHeaders: true,
            data: {
                instalasi_id: $("#instalasi_id").val(),
            },
            processResultsCallback: function (data) {
                const results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.kode_layanan + " - " + item.nama_layanan,
                        wajib_rujukan: item.wajib_rujukan,
                    });
                });

                return { results: results };
            },
        });
    };

    const initDokterSelect2 = () => {
        initializeSelect2({
            selectId: "#dokter_id",
            placeholder: "Pilih Dokter",
            url: "api/dokter",
            useHeaders: true,
            data: {
                layanan_id: $("#layanan_id").val(),
            },
            processResultsCallback: function (data) {
                const results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.nama_dokter + " - " + item.sip,
                    });
                });

                return { results: results };
            },
        });
    };

    initializeSelect2({
        selectId: "#jaminan_id",
        placeholder: "Pilih Jaminan",
        url: "api/jaminan",
        useHeaders: true,
        processResultsCallback: function (data) {
            const results = [];
            $.each(data, function (index, item) {
                results.push({
                    id: item.id,
                    text: item.nama_jaminan,
                    wajib_rujukan: item.wajib_rujukan,
                    wajib_keterangan_jaminan: item.wajib_keterangan_jaminan,
                });
            });

            return { results: results };
        },
    });

    const initTindakanSelect2 = () => {
        initializeSelect2({
            selectId: "#tindakan_id",
            placeholder: "Pilih Tindakan",
            url: "api/tindakan",
            useHeaders: true,
            data: {
                layanan_id: $("#layanan_id").val(),
            },
            processResultsCallback: function (data) {
                const results = [];
                $.each(data, function (index, item) {
                    results.push({
                        id: item.id,
                        text: item.nama_tindakan,
                    });
                });

                return { results: results };
            },
        });
    };

    initCaraMasukSelect2();

    initLayananSelect2();
    initDokterSelect2();
    initTindakanSelect2();
    reinitializedSelect2OnChange("#instalasi_id", initLayananSelect2);
    reinitializedSelect2OnChange("#layanan_id", initDokterSelect2);
    reinitializedSelect2OnChange("#layanan_id", initTindakanSelect2);

    $("#instalasi_id").on("select2:select", function () {
        $("#layanan_id").val(null).trigger("change");
        $("#dokter_id").val(null).trigger("change");
        $("#tindakan_id").val(null).trigger("change");
    });

    $("#instalasi_id").on("select2:clear", function () {
        $("#layanan_id").val(null).trigger("change");
        $("#dokter_id").val(null).trigger("change");
        $("#tindakan_id").val(null).trigger("change");
    });

    $("#layanan_id").on("select2:select", function (e) {
        var data = e.params.data;

        $("#dokter_id").val(null).trigger("change");
        $("#tindakan_id").val(null).trigger("change");

        $("#wajib_rujukan_layanan").val(data.wajib_rujukan);
        logicWajibRujukan();
    });

    $("#jaminan_id").on("select2:select", function (e) {
        var data = e.params.data;

        $("#wajib_rujukan_jaminan").val(data.wajib_rujukan);
        $("#wajib_keterangan_jaminan").val(data.wajib_keterangan_jaminan);

        logicWajibRujukan();
        logicKeteranganJaminan();
    });

    $("#layanan_id").on("select2:clear", function (e) {
        $("#wajib_rujukan_layanan").val("0");
        $("#dokter_id").val(null).trigger("change");
        $("#tindakan_id").val(null).trigger("change");
    });

    $("#jaminan_id").on("select2:clear", function (e) {
        $("#wajib_rujukan_jaminan").val("0");
        $("#wajib_keterangan_jaminan").val("0");

        logicWajibRujukan();
        logicKeteranganJaminan();
    });
};

const logicKeteranganJaminan = () => {
    const keteranganJaminan = $("#wajib_keterangan_jaminan").val();

    if (keteranganJaminan == 1) {
        $(".tanda_wajib_keterangan").removeClass("hidden");
    } else {
        $(".tanda_wajib_keterangan").addClass("hidden");
    }
};

const logicWajibRujukan = () => {
    const wajibRujukanLayanan = $("#wajib_rujukan_layanan").val();
    const wajibRujukanJaminan = $("#wajib_rujukan_jaminan").val();

    if (wajibRujukanJaminan == 1 && wajibRujukanLayanan == 1) {
        $(".tanda_wajib_rujukan").removeClass("hidden");
    } else {
        $(".tanda_wajib_rujukan").addClass("hidden");
    }
};

const submitPendaftaran = () => {
    $("#formPendaftaran").submit(function (e) {
        e.preventDefault();
        const url = this.getAttribute("action");
        $("#submitFormPendaftaran")
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
                    title: "Berhasil",
                    text: res.message,
                    icon: "success",
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = res.url;
                    }
                });

                setTimeout(() => {
                    window.location.href = res.url;
                }, 2000);

                $("#submitFormUPendaftaran")
                    .html("Submit")
                    .prop("disabled", false);
            },
            error: function (res) {
                let errors = res.responseJSON?.errors;
                $("#formPendaftaran").find(".text-red-500.text-sm").remove();

                generateFormErrorMessage(errors);

                $("#submitFormPendaftaran")
                    .html("Submit")
                    .prop("disabled", false);
            },
        });
    });
};

const updatePendaftaran = () => {
    initializeSelect2Data("pasien-id-value", "pasien_id");
    initializeSelect2Data("instalasi-id-value", "instalasi_id");
    initializeSelect2Data("layanan-id-value", "layanan_id");
    initializeSelect2Data("dokter-id-value", "dokter_id");
    initializeSelect2Data("jaminan-id-value", "jaminan_id");
    initializeSelect2Data("cara-masuk-value", "cara_masuk");
    initializeSelect2Data("tindakan-id-value", "tindakan_id");
};

const deletePendaftaran = (id) => {
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
                url: baseUrl + `pendaftaran/${id}`,
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
                    window.LaravelDataTables["pendaftaran-table"].ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    alert("Error deleting data");
                },
            });
        }
    });
};

const getDataPasienLama = (id) => {
    $.ajax({
        type: "POST",
        url: baseUrl + "api/pasien-lama",
        data: {
            pasien_id: id,
        },
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (res) {
            let id = res.id;
            let text =
                res.nama_pasien + " - " + res.nik + " - " + res.tanggal_lahir;

            const select = $(`#pasien_id`);
            const optionExists =
                select.find(`option[value="${id}"]`).length > 0;

            if (optionExists) {
                select.val(id).trigger("change");
            } else {
                const option = new Option(text, id, true, true);
                select.append(option).trigger("change");
            }
        },
    });
};
