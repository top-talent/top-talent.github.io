@if($currentStock > 0 || $currentVariantStock > 0)
    <span class="label label-success">{{ $currentStock }} In Stock ({{ $currentVariantStock }} from Variants)</span>
@else
    <span class="label label-danger">No Stock</span>
@endif
