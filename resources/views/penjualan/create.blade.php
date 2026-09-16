@extends('layouts.app')

@section('title', 'Transaksi Baru - K5 Mart')

@section('content')

<div class="mb-8">

    <a href="{{ route('penjualan.index') }}"
       class="inline-flex items-center gap-1.5 text-sm text-slate-500 hover:text-indigo-600 transition mb-4">

        <i data-lucide="arrow-left" class="w-4 h-4"></i>

        Kembali

    </a>

    <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight">
        Transaksi Baru
    </h1>

    <p class="mt-1 text-sm text-slate-500">
        Tambah produk ke keranjang penjualan
    </p>

</div>


<form action="{{ route('penjualan.store') }}"
      method="POST"
      id="form-penjualan">

    @csrf

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


        <!-- ========================= -->
        <!-- PILIH PRODUK -->
        <!-- ========================= -->

        <div class="lg:col-span-2">

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5">

                <h3 class="font-semibold text-slate-800 mb-4">
                    Pilih Produk
                </h3>


                <div id="items-container" class="space-y-3">


                    <!-- ITEM PERTAMA -->
                    <div class="item-row flex flex-col sm:flex-row gap-3 items-start sm:items-end">


                        <!-- PRODUK -->
                        <div class="flex-1 w-full">

                            <label class="block text-xs text-slate-500 mb-1">
                                Produk
                            </label>

                            <select
                                name="produk_id[]"
                                required
                                class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 outline-none text-sm bg-white produk-select">

                                <option value="">
                                    -- Pilih Produk --
                                </option>

                                @foreach($produks as $p)

                                    <option
                                        value="{{ $p->id }}"
                                        data-harga="{{ $p->harga_jual }}"
                                        data-stok="{{ $p->stok }}">

                                        {{ $p->nama }}
                                        (Stok: {{ $p->stok }})
                                        -
                                        Rp {{ number_format($p->harga_jual, 0, ',', '.') }}

                                    </option>

                                @endforeach

                            </select>

                        </div>


                        <!-- QTY -->
                        <div class="w-28">

                            <label class="block text-xs text-slate-500 mb-1">
                                Qty
                            </label>

                            <input
                                type="number"
                                name="qty[]"
                                value="1"
                                min="1"
                                required
                                class="w-full px-3 py-2.5 rounded-xl border border-slate-200 focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 outline-none text-sm qty-input">

                        </div>


                        <!-- HAPUS -->
                        <button
                            type="button"
                            class="remove-row p-2.5 text-slate-400 hover:text-rose-500 hover:bg-rose-50 rounded-lg transition hidden">

                            <i data-lucide="trash-2" class="w-4 h-4"></i>

                        </button>

                    </div>

                </div>


                <!-- TAMBAH ITEM -->
                <button
                    type="button"
                    id="add-item"
                    class="mt-4 inline-flex items-center gap-1.5 text-sm text-indigo-600 hover:text-indigo-700 font-medium">

                    <i data-lucide="plus" class="w-4 h-4"></i>

                    Tambah Item

                </button>

            </div>

        </div>



        <!-- ========================= -->
        <!-- RINGKASAN -->
        <!-- ========================= -->

        <div>

            <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-5 sticky top-24">

                <h3 class="font-semibold text-slate-800 mb-4">
                    Ringkasan
                </h3>


                <div class="space-y-2 text-sm">


                    <!-- TOTAL ITEM -->
                    <div class="flex justify-between text-slate-600">

                        <span>
                            Total Item
                        </span>

                        <span id="total-item">
                            0
                        </span>

                    </div>


                    <!-- TOTAL BAYAR -->
                    <div class="border-t border-slate-100 pt-3 flex justify-between">

                        <span class="font-semibold text-slate-800">
                            Total Bayar
                        </span>

                        <span
                            class="font-bold text-indigo-600 text-lg"
                            id="total-bayar">

                            Rp 0

                        </span>

                    </div>


                    <!-- METODE PEMBAYARAN -->
                    <div class="border-t border-slate-100 pt-4 mt-4">

                        <label class="block text-sm font-semibold text-slate-800 mb-3">
                            Metode Pembayaran
                        </label>


                        <!-- CASH -->
                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 cursor-pointer hover:border-indigo-300 hover:bg-indigo-50 transition mb-2">

                            <input
                                type="radio"
                                name="metode_pembayaran"
                                value="cash"
                                checked
                                required
                                class="w-4 h-4 text-indigo-600">

                            <i
                                data-lucide="banknote"
                                class="w-4 h-4 text-emerald-500">
                            </i>

                            <span class="text-sm text-slate-700">
                                Cash
                            </span>

                        </label>


                        <!-- TRANSFER -->
                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 cursor-pointer hover:border-indigo-300 hover:bg-indigo-50 transition mb-2">

                            <input
                                type="radio"
                                name="metode_pembayaran"
                                value="transfer"
                                required
                                class="w-4 h-4 text-indigo-600">

                            <i
                                data-lucide="landmark"
                                class="w-4 h-4 text-blue-500">
                            </i>

                            <span class="text-sm text-slate-700">
                                Transfer
                            </span>

                        </label>


                        <!-- QRIS -->
                        <label
                            class="flex items-center gap-3 p-3 rounded-xl border border-slate-200 cursor-pointer hover:border-indigo-300 hover:bg-indigo-50 transition">

                            <input
                                type="radio"
                                name="metode_pembayaran"
                                value="qris"
                                required
                                class="w-4 h-4 text-indigo-600">

                            <i
                                data-lucide="qr-code"
                                class="w-4 h-4 text-purple-500">
                            </i>

                            <span class="text-sm text-slate-700">
                                QRIS
                            </span>

                        </label>

                        <div id="cash-payment" class="mt-4 space-y-3">
                            <div>
                                <label for="uang-dibayar" class="block text-sm font-semibold text-slate-800 mb-2">
                                    Uang Dibayar
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-sm text-slate-500">Rp</span>
                                    <input
                                        id="uang-dibayar"
                                        type="number"
                                        name="uang_dibayar"
                                        value="{{ old('uang_dibayar') }}"
                                        min="0"
                                        step="1"
                                        class="w-full pl-12 pr-4 py-2.5 rounded-xl border border-slate-200 outline-none focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100"
                                        placeholder="0">
                                </div>
                                @error('uang_dibayar')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="flex items-center justify-between rounded-xl bg-emerald-50 px-4 py-3">
                                <span class="text-sm font-semibold text-emerald-800">Kembalian</span>
                                <span id="kembalian" class="font-bold text-emerald-700">Rp 0</span>
                            </div>
                        </div>

                    </div>

                </div>


                <!-- SIMPAN -->
                <button
                    type="submit"
                    class="mt-5 w-full px-5 py-3 bg-indigo-600 hover:bg-indigo-700 text-white text-sm font-medium rounded-xl transition shadow-sm shadow-indigo-200 flex items-center justify-center gap-2">

                    <i data-lucide="circle-check" class="w-4 h-4"></i>

                    Simpan Transaksi

                </button>

            </div>

        </div>

    </div>

</form>

@endsection


@push('scripts')

<script>

    lucide.createIcons();


    const container = document.getElementById('items-container');

    const addBtn = document.getElementById('add-item');


    /*
    |--------------------------------------------------------------------------
    | UPDATE TOTAL
    |--------------------------------------------------------------------------
    */

    let currentTotal = 0;

    function updateChange() {
        const paid = parseFloat(document.getElementById('uang-dibayar').value) || 0;
        const change = Math.max(0, paid - currentTotal);
        document.getElementById('kembalian').textContent =
            'Rp ' + change.toLocaleString('id-ID');
    }

    function updatePaymentMethod() {
        const method = document.querySelector('input[name="metode_pembayaran"]:checked').value;
        const cashPayment = document.getElementById('cash-payment');
        const paidInput = document.getElementById('uang-dibayar');
        const isCash = method === 'cash';

        cashPayment.classList.toggle('hidden', !isCash);
        paidInput.required = isCash;
        if (!isCash) paidInput.value = '';
        updateChange();
    }

    function updateTotal() {

        let total = 0;

        let itemCount = 0;


        document.querySelectorAll('.item-row').forEach(row => {

            const select = row.querySelector('.produk-select');

            const qtyInput = row.querySelector('.qty-input');

            const qty = parseInt(qtyInput.value) || 0;


            if (!select) {
                return;
            }


            const selectedOption =
                select.options[select.selectedIndex];


            if (
                selectedOption &&
                selectedOption.dataset.harga
            ) {

                const harga =
                    parseFloat(selectedOption.dataset.harga) || 0;


                total += harga * qty;

                itemCount += qty;

            }

        });


        currentTotal = total;

        document.getElementById('total-bayar').textContent =
            'Rp ' + total.toLocaleString('id-ID');


        document.getElementById('total-item').textContent =
            itemCount;

        updateChange();

    }


    /*
    |--------------------------------------------------------------------------
    | CHANGE PRODUK
    |--------------------------------------------------------------------------
    */

    container.addEventListener('change', function(e) {

        if (
            e.target.classList.contains('produk-select')
        ) {

            updateTotal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | INPUT QTY
    |--------------------------------------------------------------------------
    */

    container.addEventListener('input', function(e) {

        if (
            e.target.classList.contains('qty-input')
        ) {

            updateTotal();

        }

    });

    document.getElementById('uang-dibayar').addEventListener('input', updateChange);

    document.querySelectorAll('input[name="metode_pembayaran"]').forEach(input => {
        input.addEventListener('change', updatePaymentMethod);
    });


    /*
    |--------------------------------------------------------------------------
    | TAMBAH ITEM
    |--------------------------------------------------------------------------
    */

    addBtn.addEventListener('click', function() {

        const firstRow =
            container.querySelector('.item-row');


        const clone =
            firstRow.cloneNode(true);


        clone.querySelector('.produk-select').value = '';

        clone.querySelector('.qty-input').value = 1;


        clone.querySelector('.remove-row')
            .classList.remove('hidden');


        container.appendChild(clone);


        lucide.createIcons();

        updateTotal();

    });


    /*
    |--------------------------------------------------------------------------
    | HAPUS ITEM
    |--------------------------------------------------------------------------
    */

    container.addEventListener('click', function(e) {

        const button =
            e.target.closest('.remove-row');


        if (!button) {
            return;
        }


        const rows =
            container.querySelectorAll('.item-row');


        if (rows.length > 1) {

            button.closest('.item-row').remove();

            updateTotal();

        }

    });


    /*
    |--------------------------------------------------------------------------
    | CEK STOK
    |--------------------------------------------------------------------------
    */

    container.addEventListener('change', function(e) {

        if (
            !e.target.classList.contains('produk-select')
        ) {
            return;
        }


        const row =
            e.target.closest('.item-row');


        const qtyInput =
            row.querySelector('.qty-input');


        const option =
            e.target.options[e.target.selectedIndex];


        if (
            option &&
            option.dataset.stok
        ) {

            const stok =
                parseInt(option.dataset.stok);


            qtyInput.max = stok;


            if (
                parseInt(qtyInput.value) > stok
            ) {

                qtyInput.value = stok;

            }

        }


        updateTotal();

    });


    /*
    |--------------------------------------------------------------------------
    | CEGAH SUBMIT TANPA PRODUK
    |--------------------------------------------------------------------------
    */

    document.getElementById('form-penjualan')
        .addEventListener('submit', function(e) {

            let valid = true;


            document.querySelectorAll('.produk-select')
                .forEach(select => {

                    if (!select.value) {

                        valid = false;

                    }

                });


            if (!valid) {

                e.preventDefault();

                alert('Silakan pilih produk terlebih dahulu.');

                return;

            }

            const method = document.querySelector('input[name="metode_pembayaran"]:checked').value;
            const paid = parseFloat(document.getElementById('uang-dibayar').value) || 0;

            if (method === 'cash' && paid < currentTotal) {
                e.preventDefault();
                alert('Uang dibayar kurang dari total pembayaran.');
                return;
            }


            updateTotal();

        });


    // Jalankan pertama kali
    updateTotal();
    updatePaymentMethod();

</script>

@endpush
