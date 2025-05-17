<p id="status_{{ $category->id }}" style="align-items: center; border-radius: 6px; text-align: center; text-align: center"
    class="@if ($category->status == '1') btn-success  @else btn-danger @endif">
    {{ $category->getStatusTranslatable() }}
</p>
