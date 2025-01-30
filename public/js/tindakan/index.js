$("#buttonTambahTindakan").click(function () {
    $("#showModalTindakan").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormTindakan").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `tindakan/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormTindakan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Tindakan");
            initializeSelect2Layanan();

            submitTindakan();
        },
    });
});

$("#tindakan-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deleteTindakan(id);
    }

    if (jenis == "edit") {
        $("#showModalTindakan").click();
        updateTindakan(id);
    }
});
