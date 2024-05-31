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


// select product
$('.select-product').on('click', function() {


    var product_id = $('#product-arr').val(); // Lấy giá trị ID của sản phẩm được chọn
    var additional_stock = $('#stock').val(); // Lấy số lượng nhập thêm
    var url = $(this).data('url') + '/' + product_id; // Lấy URL từ data-url và thêm product_id
    if(!product_id){
        alert("Vui lòng chọn hàng hóa")
        return false;

    }
    if(!additional_stock){
        alert("Vui lòng nhập số lượng")
        return false;
    }
   
    if (product_id) {
        $.ajax({
            url: url, 
            type: 'GET',
            dataType: 'json',
            data: {
                stock: additional_stock 
            },
            success: function(data) {
                if (data) {
                    // Tạo hàng trong bảng hiển thị danh sách hàng hóa
                    var row = '<tr>';
                    row += '<td>' + data.id + '<input type="hidden" name="product_ids[]" value="' + data.id + '"> </td>'; // ID sản phẩm
                    row += '<td>' + data.name + '</td>'; // Tên sản phẩm
                    row += '<td><img src="' + data.avatar + '" alt="" class="product_img"></td>'; // Ảnh sản phẩm
                    row += '<td>' + data.purchase_price + '</td>'; // Đơn giá mua
                    row += '<td> ' + data.stock + '<input type="hidden" name="quantity[]" value="' + data.stock + '"></td>'; // Số lượng
                    row += '<td class="total-price">' +  data.total + '</td>'; // Thành tiền
                    row += '<td><div class="btn btn-danger remove-product">Xóa</div></td>'; // Nút xóa hàng
                    row += '</tr>';
                    // Thêm hàng vào tbody của bảng
                    $('.item-product-order').append(row);
                }
            }
        });
    }
});

// get modal
$(".show-modal").on("click", function(){
    var url = $(this).data("url")
    $.ajax({
        url: url,
        dataType: 'html',
        type: "get",
        success: function(response) {
            $("#showModal").html(response)
        }
    })
})
