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

$("#buttonPasienLama").click(function (e) {
    e.preventDefault();

    const idPasien = $("#pasien_id").val();

    if (idPasien == null) {
        $(`[name="pasien_id"]`)
            .parent()
            .append(
                `<span class="text-red-500 text-sm">Pasien Tidak Boleh Kosong</span>`
            );

        $(`[name="pasien"]`).on("change keyup", function () {
            $(this).parent().find(".text-red-500.text-sm").remove();
        });
    } else {
        window.location.href =
            baseUrl + `pendaftaran/create?pasien_id=${idPasien}`;
    }
});
