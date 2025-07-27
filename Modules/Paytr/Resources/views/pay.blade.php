@extends('gateway::layouts.payment')

@section('logo', asset(moduleConfig('paytr.logo')))

@section('gateway', moduleConfig('paytr.name'))

@section('content')

    <p class="para-6">{{ __('Fill in the required information') }}</p>
    <div class="straight-line"></div>
    @include('gateway::partial.instruction')
    <form class="pay-form needs-validation"
        action="{{ route('gateway.complete', withOldQueryIntegrity(['gateway' => moduleConfig('paytr.alias')])) }}" method="post"
        id="payment-form">
        @csrf
        <div>
            <div id="card-element">
                <!-- a paytm Element will be inserted here. -->
                <div class="email-field">
                    <label class="para-4">{{ __('Enter Full Name') }} *</label>
                    <div class="credit-card ">
                        <div class="input-svg">

                            <svg class="icon" width="16" height="18" viewBox="0 0 16 18" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M14.7032 15.6572C15.2005 15.5536 15.4967 15.0332 15.2496 14.5894C14.7048 13.611 13.8466 12.7512 12.7488 12.096C11.3348 11.2521 9.60243 10.7947 7.8202 10.7947C6.03798 10.7947 4.30556 11.2521 2.89163 12.096C1.79377 12.7512 0.935566 13.611 0.390807 14.5894C0.143699 15.0332 0.439867 15.5536 0.93716 15.6572C5.47708 16.6034 10.1633 16.6034 14.7032 15.6572Z"
                                    fill="#898989" />
                                <circle cx="7.82008" cy="4.49782" r="4.49782" fill="#898989" />
                            </svg>

                            <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                viewBox="0 0 1 28" fill="none">
                                <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                            </svg>
                        </div>
                        <input required type="text" name="name" class="form-control card-input-field"
                            aria-label="Full Name" />
                    </div>
                </div>
                <div class="email-field">
                    <label class="para-4">{{ __('Enter Email Address') }} *</label>
                    <div class="credit-card ">
                        <div class="input-svg">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="18" height="14"
                                viewBox="0 0 18 14" fill="none">
                                <path fill-rule="evenodd" clip-rule="evenodd"
                                    d="M0.87868 0.87868C0 1.75736 0 3.17157 0 6V8C0 10.8284 0 12.2426 0.87868 13.1213C1.75736 14 3.17157 14 6 14H12C14.8284 14 16.2426 14 17.1213 13.1213C18 12.2426 18 10.8284 18 8V6C18 3.17157 18 1.75736 17.1213 0.87868C16.2426 0 14.8284 0 12 0H6C3.17157 0 1.75736 0 0.87868 0.87868ZM3.5547 3.16795C3.09517 2.8616 2.4743 2.98577 2.16795 3.4453C1.8616 3.90483 1.98577 4.5257 2.4453 4.83205L7.8906 8.46225C8.5624 8.91012 9.4376 8.91012 10.1094 8.46225L15.5547 4.83205C16.0142 4.5257 16.1384 3.90483 15.8321 3.4453C15.5257 2.98577 14.9048 2.8616 14.4453 3.16795L9 6.79815L3.5547 3.16795Z"
                                    fill="#898989" />
                            </svg>
                            <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                viewBox="0 0 1 28" fill="none">
                                <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                            </svg>
                        </div>
                        <input required type="email" name="email" class="form-control card-input-field"
                            aria-label="Email" aria-describedby="email" />
                    </div>
                </div>
                <div class="email-field">
                    <label class="para-4">{{ __('Enter Phone Number') }} *</label>
                    <div class="credit-card ">
                        <div class="input-svg">
                            <svg height="14" class="icon" viewBox="0 0 512 512" width="18" xmlns="http://www.w3.org/2000/svg" >
                                <g id="STATIONERY_AND_OFFICE" data-name="STATIONERY AND OFFICE">
                                    <path
                                        d="m501.15 396.46c-6.94-7.75-28.28-27.07-43.56-38.58-15-11.79-39.57-27.74-49.14-32.68-15.63-8.13-39.18-7.22-53.81 2.61a214.44 214.44 0 0 0 -33.23 28.58l-.22.23a33.75 33.75 0 0 1 -43.43 4.75 478.67 478.67 0 0 1 -69.46-57.67 478.67 478.67 0 0 1 -57.67-69.46 33.75 33.75 0 0 1 4.75-43.43l.23-.22a214.44 214.44 0 0 0 28.58-33.23c9.83-14.63 10.74-38.18 2.61-53.81-4.94-9.56-20.89-34.1-32.68-49.14-11.52-15.28-30.83-36.62-38.58-43.56-12.65-11.4-34.02-14.37-48.93-6.25a203.24 203.24 0 0 0 -35 25.13l-1.13 1c-65.92 56.71-22.52 215 106.73 344 129.07 129.27 287.32 172.7 344.03 106.78l1-1.13a202.68 202.68 0 0 0 25.13-35c8.15-14.9 5.18-36.27-6.22-48.92z" fill="#898989"/>
                                </g>
                            </svg>
                            <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                viewBox="0 0 1 28" fill="none">
                                <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                            </svg>
                        </div>
                        <input required type="text" name="phone" class="form-control card-input-field"
                            aria-label="Email" aria-describedby="email" />
                    </div>
                </div>
                <div class="email-field">
                    <label class="para-4">{{ __('Enter Address') }} *</label>
                    <div class="credit-card ">
                        <div class="input-svg">
                            <svg class="icon" enable-background="new 0 0 512 512" height="14" viewBox="0 0 512 512"
                                width="18" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <path
                                        d="m407.579 87.677c-31.073-53.624-86.265-86.385-147.64-87.637-2.62-.054-5.257-.054-7.878 0-61.374 1.252-116.566 34.013-147.64 87.637-31.762 54.812-32.631 120.652-2.325 176.123l126.963 232.387c.057.103.114.206.173.308 5.586 9.709 15.593 15.505 26.77 15.505 11.176 0 21.183-5.797 26.768-15.505.059-.102.116-.205.173-.308l126.963-232.387c30.304-55.471 29.435-121.311-2.327-176.123zm-151.579 144.323c-39.701 0-72-32.299-72-72s32.299-72 72-72 72 32.299 72 72-32.298 72-72 72z" fill="#898989"/>
                                </g>
                            </svg>
                            <svg class="divider" xmlns="http://www.w3.org/2000/svg" width="3" height="28"
                                viewBox="0 0 1 28" fill="none">
                                <line x1="0.5" y1="2.18557e-08" x2="0.499999" y2="28" stroke="#DFDFDF" />
                            </svg>
                        </div>
                        <input required type="text" name="address" class="form-control card-input-field"
                            aria-label="Email" aria-describedby="email" />
                    </div>
                </div>
            </div>
            <!-- Used to display form errors -->
            <div id="card-errors"></div>
        </div>
        <button type="submit" class="pay-button sub-btn">{{ __('Pay With Paytr') }}</button>
    </form>
@endsection

@section('css')

@endsection

@section('js')

@endsection
