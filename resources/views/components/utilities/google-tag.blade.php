@props(['trackingId' => config('cornerstone.google_analytics.tracking_id')])
@isset($trackingId)
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{$trackingId}}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{$trackingId}}');
</script>
@endisset