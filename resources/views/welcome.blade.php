<h3>Default Route In Laravel</h3>

<a href="{{ route('product.index') }} ">Product</a>
<a href="">News</a>
<a href="">Categories</a>
<a href="">Contact</a>
<a href="">Maps</a>

<ul>
    <li><a href="{{ route('product.show', ['id' => 1]) }}">Product Item 1</a></li>
    <li><a href="{{ route('product.show', ['id' => 2]) }}">Product Item 2</a></li>
    <li><a href="">Product Item 3</a></li>
    <li><a href="">Product Item 4</a></li>
    <li><a href="">Product Item 5</a></li>
    <li><a href="">Product Item 6</a></li>
</ul>
