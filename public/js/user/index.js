$("#buttonTambahUser").click(function () {
    $("#showModalUser").click();
    $("#modal-header").addClass("hidden").removeClass("flex");
    $("#modalFormUser").find(".modal-dialog").html(setBigLoading());
    $.ajax({
        url: baseUrl + `user/create`,
        type: "GET",
        success: function (res) {
            $("#modal-header").removeClass("hidden").addClass("flex");
            $("#modalFormUser").find(".modal-dialog").html(res);
            $("#modalTitle").text("Tambah User");
            initializeSelect2Role();
            submitUser();
        },
    });
});

$("#user-table").on("click", ".action", function () {
    let data = $(this).data();
    let id = data.id;
    let jenis = data.jenis;

    if (jenis == "delete") {
        deleteUser(id);
    }

    if (jenis == "edit") {
        $("#showModalUser").click();
        updateUser(id);
    }
});
