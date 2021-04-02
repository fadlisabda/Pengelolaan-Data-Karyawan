$(function(){
	$('.tombolTambahData').on('click',function(){
		$('#formModalLabel').html('Tambah Data Karyawan');
		$('.modal-footer button[type=submit]').html('Tambah Data');
	        $('#nama').val('');
	        $('#nohp').val('');
	        $('#email').val('');
	        $('#skill').val('');
	        $('#id').val('');
	        $('.helptext').html('NOTE:Profile Harus Diupload,file harus jpg,jpeg,png,ukuran file maksimal 1mb');
		});

	$('.tampilModalUbah').on('click',function(){
		$('#formModalLabel').html('Ubah Data Karyawan');
		$('.modal-footer button[type=submit]').html('Ubah Data');
		$('.modal-body form').attr('action','http://localhost/latihan/public/karyawan/ubah');
		$('.helptext').html('NOTE:file harus jpg,jpeg,png,ukuran file maksimal 1mb');
		const id = $(this).data('id');
		$.ajax({
			url: 'http://localhost/latihan/public/karyawan/getubah',
			data: {id : id},
			method: 'post',
			dataType: 'json',
			success: function(data) {
				$('#nama').val(data.nama);
				$('#nohp').val(data.nohp);
				$('#email').val(data.email);
				$('#skill').val(data.skill);
				$('#gambarLama').val(data.gambar);
				$('#id').val(data.id);
			}
		});
	});
});