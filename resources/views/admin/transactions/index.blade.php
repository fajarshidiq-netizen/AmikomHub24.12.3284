@extends('layouts.admin')

@section('title', 'Daftar Transaksi')

@section('content')
        <div class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-black">Kelola Transaksi</h1>
                <p class="text-slate-500 font-medium">Tinjau log pembelian tiket oleh pelanggan.</p>
            </div>
        </div>

        @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 text-emerald-700 rounded-2xl font-medium">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-[2.5rem] border border-slate-100 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-50 text-slate-400 uppercase text-[10px] font-black tracking-widest">
                        <tr>
                            <th class="px-8 py-4 w-16">No</th>
                            <th class="px-8 py-4">Order ID</th>
                            <th class="px-8 py-4">Pelanggan</th>
                            <th class="px-8 py-4">Event</th>
                            <th class="px-8 py-4">Total Bayar</th>
                            <th class="px-8 py-4">Status</th>
                            <th class="px-8 py-4">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y border-t">
                        @forelse($transactions as $index => $transaction)
                            @php
                                $statusBadgeClass = 'bg-amber-100 text-amber-700';
                                if (strtolower($transaction->status) === 'success') {
                                    $statusBadgeClass = 'bg-emerald-100 text-emerald-700';
                                } elseif (strtolower($transaction->status) === 'failed' || strtolower($transaction->status) === 'expire') {
                                    $statusBadgeClass = 'bg-rose-100 text-rose-700';
                                }
                            @endphp
                            <tr class="hover:bg-slate-50/50 transition">
                                <td class="px-8 py-6 font-bold text-slate-400">
                                    {{ $transactions->firstItem() + $index }}
                                </td>
                                <td class="px-8 py-6 font-black text-slate-800">
                                    {{ $transaction->order_id }}
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-bold text-slate-800">{{ $transaction->customer_name }}</p>
                                    <p class="text-xs text-slate-400">{{ $transaction->customer_email }}</p>
                                    <p class="text-xs text-slate-500 mt-0.5">{{ $transaction->customer_phone }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-black text-slate-800">{{ $transaction->event->title ?? '-' }}</p>
                                    <p class="text-xs text-slate-400">{{ $transaction->event->category->name ?? '' }}</p>
                                </td>
                                <td class="px-8 py-6">
                                    <p class="font-bold text-indigo-600">Rp {{ number_format($transaction->total_price, 0, ',', '.') }}</p>
                                    <p class="text-[10px] text-slate-400 uppercase font-bold">Termasuk Admin Fee</p>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="px-3 py-1 text-xs font-bold uppercase tracking-wider rounded-full {{ $statusBadgeClass }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-sm text-slate-500 font-medium">
                                    {{ \Carbon\Carbon::parse($transaction->created_at)->translatedFormat('d M Y, H:i') }} WIB
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-8 py-6 text-center text-slate-500">Belum ada transaksi terekam.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if($transactions->hasPages())
                <div class="px-8 py-4 border-t">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
@endsection
