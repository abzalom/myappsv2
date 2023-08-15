<x-app-layout :apps="$apps">

    @if ($errors->any())
        <div class="row">
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <span class="card-title">Card Title</span>
                </div>
                <div class="card-body">
                    <h1>Aplikasi E-Planning untuk digunakan sendiri sebagai alat bantu</h1>
                </div>
            </div>
        </div>
    </div>

    @include('sccript')
</x-app-layout>
