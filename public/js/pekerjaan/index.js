$("#buttonTambahPekerjaan").click(function () {
    $("#showModalPekerjaan").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormPekerjaan").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `pekerjaan/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormPekerjaan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Pekerjaan");

            submitPekerjaan();
        },
    });
});

$("#pekerjaan-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deletePekerjaan(id);
    }

    if (jenis == "edit") {
        $("#showModalPekerjaan").click();
        updatePekerjaan(id);
    }
});
