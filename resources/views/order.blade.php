<x-app-layout>
    <div class="container">
        <div class="row g-5 d-flex justify-content-center">
            <div class="col-md-7 col-lg-8">
            <h1 class="my-3">Order</h1>
                <div class="row g-3">
                    <div class="col-12">
                        <form action="{{ route('order.ongkir') }}" method="POST">
                        @csrf
                            <label for="address" class="form-label">Alamat</label>
                            <div class="input-group">
                                @isset($olddes)
                                <input type="text" class="form-control" id="address" name="address" value="{{ $olddes }}">
                                @else
                                <input type="text" class="form-control" id="address" name="address">
                                @endisset
                                <input type="hidden" class="form-control" id="from" name="from" value="Buhen Cakery">
                                <button class="btn btn-outline-secondary" type="submit" onclick="undisable()">Cek ongkir</button>
                            </div>
                        </form>
                    </div>
                    <form action="{{ route('order.store') }}" method="POST">
                        @csrf
                        <div class="d-flex">
                            <div class="col-3 me-2">
                                <label for="rtrw" class="form-label">RT/RW</label>
                                <input type="text" class="form-control" id="rtrw" name="rtrw" value="{{ old('rtrw') }}">
                            </div>
                            <div class="col-4">
                                <label for="blokno" class="form-label">Blok/No.</label>
                                <input type="text" class="form-control" id="blokno" name="blokno" value="{{ old('blokno') }}">
                            </div>
                        </div>
                        
                        @isset($olddes)
                            <input type="hidden" value="{{ $olddes }}" name="address2">
                        @endisset
                        {{-- <div class="col-12 mb-2">
                            <label for="name" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="name" name="name">
                        </div>
            
                        <div class="col-12 mb-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email">
                        </div> --}}

                        <div class="col-12 mb-2">
                            <label for="notelp" class="form-label">No. Telp/HP</label>
                            <input type="text" class="form-control" id="notelp" name="notelp" value="{{ old('notelp') }}">
                        </div>
                        <div class="col-12 mb-2">
                            <label for="name" class="form-label">Untuk tanggal dan jam</label>
                            <div class="input-group">
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                                <input type="time" name="time" class="form-control" value="{{ old('time') }}">
                            </div>
                        </div>
                        <div class="mb-2">
                            <div class="form-check mb-2">
                                {{-- <input id="credit" name="courierMethod" type="radio" class="form-check-input" checked> --}}
                                @isset($ongkir)
                                <input id="courierMethod" name="courierMethod" type="radio" class="form-check-input" value="{{ $ongkir }}">
                                <label class="form-check-label" for="courierMethod">Kurir Buhen* <span class="text-muted">(@currency($ongkir))</span><br>
                                @else
                                <label class="form-check-label" for="courierMethod">Kurir Buhen*<br>
                                @endisset
                                <small class="text-muted">*Rp1.000/km</small></label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="courierMethod" type="radio" class="form-check-input" value="0" checked>
                                <label class="form-check-label" for="debit">Ambil sendiri</label>
                            </div>
                        </div>
                        <button class="w-100 btn btn-primary btn-lg" type="submit">Lanjut ke pembayaran</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places"></script>
    <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('address'));
            google.maps.event.addListener(places, 'place_changed', function () {

            });
        });

        function undisable() {
            document.getElementById("courierMethod").disabled = false;
        }
    </script>
</x-app-layout>