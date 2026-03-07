{{-- Desktop --}}
<div class="flex flex-col max-md:hidden gap-0.5">
    @if($address->company_name ?? '')
        <p class="text-sm font-semibold" style="color:var(--foreground);">{{ $address->company_name }}</p>
    @endif
    <p class="text-sm font-semibold" style="color:var(--foreground);">{{ $address->name }}</p>
    <p class="text-sm leading-6" style="color:var(--muted-foreground);">
        {{ $address->address }}<br>
        {{ $address->city }}<br>
        {{ $address->state }}<br>
        {{ core()->country_name($address->country) }}@if ($address->postcode) &nbsp;({{ $address->postcode }})@endif<br>
        <span style="color:var(--foreground);font-weight:500;">
            {{ __('shop::app.customers.account.orders.view.contact') }}: {{ $address->phone }}
        </span>
    </p>
</div>

{{-- Mobile --}}
<div class="md:hidden">
    @if($address->company_name ?? '')
        <p class="text-xs font-semibold" style="color:var(--foreground);">{{ $address->company_name }}</p>
    @endif
    <p class="text-xs" style="color:var(--muted-foreground);">
        <span style="font-weight:600;color:var(--foreground);">{{ $address->name }}</span>
        &nbsp;&mdash;&nbsp;
        {{ $address->address }},
        {{ $address->city }},
        {{ $address->state }},
        {{ core()->country_name($address->country) }}@if ($address->postcode) &nbsp;({{ $address->postcode }})@endif<br>
        <span class="no-underline">
            {{ __('shop::app.customers.account.orders.view.contact') }}: {{ $address->phone }}
        </span>
    </p>
</div>
