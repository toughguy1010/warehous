<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chi tiết tồn kho</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">STT</th>
                            <th scope="col">Tên hàng hóa</th>
                            <th scope="col">Ảnh</th>
                            <th scope="col">Giá bán</th>
                            <th scope="col">Giá mua</th>
                            <th scope="col">Số lượng</th>
            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $product)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td>
                                    <img src="{{ showImage($product->avatar) }}" alt="" class="product_img">
                                </td>
                                <td>{{ showPrice($product->purchase_price)  }}</td>
                                <td>{{ showPrice($product->selling_price) }}</td>
                                <td>{{ $product->stock }}</td>
                               
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>