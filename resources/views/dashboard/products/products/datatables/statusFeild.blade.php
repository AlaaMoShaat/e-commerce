<p id="status_{{ $product->id }}" style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
    class="@if ($product->status == '1') btn-success  @else btn-danger @endif">
    {{ $product->getStatusTranslatable() }}
</p>
