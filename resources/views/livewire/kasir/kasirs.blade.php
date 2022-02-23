<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Data Kasir
    </h2>
</x-slot>
@if (session()->has('message'))
<div class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert">
    <div class="flex">
        <div>
            <p class="text-sm">{{ session('message') }}</p>
        </div>
    </div>
</div>
@endif
<div class="w-full sm:px-6">
    <div class="px-4 md:px-10 py-4 md:py-7 bg-gray-100 rounded-tl-lg rounded-tr-lg">
        <div class="sm:flex items-center justify-between">
            <input type="text"
                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg py-2 px-4 rounder my-4"
                placeholder="Search" wire:model="search">
        </div>
    </div>
    <div class="bg-white shadow px-4 md:px-10 pt-4 md:pt-7 pb-5 overflow-y-auto">
        <table class="w-full whitespace-nowrap">
            <thead>
                <tr tabindex="0" class="focus:outline-none h-16 w-full text-sm leading-none text-gray-800">
                    <th class="pl-4 text-gray-600 font-normal pr-6 text-left text-sm tracking-normal leading-4"></th>
                    <th class="pl-8 text-gray-600 font-normal pr-6 text-left text-sm tracking-normal leading-4">ID Resep
                    </th>
                    <th class="font-normal text-left pl-12">Tanggal Resep</th>
                    <th class="font-normal text-left pl-12">Nama Pasien</th>
                    <th class="font-normal text-left pl-20">Nama Dokter</th>
                    <th class="font-normal text-left pl-20">Diagnosis</th>
                    <th class="font-normal text-left pl-16">Obat</th>
                    <th class="font-normal text-left pl-16">Dosis</th>
                </tr>
            </thead>
            <tbody class="w-full">
                @foreach ($reseps as $row)
                <tr tabindex="0"
                    class="focus:outline-none h-20 text-sm leading-none text-gray-800 bg-white hover:bg-gray-100 border-b border-t border-gray-100">
                    <td><input type="checkbox" wire:model="pilihan" value="{{ $row->id }}"></td>
                    <td class="pl-4">
                        {{ $row->idresep }}
                    </td>
                    <td class="pl-12">
                        {{ $row->tanggalresep }}
                    </td>
                    <td class="pl-12">
                        {{ $row->rekammedik->pasien->namapasien }}
                    </td>
                    <td class="pl-20">
                        {{ $row->rekammedik->dokter->namadokter }}
                    </td>
                    <td class="pl-20">
                        {{ $row->rekammedik->diagnosadokter }}
                    </td>
                    <td class="pl-20">
                        {{ $row->obat->namaobat }}
                    </td>
                    <td class="pl-16">
                        {{ $row->dosis }}
                    </td>
                    {{-- <td class="pl-4">
                        @if($row->status == 'paid')
                        <a href="">paid</a>
                        @else
                        <a href="{{ route('invoice', ['pilih' => $row->id]) }}">Bayar</a>
                        @endif
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
        <div x-data="{ open: false }">
            <button @click="open = true"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded my-3">bayar</button>
            <div x-show="open" class="bg-gray-700 absolute w-full h-full py-8 top-0" id="modal">
                <div class="flex items-center justify-center px-4 h-full w-full relative">
                    <div class="fixed overflow-y-auto w-11/12 h-screen py-10 max-w-lg">
                        <div class="bg-white rounded-md relative">
                            <button onclick="modalHandler(false)" role="button" aria-label="close modal"
                                class="focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-md focus:ring-gray-500 absolute inset-0 m-auto w-5 h-5 mr-4 mt-4 cursor-pointer">
                                <img src="https://tuk-cdn.s3.amazonaws.com/can-uploader/invoices-svg1.svg" alt="icon" />

                            </button>
                            <div class="bg-gray-100 rounded-tl-md rounded-tr-md md:px-10 px-5 pt-9 pb-2.5">
                                <div class="sm:flex justify-between">
                                    <div>
                                        <svg tabindex="0" aria-label="logo" role="img" class="focus:outline-none"
                                            width="65" height="43" viewBox="0 0 65 43" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M39.2096 5.81325C35.6428 8.21248 31.4751 8.68642 16.4229 4.27679C6.74157 1.44026 0.0118366 8.76797 3.01063e-05 18.4299C-0.00587317 23.226 0.856005 27.8673 2.9009 31.8763C5.34367 36.6605 15.4949 46.456 17.0133 38.0788C23.2707 3.56766 24.5694 28.7419 31.1811 28.2691C35.6581 27.9488 36.6121 -1.98722 47.1199 39.4971C49.9783 50.7829 64.936 30.8835 64.936 18.4299C64.936 13.8241 64.1544 9.36127 62.2536 5.47286C57.5097 -4.23281 46.4115 0.967502 39.2096 5.81325Z"
                                                fill="url(#paint0_radial)"></path>
                                            <mask id="mask0" mask-type="alpha" maskUnits="userSpaceOnUse" x="0" y="0"
                                                width="65" height="43">
                                                <path
                                                    d="M39.2096 5.81325C35.6428 8.21248 31.4751 8.68642 16.4229 4.27679C6.74157 1.44026 0.0118366 8.76797 3.01063e-05 18.4299C-0.00587317 23.226 0.856005 27.8673 2.9009 31.8763C5.34367 36.6605 15.4949 46.456 17.0133 38.0788C23.2707 3.56766 24.5694 28.7419 31.1811 28.2691C35.6581 27.9488 36.6121 -1.98722 47.1199 39.4971C49.9783 50.7829 64.936 30.8835 64.936 18.4299C64.936 13.8241 64.1544 9.36127 62.2536 5.47286C57.5097 -4.23281 46.4115 0.967502 39.2096 5.81325Z"
                                                    fill="white"></path>
                                            </mask>
                                            <g mask="url(#mask0)">
                                                <path
                                                    d="M7.11465 40.7973C7.11465 40.7973 13.136 20.2324 29.0748 36.6607C42.8814 50.8906 61.3067 31.5786 61.3067 31.5786L60.126 49.4251L31.4361 55.4527H1.44751L7.11465 40.7973Z"
                                                    fill="url(#paint1_linear)"></path>
                                                <path
                                                    d="M20.8105 -3.64205C20.8105 -3.64205 6.87875 -3.64205 9.59425 15.5045C10.8528 24.377 9.20582 34.5129 -5.12614 37.9238C-19.4581 41.3347 -9.96801 -6.23039 -9.96801 -6.23039L26.8318 -27.0435L20.8105 -3.64205Z"
                                                    fill="url(#paint2_radial)"></path>
                                                <path
                                                    d="M32.4906 -6.52198C32.4906 -6.52198 31.0703 15.8914 44.9619 15.4221C58.8535 14.9541 64.9386 20.7643 64.9787 30.821C65.0189 40.8777 83.5776 10.1367 83.5776 10.1367L59.1333 -17.8965L32.4906 -6.52198Z"
                                                    fill="url(#paint3_radial)"></path>
                                            </g>
                                            <circle cx="26.7861" cy="39.6431" r="2.50001" fill="#E05500"></circle>
                                            <circle cx="36.7859" cy="39.6431" r="2.50001" fill="#E05500"></circle>
                                            <defs>
                                                <radialGradient id="paint0_radial" cx="0" cy="0" r="1"
                                                    gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(32.4688 21.4197) rotate(-0.0175754) scale(57.9778 58.0384)">
                                                    <stop stop-color="#FF9900"></stop>
                                                    <stop offset="1" stop-color="#C41700"></stop>
                                                </radialGradient>
                                                <linearGradient id="paint1_linear" x1="-3.76862" y1="40.2451"
                                                    x2="77.4031" y2="46.0197" gradientUnits="userSpaceOnUse">
                                                    <stop stop-color="#FF9900"></stop>
                                                    <stop offset="1" stop-color="#C41700"></stop>
                                                </linearGradient>
                                                <radialGradient id="paint2_radial" cx="0" cy="0" r="1"
                                                    gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(6.89195 5.52766) rotate(-0.0435159) scale(35.6073 88.254)">
                                                    <stop stop-color="#FF9900"></stop>
                                                    <stop offset="1" stop-color="#C41700"></stop>
                                                </radialGradient>
                                                <radialGradient id="paint3_radial" cx="0" cy="0" r="1"
                                                    gradientUnits="userSpaceOnUse"
                                                    gradientTransform="translate(58.0142 7.47283) rotate(-0.026438) scale(45.6493 68.7402)">
                                                    <stop stop-color="#FF9900"></stop>
                                                    <stop offset="1" stop-color="#C41700"></stop>
                                                </radialGradient>
                                            </defs>
                                        </svg>
                                        <p tabindex="0" class="focus:outline-none text-lg font-bold text-gray-600 mt-2">
                                            Good
                                            Company</p>
                                        <div class="mt-2">
                                            <p tabindex="0"
                                                class="focus:outline-none text-xs font-semibold leading-3 text-gray-800 uppercase">
                                                RECIPIENT</p>
                                            <p tabindex="0"
                                                class="focus:outline-none text-xs leading-4 text-gray-600 uppercase mt-1">
                                                JOHN SMITH<br />4304 Liberty Avenue<br />92680 Tustin, CA<br />VAT
                                                no.: 12345678</p>
                                        </div>
                                        <div class="mt-3">
                                            <div class="flex space-x-1 items-center text-xs leading-3">
                                                <p tabindex="0" aria-label="email icon"
                                                    class="focus:outline-none text-blue-500">@</p>
                                                <p tabindex="0" class="focus:outline-none text-gray-600">
                                                    company.mail@gmail.com</p>
                                            </div>
                                            <div class="flex space-x-1 items-center text-xs leading-3 mt-2">
                                                <p tabindex="0" aria-label="mobile number icon"
                                                    class="focus:outline-none text-blue-500">m</p>
                                                <p tabindex="0" class="focus:outline-none text-gray-600">+386 714
                                                    505 8385</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-4 sm:mt-0 sm:flex flex-col sm:items-end sm:text-right">
                                        <div tabindex="0"
                                            class="focus:outline-none py-2.5 px-5 bg-red-100 rounded-full text-xs leading-3 text-red-700 w-24 sm:w-auto">
                                            Pending</div>
                                        <p tabindex="0"
                                            class="focus:outline-none text-xs leading-5 text-light-blue mt-3">
                                            XYZ Company <br /><span class="text-gray-600">1331 Hart Ridge Road
                                                <br />48436 Gaines, MI <br />TAX ID: 987654321</span>
                                        </p>
                                        <div class="mt-3">
                                            <div class="flex space-x-1 items-center text-xs leading-3">
                                                <p tabindex="0" aria-label="email icon"
                                                    class="focus:outline-none text-blue-500">@</p>
                                                <p tabindex="0" class="focus:outline-none text-gray-600">
                                                    company.mail@gmail.com</p>
                                            </div>
                                            <div
                                                class="flex space-x-1 items-center sm:justify-end text-xs leading-3 mt-2">
                                                <p tabindex="0" aria-label="mobile number icon"
                                                    class="focus:outline-none text-blue-500">m</p>
                                                <p tabindex="0" class="focus:outline-none text-gray-600">+386 714
                                                    505 8385</p>
                                            </div>
                                        </div>
                                        <div class="mt-6 text-xs leading-3 sm:text-right">
                                            <p tabindex="0" class="focus:outline-none text-gray-800 uppercase">
                                                invoice no.</p>
                                            <p tabindex="0" class="focus:outline-none text-gray-600 mt-1">
                                                #IDO-2202-2</p>
                                            <div class="mt-3">
                                                <p tabindex="0" class="focus:outline-none text-gray-800 uppercase">
                                                    Invoice date</p>
                                                <p tabindex="0" class="focus:outline-none text-gray-600 mt-1">
                                                    February 2, 2020</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="pt-3.5 pb-9 px-10">
                                <div class="w-full overflow-x-auto">
                                    <table class="w-full">
                                        <thead
                                            class="text-xs leading-none text-gray-600 border-b border-gray-200 text-left">
                                            <tr>
                                                <th tabindex="0" class="focus:outline-none pb-2">Items</th>
                                                <th tabindex="0" class="focus:outline-none pb-2">Quantity</th>
                                                <th tabindex="0" class="focus:outline-none pb-2">Rate</th>
                                                <th tabindex="0" class="focus:outline-none pb-2 text-right">Amount
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="text-xs leading-3 text-gray-800 text-left border-b border-gray-200">
                                                <td tabindex="0" class="focus:outline-none py-4 w-1/2">Natural Herbs
                                                </td>
                                                <td tabindex="0" class="focus:outline-none py-4">14 grams</td>
                                                <td tabindex="0" class="focus:outline-none py-4">$15</td>
                                                <td tabindex="0" class="focus:outline-none py-4 text-right">$28</td>
                                            </tr>
                                            <tr
                                                class="text-xs leading-3 text-gray-800 text-left border-b border-gray-200">
                                                <td tabindex="0" class="focus:outline-none py-4 w-1/2">Active Plus
                                                </td>
                                                <td tabindex="0" class="focus:outline-none py-4">7 grams</td>
                                                <td tabindex="0" class="focus:outline-none py-4">$7.5</td>
                                                <td tabindex="0" class="focus:outline-none py-4 text-right">$14</td>
                                            </tr>
                                            <tr class="text-xs leading-3 text-gray-800 text-left">
                                                <td class="py-4 w-1/2"></td>
                                                <td tabindex="0"
                                                    class="focus:outline-none py-4 border-b border-gray-200">Sub
                                                    total</td>
                                                <td tabindex="0"
                                                    class="focus:outline-none border-b border-gray-200 py-4"></td>
                                                <td tabindex="0"
                                                    class="focus:outline-none border-b border-gray-200 py-4 text-right">
                                                    $14</td>
                                            </tr>
                                            <tr class="text-xs leading-3 text-gray-800 text-left">
                                                <td class="py-4 w-1/2"></td>
                                                <td tabindex="0"
                                                    class="focus:outline-none py-4 border-b border-gray-200">10% Tax
                                                </td>
                                                <td tabindex="0"
                                                    class="focus:outline-none border-b border-gray-200 py-4"></td>
                                                <td tabindex="0"
                                                    class="focus:outline-none border-b border-gray-200 py-4 text-right">
                                                    $2</td>
                                            </tr>
                                            <tr class="text-xs leading-3 text-gray-800 text-left">
                                                <td class="py-4 w-1/2"></td>
                                                <td tabindex="0" class="focus:outline-none py-4 font-bold">TOTAL
                                                </td>
                                                <td class="py-4"></td>
                                                <td tabindex="0"
                                                    class="focus:outline-none text-indigo-400 py-4 text-right">$42
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-9">
                                    <p tabindex="0" class="focus:outline-none text-xs leading-4 text-gray-600">All
                                        amounts are in dollars. Please make the payment within 15 days from the
                                        issue of date of this invoice.</p>
                                    <div class="flex items-center justify-between mt-8">
                                        <button role="button" aria-label="close" onclick="modalHandler(false)"
                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-600 px-6 py-3 bg-gray-600 hover:bg-gray-700 shadow rounded text-sm text-white">Close</button>
                                        <button
                                            class="focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-700 px-6 py-3 bg-indigo-700 hover:bg-indigo-800 shadow rounded text-sm text-white">Send
                                            Invoice</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $reseps->links() }}
        </div>
    </div>
</div>
