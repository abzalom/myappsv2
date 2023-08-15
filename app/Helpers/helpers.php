<?php

/**
 * Helper For Apps Cofigs
 */

function tahun()
{
    return App\Helpers\TahunHelper::getTahunAktif();
}

function jadwalRkpd($tahapan, $tahun)
{
    return App\Helpers\JadwaHelper::rkpd($tahapan, $tahun);
}

function countdownRkpd($tahapan, $tahun)
{
    return App\Helpers\JadwaHelper::countdown($tahapan, $tahun);
}

function lockRkpd($tahapan, $tahun)
{
    return App\Helpers\JadwaHelper::lock($tahapan, $tahun);
}
