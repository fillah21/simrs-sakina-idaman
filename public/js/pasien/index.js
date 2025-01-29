$("#buttonTambahPasien").click(function () {
    $("#showModalPasien").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormPasien").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `pasien/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormPasien").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Pasien");
            initAllSelect2Pasien();
            submitPasien();

            initializeDatepicker("#tanggal_lahir");
        },
    });
});

$("#pasien-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deletePasien(id);
    }

    if (jenis == "edit") {
        $("#showModalPasien").click();
        updatePasien(id);
    }
});
