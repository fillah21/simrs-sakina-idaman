$("#buttonTambahLayanan").click(function () {
    $("#showModalLayanan").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormLayanan").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `layanan/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormLayanan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Layanan");
            initializeSelect2WajibRujukan();

            submitLayanan();
        },
    });
});

$("#layanan-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deleteLayanan(id);
    }

    if (jenis == "edit") {
        $("#showModalLayanan").click();
        updateLayanan(id);
    }
});
