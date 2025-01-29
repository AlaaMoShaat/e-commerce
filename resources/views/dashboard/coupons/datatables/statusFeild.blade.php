<p id="status_{{ $coupon->id }}" style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
    class="@if ($coupon->status == '1') btn-success  @else btn-danger @endif">
    {{ $coupon->getStatusTranslatable() }}
</p>
