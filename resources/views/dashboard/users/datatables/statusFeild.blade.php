<p id="status_{{ $user->id }}" style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
    class="@if ($user->status == '1') btn-success  @else btn-danger @endif">
    {{ $user->getStatusTranslatable() }}
</p>
