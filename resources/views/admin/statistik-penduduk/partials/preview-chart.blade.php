{{-- PREVIEW GRAFIK SMART VILLAGE --}}
<div class="section-box">
  <div class="section-title">Preview Grafik (Smart Village)</div>
  <div class="section-desc">
    Grafik ini akan tampil di halaman publik.
    Perubahan data akan langsung memengaruhi grafik.
  </div>

  <div style="display:grid;grid-template-columns:1fr 1fr;gap:24px">
    <div>
      <canvas id="chartUsia"></canvas>
    </div>
    <div>
      <canvas id="chartPekerjaan"></canvas>
    </div>
    <div>
      <canvas id="chartPendidikan"></canvas>
    </div>
    <div>
      <canvas id="chartAgama"></canvas>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
function num(name){
  return parseInt(document.querySelector(`[name="${name}"]`)?.value || 0)
}

/* =======================
   USIA
======================= */
new Chart(document.getElementById('chartUsia'), {
  type:'pie',
  data:{
    labels:['0–14','15–64','≥65'],
    datasets:[{
      data:[
        num('usia[0_14]'),
        num('usia[15_64]'),
        num('usia[65_plus]')
      ],
      backgroundColor:['#38bdf8','#22c55e','#facc15']
    }]
  }
});

/* =======================
   PEKERJAAN
======================= */
new Chart(document.getElementById('chartPekerjaan'), {
  type:'bar',
  data:{
    labels:['Petani','Buruh','UMKM','PNS','Lainnya'],
    datasets:[{
      data:[
        num('pekerjaan[petani]'),
        num('pekerjaan[buruh]'),
        num('pekerjaan[umkm]'),
        num('pekerjaan[pns]'),
        num('pekerjaan[lainnya]')
      ],
      backgroundColor:'#2563eb'
    }]
  }
});

/* =======================
   PENDIDIKAN
======================= */
new Chart(document.getElementById('chartPendidikan'), {
  type:'doughnut',
  data:{
    labels:['Tidak Sekolah','SD','SMP','SMA','PT'],
    datasets:[{
      data:[
        num('pendidikan[tidak_sekolah]'),
        num('pendidikan[sd]'),
        num('pendidikan[smp]'),
        num('pendidikan[sma]'),
        num('pendidikan[pt]')
      ],
      backgroundColor:['#ef4444','#f97316','#eab308','#22c55e','#3b82f6']
    }]
  }
});

/* =======================
   AGAMA
======================= */
new Chart(document.getElementById('chartAgama'), {
  type:'pie',
  data:{
    labels:['Islam','Kristen','Katolik','Hindu','Buddha'],
    datasets:[{
      data:[
        num('agama[islam]'),
        num('agama[kristen]'),
        num('agama[katolik]'),
        num('agama[hindu]'),
        num('agama[buddha]')
      ],
      backgroundColor:['#16a34a','#3b82f6','#6366f1','#f97316','#a855f7']
    }]
  }
});
</script>
