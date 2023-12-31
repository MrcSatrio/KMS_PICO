<?= $this->extend('template/index'); ?>

<?php $this->section('container'); ?>
<link href="//vjs.zencdn.net/8.3.0/video-js.min.css" rel="stylesheet">
<script src="//vjs.zencdn.net/8.3.0/video.min.js"></script>
<script src="<?= base_url("videojs-youtube\dist\Youtube.min.js") ?>"></script>

<body>
<?php
if ($document['id_event'] == 0) { ?>
  <div class="container mt-3">
    <div class="jumbotron text-center">
      <h5 class="display-4"><?= $document['judul'] ?></h5>
      <p class="lead"><?= $document['nama_kategori'] ?></p>
    </div>
    <style>
        .video-container {
  position: relative;
  padding-bottom: 56.25%; /* Untuk video 16:9, gunakan 75% untuk 4:3 */
  height: 0;
  overflow: hidden;
}

.video-js {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

        </style>
    <?php if (!empty($document['video'])): ?>
        <div class="video-container">
  <video
    id="my-video"
    class="video-js vjs-default-skin"
    controls
    autoplay
    width="100%"
    height="auto"
    data-setup='{
      "techOrder": ["youtube"],
      "sources": [
        { "type": "video/youtube", "src": "<?= $document['video'] ?>" }
      ]
    }'>
  </video>
</div>


    <?php endif; ?>

    <div class="row mt-4">
        <div class="col-md-8">
            <div class="media">
                <div class="media-body">
                    <h5 class="mt-0"><?= $document['nama'] ?></h5>
                    <p class="mb-1" id="video-stats">Diupload <?= date('d F Y', strtotime($bk['created_at'])) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-4 text-md-right">
        <?php if (!empty($document['pdf'])): ?>
                  <button id="pdfButton" class="btn btn-danger rounded-pill mt-2"><i class="fas fa-file-pdf"></i> PDF</button>
                <?php endif; ?>
            <button class="btn btn-primary rounded-pill mt-2" id="share-button"><i class="fas fa-share"></i> Bagikan</button>
            
        </div>
    </div>
    <div class="mt-4">
        <p><?= $document['deskripsi'] ?></p>
    </div>
</div>

<div class="modal fade" id="share-modal" tabindex="-1" role="dialog" aria-labelledby="share-modal-label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="share-modal-label">Bagikan Pengetahuan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <!-- Tombol-tombol ikon sosial media -->
          <button class="btn btn-info mr-2" id="share-facebook"><i class="fab fa-facebook"></i> Facebook</button>
          <button class="btn btn-info mr-2" id="share-twitter"><i class="fab fa-twitter"></i> Twitter</button>
          <button class="btn btn-info" id="share-linkedin"><i class="fab fa-linkedin"></i> LinkedIn</button>
          <button class="btn btn-info" id="share-whatsapp"><i class="fab fa-whatsapp"></i> WhatsApp</button>
          <!-- Input untuk menyalin link -->
          <div class="form-group mt-4">
          <input id="copy_link_modal" name="copy_link_modal" class="form-control" type="text" readonly="" value="">
          </div>
          <!-- Tombol "Copy" -->
          <div class="text-center mt-3">
            <button class="btn btn-primary" id="copy-button-modal">Copy</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php } else { ?>
  <div class="container">
  <div class="container mt-3">
    <div class="jumbotron text-center">
      <h5 class="display-4"><?= $document['judul_event'] ?></h5>
      <p class="lead"><?= $document['nama_kategori'] ?></p>
    </div>
  </div>
  <main>
    <div class="event-details row mt-4">
      <div class="col-lg-7 col-md-12">
        <div class="event-image">
          <img src="<?= base_url('uploads/' . $document['banner_event']); ?>" alt="Gambar Event" class="img-fluid">
        </div>
      </div>
      <div class="col-lg-5 col-md-12">
        <div class="event-info">
          <p class="organizer"><i class="fas fa-user"></i> Penyelenggara:<br>
          <?= $document['nama'] ?></p>
          <p class="date-time"><i class="fas fa-calendar"></i>
            Tanggal:<br>
            <?= date('l, d M Y, H:i', strtotime($document['mulai_event'])) ?><br>
            sampai<br>
            <?= date('l, d M Y, H:i', strtotime($document['akhir_event'])) ?>
          </p>
           <p class="price mb-2"><i class="fas fa-money-bill"></i> Harga Tiket:<br>
            Rp <?= number_format($document['harga'], 0, ',', '.') ?></p>
          <a href="<?= $document['link_event'] ?>" class="btn btn-primary">Beli Tiket</a>
        </div>
      </div>
    </div>
    
    <!-- Event Description in a New Row -->
    <div class="row mt-4">
      <div class="col-lg-12">
        <div class="event-description">
          <h2>Deskripsi event</h2>
          <p><?= $document['materi_event'] ?></p>
        </div>
      </div>
    </div>
  </main>
</div>



<?php } ?>
<script>
    // Ambil referensi tombol PDF
    var pdfButton = document.getElementById('pdfButton');

    // Tambahkan event listener untuk mengunduh PDF saat tombol diklik
    pdfButton.addEventListener('click', function() {
      // Ganti URL di bawah ini dengan URL PDF yang benar
      var pdfUrl = '<?= base_url('uploads/' . $document['pdf']); ?>';

      // Buat elemen <a> untuk mengunduh PDF
      var downloadLink = document.createElement('a');
      downloadLink.href = pdfUrl;
      downloadLink.target = '_blank'; // Buka di tab/baru jika Anda inginkan
      downloadLink.download = '<?= $document['judul'] ?>.pdf'; // Ganti 'nama_file.pdf' sesuai dengan nama file PDF Anda
      downloadLink.style.display = 'none'; // Sembunyikan elemen <a>

      // Tambahkan elemen <a> ke dalam dokumen
      document.body.appendChild(downloadLink);

      // Klik elemen <a> untuk memulai unduhan
      downloadLink.click();

      // Hapus elemen <a> setelah unduhan selesai
      document.body.removeChild(downloadLink);
    });
  </script>
<script>
// Tanggapan saat tombol "Bagikan" di klik
document.getElementById("share-button").addEventListener("click", function() {
  // Isi nilai input dengan URL saat ini
  document.getElementById("copy_link_modal").value = window.location.href;
  // Tampilkan modal
  $("#share-modal").modal("show");
});

// Tanggapan saat tombol "Copy" di modal diklik
document.getElementById("copy-button-modal").addEventListener("click", function() {
  var copyLinkModal = document.getElementById("copy_link_modal");
  copyLinkModal.select();
  document.execCommand("copy");
  alert("Link telah disalin ke clipboard: " + copyLinkModal.value);
});

// Tanggapan saat tombol ikon sosial media di klik
document.getElementById("share-facebook").addEventListener("click", function() {
  var currentURL = window.location.href;
  var shareURL = encodeURIComponent(currentURL);
  window.open("https://www.facebook.com/sharer/sharer.php?u=" + shareURL, "Facebook Share", "width=600,height=400");
});

document.getElementById("share-twitter").addEventListener("click", function() {
  var currentURL = window.location.href;
  var shareURL = encodeURIComponent(currentURL);
  window.open("https://twitter.com/share?url=" + shareURL, "Twitter Share", "width=600,height=400");
});

document.getElementById("share-linkedin").addEventListener("click", function() {
  var currentURL = window.location.href;
  var shareURL = encodeURIComponent(currentURL);
  window.open("https://www.linkedin.com/shareArticle?url=" + shareURL, "LinkedIn Share", "width=600,height=400");
});

document.getElementById("share-whatsapp").addEventListener("click", function() {
  var currentURL = window.location.href;
  var shareText = "Hai ada Artikel Menarik Nih Baca Yuk !: " + currentURL;
  var whatsappURL = "https://api.whatsapp.com/send?text=" + encodeURIComponent(shareText);
  window.location.href = whatsappURL;
});
</script>

<?php $this->endSection(); ?>
