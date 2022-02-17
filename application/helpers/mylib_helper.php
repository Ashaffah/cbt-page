<?php

function cmb_dinamis($name, $table, $field, $pk, $selected = null, $extra = null) {
    $ci = & get_instance();
    $cmb = "<select name='$name' class='form-control' $extra>";
    $data = $ci->db->get($table)->result();
    foreach ($data as $row) {
        $cmb .="<option value='" . $row->$pk . "'";
        $cmb .= $selected == $row->$pk ? 'selected' : '';
        $cmb .=">" . $row->$field . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function cmb_dinamis_where($name, $table, $field, $pk, $selected = null, $extra = null, $where = null, $nilaiwhere=null) {
    $ci = & get_instance();
    $cmb = "<select name='$name' class='form-control' $extra>";
    $data = $ci->db->where($where,$nilaiwhere)->get($table)->result();
    foreach ($data as $row) {
        $cmb .="<option value='" . $row->$pk . "'";
        $cmb .= $selected == $row->$pk ? 'selected' : '';
        $cmb .=">" . $row->$field . "</option>";
    }
    $cmb .= "</select>";
    return $cmb;
}

function get_tahun_akademik_aktif($field) {
    $ci = & get_instance();
    $ci->db->where('is_aktif', 'y');
    $tahun = $ci->db->get('tbl_tahun_akademik')->row_array();
    return $tahun[$field];
}

function chek_nilai($nim, $id_jadwal) {
    $ci = & get_instance();
    $nilai = $ci->db->get_where('tbl_nilai', array('nim' => $nim, 'id_jadwal' => $id_jadwal));
    if ($nilai->num_rows() > 0) {
        $row = $nilai->row_array();
        return $row['nilai'];
    } else {
        return 0;
    }
}

function chek_komponen_biaya($id_jenis_pembayaran) {
    $ci = & get_instance();
    $where = array(
        'id_jenis_pembayaran' => $id_jenis_pembayaran,
        'id_tahun_akademik' => get_tahun_akademik_aktif('semester_aktif'));
    $biaya = $ci->db->get_where('tbl_biaya_sekolah', $where);
    if ($biaya->num_rows() > 0) {
        $row = $biaya->row_array();
        return $row['jumlah_biaya'];
    } else {
        return 0;
    }
}

function chekAksesModule() {
    $ci = & get_instance();
    // ambil parameter uri segment untuk controller dan method
    $controller = $ci->uri->segment(1);
    $method = $ci->uri->segment(2);

    // chek url
    if (empty($method)) {
        $url = $controller;
    } else {
        $url = $controller . '/' . $method;
    }

    // chek id menu nya
    $menu = $ci->db->get_where('tabel_menu', array('link' => $url))->row_array();
    $level_user = $ci->session->userdata('id_level_user');

    if (!empty($level_user)) {

        // chek apakah level ini diberikan hak akses atau tidak
        $chek = $ci->db->get_where('tbl_user_rule', array('id_level_user' => $level_user, 'id_menu' => $menu['id']));
        if ($chek->num_rows() < 1 and $method != 'data' and $method != 'add' and $method != 'edit' and $method != 'delete') {
            echo "ANDA TIDAK BOLEH MENGAKSES MODUL INI";
            die;
        }
    } else {
        redirect('auth');
    }



}


    function Terbilang($x) {
        $abil = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        if ($x < 12)
            return " " . $abil[$x];
        elseif ($x < 20)
            return Terbilang($x - 10) . "belas";
        elseif ($x < 100)
            return Terbilang($x / 10) . " puluh" . Terbilang($x % 10);
        elseif ($x < 200)
            return " seratus" . Terbilang($x - 100);
        elseif ($x < 1000)
            return Terbilang($x / 100) . " ratus" . Terbilang($x % 100);
        elseif ($x < 2000)
            return " seribu" . Terbilang($x - 1000);
        elseif ($x < 1000000)
            return Terbilang($x / 1000) . " ribu" . Terbilang($x % 1000);
        elseif ($x < 1000000000)
            return Terbilang($x / 1000000) . " juta" . Terbilang($x % 1000000);
    }
//jarowinkler
class StringCompareJaroWinkler 
{
    public function compare($str1, $str2)
    {
        return $this->JaroWinkler($str1, $str2, $PREFIXSCALE = 0.1 );
    }

    private function getCommonCharacters( $string1, $string2, $allowedDistance ){

      $str1_len = mb_strlen($string1);
      $str2_len = mb_strlen($string2);
      $temp_string2 = $string2;

      $commonCharacters='';
      for( $i=0; $i < $str1_len; $i++){

        $noMatch = True;
        // compare if char does match inside given allowedDistance
        // and if it does add it to commonCharacters
        for( $j= max( 0, $i-$allowedDistance ); $noMatch && $j < min( $i + $allowedDistance + 1, $str2_len ); $j++){
          if( $temp_string2[$j] == $string1[$i] ){
            $noMatch = False;
        $commonCharacters .= $string1[$i];
        
          }
        }
      }
      return $commonCharacters;
    }

    private function Jaro( $string1, $string2 ){

      $str1_len = mb_strlen( $string1 );
      $str2_len = mb_strlen( $string2 );

      // theoretical distance
      $distance = (int) floor(min( $str1_len, $str2_len ) / 2.0); 

      // get common characters
      $commons1 = $this->getCommonCharacters( $string1, $string2, $distance );
      $commons2 = $this->getCommonCharacters( $string2, $string1, $distance );

      if( ($commons1_len = mb_strlen( $commons1 )) == 0) return 0;
      if( ($commons2_len = mb_strlen( $commons2 )) == 0) return 0;
      // calculate transpositions
      $transpositions = 0;
      $upperBound = min( $commons1_len, $commons2_len );
      for( $i = 0; $i < $upperBound; $i++){
        if( $commons1[$i] != $commons2[$i] ) $transpositions++;
      }
      $transpositions /= 2.0;
      // return the Jaro distance
      return ($commons1_len/($str1_len) + $commons2_len/($str2_len) + ($commons1_len - $transpositions)/($commons1_len)) / 3.0;

    }

    private function getPrefixLength( $string1, $string2, $MINPREFIXLENGTH = 4 ){

      $n = min( array( $MINPREFIXLENGTH, mb_strlen($string1), mb_strlen($string2) ) );

      for($i = 0; $i < $n; $i++){
        if( $string1[$i] != $string2[$i] ){
          // return index of first occurrence of different characters 
          return $i;
        }
      }
      // first n characters are the same   
      return $n;
    }

    private function JaroWinkler($string1, $string2, $PREFIXSCALE = 0.1 ){

      $JaroDistance = $this->Jaro( $string1, $string2 );
      $prefixLength = $this->getPrefixLength( $string1, $string2 );
      return $JaroDistance + $prefixLength * $PREFIXSCALE * (1.0 - $JaroDistance);
    }
}

function banding($word1,$word2){
    $jw = new StringCompareJaroWinkler();
    return $jw->compare($word1,$word2);
}