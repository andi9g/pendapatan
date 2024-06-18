// tambah data mahasiswa
$(document).ready(function () {
    $(".tambahin").click(function () {
        var tanggal = $('#tanggalTambah').val();
        var client = $('#clientTambah').val();
        var keterangan = $('#keteranganTambah').val();
        var jumlah_barang = $('#jumlah_barangTambah').val();
        var sumber = $('#sumberTambah').val();
        var jumlah = $('#jumlahTambah').val();
        var username = $('#username').val();

        if (keterangan == "") {
            swal({
                title: 'Peringatan!',
                type: 'error',
                text: 'Keterangan tidak boleh kosong!',
                confirmButtonColor: '#d9534f'
            });
        } else if (jumlah == "") {
            swal({
                title: 'Peringatan!',
                type: 'error',
                text: 'Jumlah harus diisi!',
                confirmButtonColor: '#d9534f'
            });
        } else {
            $.ajax({
                type: 'POST',
                url: "function/tambahPemasukkan.php",
                data: {
                    tanggal: tanggal,
                    client: client,
                    keterangan: keterangan,
                    jumlah_barang: jumlah_barang,
                    sumber: sumber,
                    jumlah: jumlah,
                    username: username
                },
                success: function () {
                    $('.tambahin').attr('data-dismiss', '');
                    $(".tampil").load("ajax/tampilPemasukkanAdd?username=" + username);
                    $('#clientTambah').val("");
                    $('#keteranganTambah').val("");
                    $('jumlah_barangTambah').val("");
                    $('#sumberTambah').val("ATM");
                    $('#jumlahTambah').val("");
                    console.log('OKE');
                }
            });
            $('.tambahin').attr('data-dismiss', 'modal');
        }
    });
});