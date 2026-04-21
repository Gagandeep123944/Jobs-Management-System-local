@extends('layout.login.app')

@section('title', 'Welcome | JMS')

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endpush     

@section('page-header-script')
<style>
.container-fluid {
    max-width: 1440px;
}

.Hero_sec {
    background-image: url("{{ asset('images/ai5.jpg') }}");
    width: 100%;
    height: 100vh;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
    background-color: #000e21;
    overflow: hidden;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.header img {
    width: 140px;
}

.formbtn {
    background: linear-gradient(90deg, rgba(2, 250, 172, 1) 0%, rgba(18, 230, 224, 1) 100%);
    color: #292929;
    text-decoration: none;
    display: inline-block;
}

.enrtance {
    width: auto;
}

#typed {
    color: #05FAAA;
}

#typed2 {
    color: #17DCFA;
}

.typed-cursor {
    opacity: 1;
    animation: blink 0.7s infinite;
}

@keyframes blink {
    0% { opacity:1; }
    50% { opacity:0; }
    100% { opacity:1; }
}

.mainp span {
    margin: 0 5px;
}


@media(max-width:425px) {

    .header img {
        width: 120px !important;
    }

    .enrtance {
        padding: .5rem 1rem !important;
        font-size: 0.9rem !important;
    }

    .mainp {
        display: flex;
        flex-direction: column;
        gap: 5px;
        font-size: 20px !important;
    }
}
</style>
@endsection

@section('content')
<div class="body">
    <div class="Hero_sec">
        <div class="container-fluid mt-3 px-4">

            
            <div class="header">
                <img src="{{ asset('images/powerlogo2.png') }}">

                <a class="formbtn border-0 rounded py-2 px-4 fw-medium fs-6 enrtance"
                   href="{{ route('dashboard') }}">
                   Entrance
                </a>
            </div>

           
            <div class="d-flex justify-content-center align-items-center text-center" style="height: 275px;">
                <div class="mainp text-white fs-2">

                    <span>Easiest Way to Manage</span>

                    <span class="type-wrap">
                        <span id="typed"></span>
                    </span>

                    <span>with great</span>

                    <span class="type-wrap">
                        <span id="typed2"></span>
                    </span>

                    <span>Platform</span>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection

@section('page-footer-script')
<script>
$(document).ready(function() {

    new Typed("#typed", {
        strings: ["Jobs"],
        typeSpeed: 100,
        backSpeed: 60,
        backDelay: 2000,
        loop: true
    });

    new Typed("#typed2", {
        strings: ["Core"],
        typeSpeed: 100,
        backSpeed: 60,
        backDelay: 2000,
        loop: true
    });

});
</script>
@endsection