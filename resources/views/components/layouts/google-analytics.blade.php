@php
    $generalSetting = app(\App\Settings\GeneralSetting::class);
@endphp

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{ $generalSetting->googleAnalyticsKey }}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag() {
        dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', '{{ $generalSetting->googleAnalyticsKey }}');
</script>
