@php
$chinaCategories = App\Models\Category::with('products')->where('parent_id', '1')->get();
@endphp
<div class="features">
    <h3>Features</h3>
    <ul>
    @foreach ($chinaCategories as $cat)
        <li> {{ $cat->name }} </li>
    @endforeach
    </ul>
</div>  