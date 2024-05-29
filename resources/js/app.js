import "./bootstrap";
import $ from "jquery";

$(document).ready(function () {
    $(".menu-link").click(function (e) {
        e.preventDefault();
        var submenu = $(this).siblings(".sub-menu");
        var arrow = $(this).siblings(".arrow-menu");
        submenu.slideToggle();
        arrow.toggleClass("active-menu");
    });

    // upload service
    $("#upload").on("change", function () {
        const form = new FormData();
        form.append("file", $(this)[0].files[0]);
        var url = $(this).data("url");
        var csrfToken = $('meta[name="csrf-token"]').attr("content");

        $.ajax({
            processData: false,
            contentType: false,
            type: "POST",
            dataType: "json",
            headers: {
                "X-CSRF-TOKEN": csrfToken,
            },
            data: form,
            url: url,
            success: function (response) {
                if (response.error == false) {
                    $("#preview").html(
                        '<a href=" "><img src= " ' + response.url + ' " ></a>'
                    );
                    $("#file").val(response.url);
                } else {
                    alert("Tải file thất bại");
                }
            },
        });
    });
});

// export default $;
