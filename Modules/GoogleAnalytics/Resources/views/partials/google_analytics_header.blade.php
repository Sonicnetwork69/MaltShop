@php
    $measurement_id = moduleConfig('googleanalytics.measurement_id');
@endphp

<!-- Check if the measurement_id exists before including the Google Analytics code -->
@isset($measurement_id)
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $measurement_id }}"></script>
    <script>
        var m_id = '{!! $measurement_id !!}';
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());
        gtag('config', m_id);
    </script>
@endisset
