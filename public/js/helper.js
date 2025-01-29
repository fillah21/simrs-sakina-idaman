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

            $(`[name="${key}"]`).on("change keyup", function () {
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

$.datepicker.regional["id"] = {
    closeText: "Tutup",
    prevText: "‹",
    nextText: "›",
    currentText: "Hari ini",
    monthNames: [
        "Januari",
        "Februari",
        "Maret",
        "April",
        "Mei",
        "Juni",
        "Juli",
        "Agustus",
        "September",
        "Oktober",
        "November",
        "Desember",
    ],
    monthNamesShort: [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "Mei",
        "Jun",
        "Jul",
        "Agu",
        "Sep",
        "Okt",
        "Nov",
        "Des",
    ],
    dayNames: ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"],
    dayNamesShort: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    dayNamesMin: ["Min", "Sen", "Sel", "Rab", "Kam", "Jum", "Sab"],
    weekHeader: "Sen",
    dateFormat: "dd/mm/yy",
    firstDay: 0,
    isRTL: false,
    showMonthAfterYear: false,
    yearSuffix: "",
};

$.datepicker.setDefaults($.datepicker.regional["id"]);

const initializeDatepicker = (inputId) => {
    $(inputId).datepicker({
        altFormat: "dd-mm-yyyy",
        dateFormat: "dd/mm/yy",
        changeMonth: true,
        changeYear: true,
        yearRange: "c-100:c+10",
    });
};

const initializeSelect2 = (
    config = {
        selectId: "",
        placeholder: "Pilih Item",
        url: "",
        data: {},
        processResultsCallback: null,
        customSelect2Prop: {},
        useHeaders: true,
    }
) => {
    $(config.selectId).select2({
        placeholder: config.placeholder,
        allowClear: true,
        ajax: {
            url: baseUrl + config.url,
            type: "POST",
            dataType: "json",
            delay: 250,
            ...(config.useHeaders && {
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            }),
            data: function (params) {
                return {
                    keyword: params.term,
                    ...config.data,
                };
            },
            processResults:
                config.processResultsCallback ??
                function (data) {
                    let results = [];

                    $.each(data, function (index, item) {
                        results.push({
                            id: item.id,
                            text: item.name,
                        });
                    });

                    return { results: results };
                },
        },
        ...config.customSelect2Prop,
    });
};

const reinitializedSelect2OnChange = (inputId, select2InitFunc) => {
    $(inputId).change(function () {
        select2InitFunc();
    });
};
