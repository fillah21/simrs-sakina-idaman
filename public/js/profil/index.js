$("#formProfil").submit(function (e) {
    e.preventDefault();
    const url = this.getAttribute("action");
    $("#submitFormProfil").html(setButtonLoading()).prop("disabled", true);

    $.ajax({
        type: "POST",
        url,
        data: $(this).serialize(),
        dataType: "json",
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (res) {
            Swal.fire({
                title: "Berhasil",
                text: res.message,
                icon: "success",
            }).then((result) => {
                if (result.isConfirmed) {
                    location.reload();
                }
            });

            setTimeout(() => {
                location.reload();
            }, 2000);

            $("#submitFormProfil").html("Submit").prop("disabled", false);
        },
        error: function (res) {
            let errors = res.responseJSON?.errors;
            $("#formProfil").find(".text-red-500.text-sm").remove();

            generateFormErrorMessage(errors);

            $("#submitFormProfil").html("Submit").prop("disabled", false);
        },
    });
});
