<?php

class SeleksiController 
{
    public function simulasi()
    {
        include 'views/layout/simulasi_header.php';
        include 'views/tes_seleksi/tes_simulasi_peserta.php';
        include 'views/layout/simulasi_footer.php';
    }

    public function tesSeleksi()
    {
        include 'views/layout/tes_header.php';
        include 'views/tes_seleksi/tes_seleksi_peserta.php';   
        include 'views/layout/tes_footer.php';
    }
}