<div class="box box-info padding-1">
    <div class="box-body">
        <div class="form-group">
            <label for="products_id">Products Id</label>
            <select name="products_id" id="products_id" class="form-control">
                <option value="">Select a product</option>
                @foreach($products as $product)
                <option value="{{ $product->id }}" data-price="{{ $product->price_unit }}">{{ $product->product_name }}</option>
                @endforeach
            </select>
            {!! $errors->first('products_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('price_unit', 'Price') }}
            <input type="text" id="price_unit" class="form-control price-unit" readonly>
        </div>
        <div class="form-group">
            {{ Form::label('amount', 'Amount') }}
            {{ Form::text('amount', $detailsSale->amount, ['class' => 'form-control' . ($errors->has('amount') ? ' is-invalid' : ''), 'placeholder' => 'Amount']) }}
            {!! $errors->first('amount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('discount', 'Discount') }}
            {{ Form::text('discount', $detailsSale->discount, ['class' => 'form-control' . ($errors->has('discount') ? ' is-invalid' : ''), 'placeholder' => 'Discount']) }}
            {!! $errors->first('discount', '<div class="invalid-feedback">:message</div>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('sales_id', 'Sales Id') }}
            {{ Form::text('sales_id', $detailsSale->sales_id, ['class' => 'form-control' . ($errors->has('sales_id') ? ' is-invalid' : ''), 'placeholder' => 'Sales Id']) }}
            {!! $errors->first('sales_id', '<div class="invalid-feedback">:message</div>') !!}
        </div>
    </div>
    <br>
    <div class="box-footer mt20">
        <button type="button" class="btn btn-primary" id="addProductBtn">Add Product</button>
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
        <a class="btn btn-primary" href="{{ route('details_sale.index') }}">
            <i class="fas fa-arrow-left"></i> {{ __("Back") }}
        </a>
    </div>
</div>

<div style="margin-top: 40px;"> <!-- Espacio entre el formulario y la tabla -->
    <div id="selectedProductsContainer">
        <h3>Selected Products</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Amount</th>
                    <th>Discount</th>
                    <th>Sales Id</th>
                </tr>
            </thead>
            <tbody id="selectedProductsBody">
            </tbody>
        </table>
    </div>
</div>

<style>
    .price-unit {
        width: 150px;
        height: 30px;
    }
</style>

<script>
    document.getElementById('products_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var priceField = document.getElementById('price_unit');
        if (selectedOption.hasAttribute('data-price')) {
            priceField.value = selectedOption.getAttribute('data-price');
        } else {
            priceField.value = 'Price not available';
        }
    });

    document.getElementById('addProductBtn').addEventListener('click', function() {
        var selectedOption = document.getElementById('products_id').options[document.getElementById('products_id').selectedIndex];
        var productName = selectedOption.textContent;
        var productId = selectedOption.value;
        var productPrice = selectedOption.getAttribute('data-price');
        var amount = document.getElementById('amount').value;
        var discount = document.getElementById('discount').value;
        var salesId = document.getElementById('sales_id').value;

        var selectedProductsBody = document.getElementById('selectedProductsBody');
        var newRow = selectedProductsBody.insertRow();
        var cell1 = newRow.insertCell(0);
        var cell2 = newRow.insertCell(1);
        var cell3 = newRow.insertCell(2);
        var cell4 = newRow.insertCell(3);
        var cell5 = newRow.insertCell(4);

        cell1.innerHTML = productName;
        cell2.innerHTML = productPrice;
        cell3.innerHTML = amount;
        cell4.innerHTML = discount;
        cell5.innerHTML = salesId;

        // Limpiar los campos
        document.getElementById('products_id').selectedIndex = 0;
        document.getElementById('price_unit').value = '';
        document.getElementById('amount').value = '';
        document.getElementById('discount').value = '';
    });
</script>