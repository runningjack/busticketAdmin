@extends("layouts.dashboard")
@section("content")
<div class="visible-print text-center">
    {!! QrCode::size(100)->generate(Request::url()); !!}
    <?php echo \SimpleSoftwareIO\QrCode\Facades\QrCode::size(100)->generate("Amedora33") ?>
    <p>Scan me to return to the original page.</p>
</div>
@stop