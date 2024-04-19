@configIsSet('cornerstone.google_analytics.tracking_id')
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id={{config('cornerstone.google_analytics.tracking_id')}}"></script>
<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', '{{config('cornerstone.google_analytics.tracking_id')}}');
</script>
@endconfigIsSet