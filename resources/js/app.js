import "./bootstrap";
import $, { event } from "jquery";

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

// select product
$(".select-product").on("click", function () {
    var product_id = $("#product-arr").val(); // Lấy giá trị ID của sản phẩm được chọn
    var additional_stock = $("#stock").val(); // Lấy số lượng nhập thêm
    var url = $(this).data("url") + "/" + product_id; // Lấy URL từ data-url và thêm product_id
    var type = $(this).data("type"); // Lấy số lượng nhập thêm

    if (!product_id) {
        alert("Vui lòng chọn hàng hóa");
        return false;
    }
    if (!additional_stock) {
        alert("Vui lòng nhập số lượng");
        return false;
    }

    if (product_id) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            data: {
                stock: additional_stock,
                type: type,
            },
            success: function (data) {
                if(data.success == false){
                    alert(data.message);
                    return false;
                }
                if (data) {
                    // Tạo hàng trong bảng hiển thị danh sách hàng hóa
                    var row = "<tr>";
                    row +=
                        "<td>" +
                        data.id +
                        '<input type="hidden" name="product_ids[]" value="' +
                        data.id +
                        '"> <input type="hidden" name="type[]" value="old_product"> </td>'; // ID sản phẩm
                    row += "<td>" + data.name + "</td>"; // Tên sản phẩm
                    row +=
                        '<td><img src="' +
                        data.avatar +
                        '" alt="" class="product_img"></td>'; // Ảnh sản phẩm
                    row +=
                        "<td>" +
                        data.purchase_price +
                        ' <input type="hidden" name="purchase_price_number[]" value="' +
                        data.purchase_price_number +
                        '"> </td>'; // Đơn giá mua
                    row +=
                        "<td> " +
                        data.stock +
                        '<input type="hidden" name="quantity[]" value="' +
                        data.stock +
                        '"></td>'; // Số lượng
                    row +=
                        '<td class="total-price">' +
                        data.total +
                        '<input type="hidden" name="total_price[]" value="' +
                        data.total_price_number +
                        '"> </td>'; // Thành tiền
                    row +=
                        '<td><div class="btn btn-danger remove-product">Xóa</div></td>'; // Nút xóa hàng
                    row += "</tr>";
                    // Thêm hàng vào tbody của bảng
                    $(".item-product-order").append(row);
                }
            },
        });
    }
});
$(".select-product-export").on("click", function () {
    var product_id = $("#product-arr").val(); // Lấy giá trị ID của sản phẩm được chọn
    var additional_stock = $("#stock").val(); // Lấy số lượng nhập thêm
    var url = $(this).data("url") + "/" + product_id; // Lấy URL từ data-url và thêm product_id
    var type = $(this).data("type"); // Lấy số lượng nhập thêm

    if (!product_id) {
        alert("Vui lòng chọn hàng hóa");
        return false;
    }
    if (!additional_stock) {
        alert("Vui lòng nhập số lượng");
        return false;
    }

    if (product_id) {
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            data: {
                stock: additional_stock,
                type: type,
            },
            success: function (data) {
                if(data.success == false){
                    alert(data.message);
                    return false;
                }
                if (data) {
                    // Tạo hàng trong bảng hiển thị danh sách hàng hóa
                    var row = "<tr>";
                    row +=
                        "<td>" +
                        data.id +
                        '<input type="hidden" name="product_ids[]" value="' +
                        data.id +
                        '"> <input type="hidden" name="type[]" value="old_product"> </td>'; // ID sản phẩm
                    row += "<td>" + data.name + "</td>"; // Tên sản phẩm
                    row +=
                        '<td><img src="' +
                        data.avatar +
                        '" alt="" class="product_img"></td>'; // Ảnh sản phẩm
                    row +=
                        "<td>" +
                        data.selling_price +
                        ' <input type="hidden" name="selling_price_number[]" value="' +
                        data.selling_price_number +
                        '"> </td>'; // Đơn giá mua
                    row +=
                        "<td> " +
                        data.stock +
                        '<input type="hidden" name="quantity[]" value="' +
                        data.stock +
                        '"></td>'; // Số lượng
                    row +=
                        '<td class="total-price">' +
                        data.total_export +
                        '<input type="hidden" name="total_price_number_export[]" value="' +
                        data.total_price_number_export +
                        '"> </td>'; // Thành tiền
                    row +=
                        '<td><div class="btn btn-danger remove-product">Xóa</div></td>'; // Nút xóa hàng
                    row += "</tr>";
                    // Thêm hàng vào tbody của bảng
                    $(".item-product-order").append(row);
                }
            },
        });
    }
});
// get modal
$(".show-modal").on("click", function () {
    var url = $(this).data("url");
    $.ajax({
        url: url,
        dataType: "html",
        type: "get",
        success: function (response) {
            $("#showModal").html(response);
        },
    });
});

$(".submit-order").on("click",function(event){
    var itemOrders = $('.item-product-order');
    if(itemOrders.children().length === 0){
        alert('Vui lòng nhập ít nhất một hàng hóa và0 đơn hàng')
        event.preventDefault();
    }
})