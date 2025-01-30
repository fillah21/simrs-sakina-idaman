$("#buttonTambahInstalasi").click(function () {
    $("#showModalInstalasi").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormInstalasi").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `instalasi/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormInstalasi").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Instalasi");
            initializeSelect2IsAntrian();

            submitInstalasi();
        },
    });
});

$("#instalasi-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deleteInstalasi(id);
    }

    if (jenis == "edit") {
        $("#showModalInstalasi").click();
        updateInstalasi(id);
    }
});
