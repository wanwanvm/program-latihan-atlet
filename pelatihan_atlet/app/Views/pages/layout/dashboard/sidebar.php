<div class="sidebar" data-image="/assets/img/background/sidebar-4.jpg">
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="http://www.creative-tim.com" class="simple-text">
                Pelatihan Atlet
            </a>
        </div>
        <ul class="nav">
            <li class="nav-item <?= uri_string() == '/' ? 'active' : null ?>">
                <a class="nav-link" href="/">
                    <p>Dashboard</p>
                </a>
            </li>
            <?php if(session()->get('role') == 1){ ?>
            <li class="<?= uri_string() == 'cabang-olahraga' ? 'active' : null ?>">
                <a class="nav-link" href="/cabang-olahraga">
                    <p>Cabang Olahraga</p>
                </a>
            </li>
            <li class="<?= strpos(uri_string(), 'manage-pelatih') !== false ? 'active' : null ?>">
                <a class="nav-link" href="/manage-pelatih">
                    <p>Manage Pelatih</p>
                </a>
            </li>
            <li class="<?= strpos(uri_string(), 'manage-atlet') !== false ? 'active' : null ?>">
                <a class="nav-link" href="/manage-atlet">
                    <p>Manage Atlet</p>
                </a>
            </li>
            <li class="<?= strpos(uri_string(), 'program-latihan') !== false ? 'active' : null ?>">
                <a class="nav-link" href="/program-latihan">
                    <p>Laporan Program Pelatihan</p>
                </a>
            </li>
            <?php } ?>
            <?php if(session()->get('role') == 2 || session()->get('role') == 3){ ?>
            <li class="<?= uri_string() == 'profil' ? 'active' : null ?>">
                <a class="nav-link" href="/profil">
                    <p>Profil Anda</p>
                </a>
            </li>
            <li class="<?= strpos(uri_string(), 'program-latihan') !== false ? 'active' : null ?>">
                <a class="nav-link" href="/program-latihan">
                    <p>Program Pelatihan</p>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</div>