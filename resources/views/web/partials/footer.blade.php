<footer class="bg-slate-950 text-slate-200">
    <div class="max-w-7xl mx-auto px-4 py-14">
        <div class="grid md:grid-cols-4 gap-10">
            <div>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-600 text-white flex items-center justify-center font-bold">DS</div>
                    <div class="font-semibold">Desa Surianmedal</div>
                </div>
                <p class="mt-4 text-sm text-slate-300 leading-relaxed">
                    Portal informasi resmi Desa Surianmedal, Kecamatan Sumedang, Kabupaten Sumedang, Jawa Barat.
                </p>
            </div>

            <div>
                <div class="font-semibold mb-3">Kontak</div>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li>📍 Jl. Raya Desa Surianmedal, Kec. Sumedang, Kab. Sumedang</li>
                    <li>☎️ —</li>
                    <li>✉️ —</li>
                </ul>
            </div>

            <div>
                <div class="font-semibold mb-3">Jam Layanan</div>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li>🕒 Senin – Kamis: 08.00 – 15.00 WIB</li>
                    <li>🕒 Jumat: 08.00 – 11.30 WIB</li>
                </ul>
            </div>

            <div>
                <div class="font-semibold mb-3">Tautan Cepat</div>
                <ul class="text-sm text-slate-300 space-y-2">
                    <li><a class="hover:text-white" href="{{ route('home') }}">Beranda</a></li>
                    <li><a class="hover:text-white" href="{{ route('profil') }}">Profil Desa</a></li>
                    <li><a class="hover:text-white" href="{{ route('data-penduduk') }}">Data Penduduk</a></li>
                    <li><a class="hover:text-white" href="{{ route('umkm') }}">UMKM</a></li>
                    <li><a class="hover:text-white" href="{{ route('wisata') }}">Wisata</a></li>
                    <li><a class="hover:text-white" href="{{ route('pemerintahan') }}">Pemerintahan</a></li>
                    <li><a class="hover:text-white" href="{{ route('kontak') }}">Kontak</a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 mt-12 pt-6 text-center text-sm text-slate-400">
            © {{ date('Y') }} Pemerintah Desa Surianmedal. Seluruh hak cipta dilindungi.
        </div>
    </div>
</footer>
