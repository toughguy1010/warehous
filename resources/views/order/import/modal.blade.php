<div class="modal fade" id="addProduct" tabindex="-1" aria-labelledby="addProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductLabel">Thêm hàng hóa nhập</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class=" col-6">
                        <label for="nameproduct" class="form-label">Tên hàng hóa <span class="required">*</span></label>
                        <input type="text" class="form-control" name="name" value=""
                            placeholder="Nhập tên hàng hóa" id="name">
                    </div>
                    <div class="col-6">
                        <label for="namecustomer" class="form-label">Mô tả hàng hóa </label>
                        <input type="text" class="form-control" name="description" value=""
                            placeholder="Nhập mô tả hàng hóa" id="description">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class=" col-6">
                        <label for="nameproduct" class="form-label">Giá mua <span class="required">*</span></label>
                        <input type="text" class="form-control" name="purchase_price" value=""
                            placeholder="Nhập giá mua" id="purchase_price">
                    </div>
                    <div class="col-6">
                        <label for="namecustomer" class="form-label">Giá bán <span class="required">*</span></label>
                        <input type="text" class="form-control" name="selling_price" value=""
                            placeholder="Nhập giá bán" id="selling_price">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class=" col-6">
                        <label for="nameproduct" class="form-label">Nhà cung cấp </label>
                        <select class="form-select" aria-label="Default select example" name="supplier_id"
                            id="supplier_id">
                            <option value="">--Chọn nhà cung cấp---</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">
                                    {{ $supplier->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class=" col-6">
                        <label for="nameproduct" class="form-label">Đơn vị <span class="required">*</span></label>
                        <select class="form-select" aria-label="Default select example" name="unit_id" id="unit_id">
                            <option value="">--Chọn đơn vị---</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">
                                    {{ $unit->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-6">
                        <label for="namecustomer" class="form-label">Số lượng hàng hóa <span
                                class="required">*</span></label>
                        <input type="text" class="form-control" name="stock" value=""
                            placeholder="Nhập số lượng hàng hóa" id="add_stock">
                    </div>
                    <div class=" col-6">
                        <label for="formFile" class="form-label">Ảnh đại diện</label>
                        <input class="form-control" type="file" id="upload" name="file"
                            data-url="{{ route('upload.services') }}">

                        <div id="preview">

                        </div>
                        <input type="hidden" id="file" name="avatar">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</div>
                <div type="button" class="btn btn-primary create-product-ajax"
                    data-url="{{ route('product.upsert.store') }}">Tạo hàng hóa</div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#addProduct").modal('show');

    // upload service
    $("#upload").on("change", function() {
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
            success: function(response) {
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
    // add product
    $('.create-product-ajax').on('click', function() {
        const url = $(this).data("url");
        const data = {
            name: $("#name").val(),
            description: $("#description").val(),
            purchase_price: $("#purchase_price").val(),
            selling_price: $("#selling_price").val(),
            supplier_id: $("#supplier_id").val(),
            unit_id: $("#unit_id").val(),
            stock: $("#add_stock").val(),
            avatar: $("#file").val(),
        };
        console.log(data);
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
            },
            success: function(response) {
                if (response.success == true) {
                    // Tạo hàng trong bảng hiển thị danh sách hàng hóa
                    var row = '<tr>';
                    row += '<td>' + response.id +
                        '<input type="hidden" name="product_ids[]" value="' + response.id +
                        '"> <input type="hidden" name="type[]" value="new_product"> </td>'; // ID sản phẩm
                    row += '<td>' + response.name + '</td>'; // Tên sản phẩm
                    row += '<td><img src="' + response.avatar +
                        '" alt="" class="product_img"></td>'; // Ảnh sản phẩm
                    row += '<td>' + response.purchase_price +
                        '<input type="hidden" name="purchase_price_number[]" value="' + response
                        .total_price_number +
                        '"></td>'; // Đơn giá mua
                    row += '<td> ' + response.stock +
                        '<input type="hidden" name="quantity[]" value="' + response.stock +
                        '"></td>'; // Số lượng
                    row += '<td class="total-price">' + response.total +
                        '<input type="hidden" name="total_price[]" value="' + response
                        .total_price_number +
                        '"></td>'; // Thành tiền
                    row +=
                        '<td><div class="btn btn-danger remove-product">Xóa</div></td>'; // Nút xóa hàng
                    row += '</tr>';
                    // Thêm hàng vào tbody của bảng
                    $('.item-product-order').append(row);
                    $("#addProduct").modal('hide');

                }
            },
            error: function(xhr) {
                let errors = xhr.responseJSON.errors;
                let errorMessages = Object.values(errors).map(err => err.join("\n")).join("\n");
                alert(`Có lỗi xảy ra:\n${errorMessages}`);
            }
        });
    })
</script>
