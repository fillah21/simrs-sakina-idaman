$("#buttonTambahJaminan").click(function () {
    $("#showModalJaminan").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormJaminan").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `jaminan/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormJaminan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Jaminan");
            initializeSelect2WajibKeteranganJaminan();
            initializeSelect2WajibRujukan();

            submitJaminan();
        },
    });
});

$("#jaminan-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deleteJaminan(id);
    }

    if (jenis == "edit") {
        $("#showModalJaminan").click();
        updateJaminan(id);
    }
});
