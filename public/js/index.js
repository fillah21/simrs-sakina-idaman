const setBigLoading = () => {
    return `<div class="flex justify-center items-center"><div class="custom-loader"></div></div>`;
};

const setButtonLoading = () => {
    return `<div class="button-loader"></div>`;
};

const generateFormErrorMessage = (errors) => {
    if (errors) {
        for (const [key, value] of Object.entries(errors)) {
            $(`[name="${key}"]`)
                .parent()
                .append(`<span class="text-red-500 text-sm">${value}</span>`);

            $(`[name="${key}"]`).on("change", function () {
                $(this).parent().find(".text-red-500.text-sm").remove();
            });
        }
    }
};

const initializeSelect2Data = (inputId, targetId) => {
    let data = $(`#${inputId}`).val().split("|");
    let id = data[0];
    let text = data[1];

    const select = $(`#${targetId}`);
    const optionExists = select.find(`option[value="${id}"]`).length > 0;

    if (optionExists) {
        select.val(id).trigger("change");
    } else {
        const option = new Option(text, id, true, true);
        select.append(option).trigger("change");
    }
};
