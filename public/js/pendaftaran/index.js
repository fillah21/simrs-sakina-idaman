const urlNow = window.location.pathname;

const urlSplit = urlNow.split("/");

if (urlSplit.includes("create")) {
    initializeAllSelect2InPendaftaran();
    initializeDateTimePicker("#waktu_kunjungan");

    logicWajibRujukan();
    logicKeteranganJaminan();

    submitPendaftaran();
} else if (urlSplit.includes("edit")) {
    initializeAllSelect2InPendaftaran();
    initializeDateTimePicker("#waktu_kunjungan");

    logicWajibRujukan();
    logicKeteranganJaminan();

    submitPendaftaran();

    updatePendaftaran();
}

$("#pendaftaran-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deletePendaftaran(id);
    }
});
