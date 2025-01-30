$("#buttonTambahAgama").click(function () {
    $("#showModalAgama").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormAgama").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `agama/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormAgama").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Agama");

            submitAgama();
        },
    });
});

$("#agama-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deleteAgama(id);
    }

    if (jenis == "edit") {
        $("#showModalAgama").click();
        updateAgama(id);
    }
});
