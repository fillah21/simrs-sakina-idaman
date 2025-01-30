$("#buttonTambahPendidikan").click(function () {
    $("#showModalPendidikan").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormPendidikan").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `pendidikan/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormPendidikan").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah Pendidikan");

            submitPendidikan();
        },
    });
});

$("#pendidikan-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deletePendidikan(id);
    }

    if (jenis == "edit") {
        $("#showModalPendidikan").click();
        updatePendidikan(id);
    }
});
