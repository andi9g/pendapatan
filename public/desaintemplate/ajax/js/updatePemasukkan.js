$(document).ready(function () {

    // nampilin data
    $(document).on('click', 'a[data-role=update]', function () {
        var id = $(this).data('id');
        var tanggal = $('#' + id).children('td[data-target=tanggal]').text();
        var client = $('#' + id).children('td[data-target=client]').text();
        var keterangan = $('#' + id).children('td[data-target=keterangan]').text();
        var jumlah_barang = $('#' + id).children('td[data-target=jumlah_barang]').text();
        var sumber = $('#' + id).children('td[data-target=sumber]').text();
        var jumlahMasuk = $('#' + id).children('td[data-target=jumlahMasuk]').text();

        $('#tanggal').val(tanggal);
        $('#client').val(client);
        $('#keterangan').val(keterangan);
        $('#jumlah_barang').val(jumlah_barang);
        $('#sumber').val(sumber);
        $('#jumlahMasuk').val(jumlahMasuk);
        $('#userId').val(id);
        $('#myModal2').modal('toggle');
    });

    // buat event untuk get data dan update ke database
    $('#save').click(function () {
        var filter = $('#filter').val();
        var username = $('#username').val();
        var id = $('#userId').val();
        var tanggal = $('#tanggal').val();
        var client = $('#client').val();
        var keterangan = $('#keterangan').val();
        var jumlah_barang = $('#jumlah_barang').val();
        var sumber = $('#sumber').val();
        var jumlahMasuk = $('#jumlahMasuk').val();

        $.ajax({
            url: 'function/updatePemasukkan.php',
            method: 'post',
            data: {
                tanggal: tanggal,
                client: client,
                keterangan: keterangan,
                jumlah_barang: jumlah_barang,
                sumber: sumber,
                jumlah: jumlahMasuk,
                id: id
            },
            success: function (response) {
                $('#' + id).children('td[data-target=tanggal]').text(tanggal);
                $('#' + id).children('td[data-target=client]').text(client);
                $('#' + id).children('td[data-target=keterangan]').text(keterangan);
                $('#' + id).children('td[data-target=jumlah_barang]').text(jumlah_barang);
                $('#' + id).children('td[data-target=sumber]').text(sumber);
                $('#' + id).children('td[data-target=jumlahMasuk]').text(jumlahMasuk);
                $('#myModal2').modal('toggle');
                $(".tampil").load("ajax/tampilPemasukkan?filterSend=" + filter + '&username=' + username);

            }
        });
    });
});