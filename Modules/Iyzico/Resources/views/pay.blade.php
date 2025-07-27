@extends('gateway::layouts.payment')
@section('logo', asset(moduleConfig('iyzico.logo')))
@section('gateway', moduleConfig('iyzico.name'))
@section('content')
    <p class="para-6">{{ __('Fill in the required information') }}</p>
    <div class="straight-line"></div>
    @include('gateway::partial.instruction')
    <form class="pay-form needs-validation"
        action="{{ route('gateway.complete', withOldQueryIntegrity(['gateway' => moduleConfig('iyzico.alias')])) }}"
        method="post" id="payment-form">
        @csrf
        <div>
            <div id="card-element">
                <div class="email-field">
                    <label class="para-4">{{ __('Card Number') }}*</label>
                    <div class="credit-card ">
                        <div class="input-svg">
                            <img src="{{ asset('Modules/Iyzico/Resources/assets/card.png') }}" class="mbIcon">
                            <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                viewBox="0 0 1 28" fill="none">
                                <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                            </svg>
                        </div>
                        <input required type="text" name="card_number" class="form-control card-input-field"
                            id="kartNum" placeholder="5528790000000008" />
                    </div>
                </div>
                <div class="email-field">
                    <label class="para-4">{{ __('Card owner') }}*</label>
                    <div class="credit-card ">
                        <div class="input-svg">
                            <img src="{{ asset('Modules/Iyzico/Resources/assets/card_holder.png') }}" class="mbIcon">
                            <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                viewBox="0 0 1 28"fill="none">
                                <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                            </svg>
                        </div>
                        <input required type="text" name="card_owner" class="form-control card-input-field"
                            aria-label="Email" aria-describedby="text" placeholder="Test Kart" />
                    </div>
                </div>
                <div class="row">
                    <div class="email-field col-md-4">
                        <label class="para-4">{{ __('Expiration Month') }}*</label>
                        <div class="credit-card ">
                            <div class="input-svg">
                                <img src="{{ asset('Modules/Iyzico/Resources/assets/date.png') }}" class="mbIcon">
                                <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                    viewBox="0 0 1 28" fill="none">
                                    <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                                </svg>
                            </div>
                            <select class="form-control card-input-field" name="expiration_month">
                                @foreach (range(1, 12) as $month)
                                    <option value="{{ $month }}"
                                        {{ old('expiration_month') == $month ? 'selected' : '' }}>
                                        {{ DateTime::createFromFormat('!m', $month)->format('F') }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="email-field col-md-4">
                        <label class="para-4">{{ __('Expiration Year') }}*</label>
                        <div class="credit-card ">
                            <div class="input-svg">
                                <img src="{{ asset('Modules/Iyzico/Resources/assets/date.png') }}" class="mbIcon">
                                <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                    viewBox="0 0 1 28" fill="none">
                                    <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                                </svg>
                            </div>
                            <select class="form-control card-input-field" name="expiration_year">
                                @for ($year = date('Y'); $year <= date('Y') + 10; $year++)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="email-field col-md-4">
                        <label class="para-4">{{ __('CVV') }}*</label>
                        <div class="credit-card ">
                            <div class="input-svg">
                                <img src="{{ asset('Modules/Iyzico/Resources/assets/card-behind.png') }}"
                                    class="mbIcon">
                                <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                    viewBox="0 0 1 28" fill="none">
                                    <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28"
                                        stroke="#DFDFDF" />
                                </svg>
                            </div>
                            <input required type="text" name="cvv" class="form-control card-input-field"
                                aria-label="Email" aria-describedby="email" placeholder="222" />
                        </div>
                    </div>
                </div>
            </div>
            <!-- Used to display form errors -->
            <div id="card-errors"></div>
        </div>
        <button type="submit" class="pay-button sub-btn">{{ __('Pay with Iyzico') }}</button>
    </form>
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('Modules/Iyzico/Resources/assets/css/style.min.css') }}">
@endsection
@section('js')
@endsection
