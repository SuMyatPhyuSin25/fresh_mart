@extends('customer.layouts.master')

@section('content')

<div class="container py-5 mt-5">

<div class="card shadow border-0">

<div class="card-body p-5">

<h2 class="text-primary mb-4">
Frequently Asked Questions
</h2>

<div class="accordion" id="faq">

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button"
data-bs-toggle="collapse"
data-bs-target="#one">

How do I place an order?

</button>

</h2>

<div id="one"
class="accordion-collapse collapse show">

<div class="accordion-body">

Add products to your cart and complete checkout.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#two">

How can I pay?

</button>

</h2>

<div id="two"
class="accordion-collapse collapse">

<div class="accordion-body">

We accept the payment methods listed on the checkout page.

</div>

</div>

</div>

<div class="accordion-item">

<h2 class="accordion-header">

<button class="accordion-button collapsed"
data-bs-toggle="collapse"
data-bs-target="#three">

Can I cancel my order?

</button>

</h2>

<div id="three"
class="accordion-collapse collapse">

<div class="accordion-body">

Please contact customer support before your order is shipped.

</div>

</div>

</div>

</div>

</div>

</div>

</div>

@endsection