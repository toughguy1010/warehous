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
                            placeholder="Nhập tên hàng hóa">
                    </div>
                    <div class="col-6">
                        <label for="namecustomer" class="form-label">Mô tả hàng hóa </label>
                        <input type="text" class="form-control" name="description" value=""
                            placeholder="Nhập mô tả hàng hóa">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class=" col-6">
                        <label for="nameproduct" class="form-label">Giá mua <span class="required">*</span></label>
                        <input type="text" class="form-control" name="purchase_price" value=""
                            placeholder="Nhập giá mua">
                    </div>
                    <div class="col-6">
                        <label for="namecustomer" class="form-label">Giá bán <span class="required">*</span></label>
                        <input type="text" class="form-control" name="selling_price" value=""
                            placeholder="Nhập giá bán">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class=" col-6">
                        <label for="nameproduct" class="form-label">Nhà cung cấp </label>
                        <select class="form-select" aria-label="Default select example" name="supplier_id">
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
                        <select class="form-select" aria-label="Default select example" name="unit_id">
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
                            placeholder="Nhập số lượng hàng hóa">
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
                <div type="button" class="btn btn-primary">Tạo hàng hóa</div>
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
</script>
