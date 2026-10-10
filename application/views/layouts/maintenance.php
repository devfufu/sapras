<link rel="stylesheet" href="<?= base_url() ?>src/backend/plugins/fontawesome-free/css/all.min.css">

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?= html_escape($judul ?? 'Informasi') ?></h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <a href="<?= base_url('home') ?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <?= html_escape($judul ?? 'Informasi') ?>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">

            <div class="card">
                <div class="card-body">
                    <div class="text-center py-5">

                        <div class="mb-4">
                            <i class="fas fa-tools text-warning" style="font-size: 80px;"></i>
                        </div>

                        <span class="badge badge-warning px-3 py-2 mb-3">
                            SEDANG DALAM PERBAIKAN
                        </span>

                        <h2 class="font-weight-bold mb-3">
                            <?= html_escape($judul ?? 'Halaman Sedang Diperbaiki') ?>
                        </h2>

                        <p class="text-muted mx-auto" style="max-width: 600px; font-size: 16px; line-height: 1.8;">
                            <?= nl2br(html_escape(
                                $pesan ?? 'Mohon maaf, halaman ini sedang dalam perbaikan.'
                            )) ?>
                        </p>

                        <?php if (!empty($estimasi)) : ?>
                        <div class="text-muted mb-4">
                            <i class="far fa-clock mr-1"></i>
                            <?= html_escape($estimasi) ?>
                        </div>
                        <?php endif; ?>

                        <a href="<?= base_url('home') ?>" class="btn btn-primary px-4">
                            <i class="fas fa-home mr-1"></i>
                            Kembali ke Home
                        </a>

                    </div>
                </div>
            </div>

        </div>
    </section>

</div>