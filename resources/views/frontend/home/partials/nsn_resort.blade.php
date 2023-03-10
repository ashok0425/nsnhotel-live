<div class="mt-5">
    <br>
    <div class="  container  p-1 p-md-4 custom-bg-white">
        <div class="d-flex  justify-content-between align-items-center mb-2 mb-2 p-3 p-md-0">
            <h2 class="pl-0 pl-md-3 font-weight-bold text-dark custom-fs-20 custom-fw-600 mb-3">NSN Resort</h2>
            <div><a href=""
                    class="btn custom-border-radius-20 custom-bg-primary custom-text-white custom-fw-800 custom-fs-14 hover-on-white">View
                    All ➡</a></div>
        </div>


        <div id="resort" class="owl-carousel">
            @foreach ($nsn_resort as $place)
                @include('frontend.partials.card1', $place)
            @endforeach
        </div>
    </div>
</div>
