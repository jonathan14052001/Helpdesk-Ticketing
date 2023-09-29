$(document).on('click', '#btn-edit', function() {
    $('.modal-body #id-ticket').val($(this).data('id'));
    $('.modal-body #id_ticket').val($(this).data('id_ticket'));
    $('.modal-body #no_ticket').val($(this).data('no_ticket'));
    $('.modal-body #user_id').val($(this).data('user_id'));
    $('.modal-body #urgency').val($(this).data('urgency'));
    $('.modal-body #name_company').val($(this).data('name_company'));
    $('.modal-body #name_pic').val($(this).data('name_pic'));
    $('.modal-body #position_pic').val($(this).data('position_pic'));
    $('.modal-body #problem_company').val($(this).data('problem_company'));
    $('.modal-body #problem_details').val($(this).data('problem_details'));
    $('.modal-body #image_ticket').val($(this).data('image_ticket'));
    $('.modal-body #progress').val($(this).data('progress'));
    $('.modal-body #solution').val($(this).data('solution'));
    $('.modal-body #status_ticket').val($(this).data('status_ticket'));
})

$(document).on('click', '#btn-tambah', function() {
  $('.modal-body #id-ticket').val($(this).data('id'));
  $('.modal-body #id_ticket').val($(this).data('id_ticket'));
  $('.modal-body #no_ticket').val($(this).data('no_ticket'));
  $('.modal-body #user_id').val($(this).data('user_id'));
  $('.modal-body #urgency').val($(this).data('urgency'));
  $('.modal-body #name_company').val($(this).data('name_company'));
  $('.modal-body #name_pic').val($(this).data('name_pic'));
  $('.modal-body #position_pic').val($(this).data('position_pic'));
  $('.modal-body #problem_company').val($(this).data('problem_company'));
  $('.modal-body #problem_details').val($(this).data('problem_details'));
  $('.modal-body #image_ticket').val($(this).data('image_ticket'));
  $('.modal-body #progress').val($(this).data('progress'));
  $('.modal-body #solution').val($(this).data('solution'));
  $('.modal-body #status_ticket').val($(this).data('status_ticket'));
})

$(document).on('click', '#btn-editt', function() {
    $('.modal-body #idticket').val($(this).data('id'));
    $('.modal-body #id_ticket').val($(this).data('id_ticket'));
    $('.modal-body #persen_progress').val($(this).data('persen_progress'));
    $('.modal-body #solution').val($(this).data('solution'));
    $('.modal-body #status_ticket').val($(this).data('status_ticket'));
})

$(document).on('click', '#btn-ubah', function() {
  $('.modal-body #idcompany').val($(this).data('id'));
  $('.modal-body #name_company').val($(this).data('name_company'));
})

$(document).on('click', '#btn-ubahh', function() {
  $('.modal-body #idpic').val($(this).data('id_user'));
  $('.modal-body #name_pic').val($(this).data('name_pic'));
  $('.modal-body #email').val($(this).data('email'));
  $('.modal-body #position').val($(this).data('position'));
})

$(document).on('click', '#btn-ubahhh', function() {
  $('.modal-body #idadmin').val($(this).data('userid'));
  $('.modal-body #username').val($(this).data('username'));
  $('.modal-body #email').val($(this).data('email'));
  $('.modal-body #user_image').val($(this).data('user_image'));
})

//Sweet Alert 2
const swal = $('.swal').data('swal');
if(swal){
    Swal.fire({
        title: 'Data Berhasil',
        text: swal,
        icon: 'success'
    })
}

$(document).on('click', '.btn-hapus', function(e){
    //hentikan aksi default
    e.preventDefault();
    const href = $(this).attr('href');

    Swal.fire({
        title: 'Apakah anda yakin?',
        text: "Data yang telah dihapus tidak bisa dikembalikan!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus!'
      }).then((result) => {
        if (result.value) {
          document.location.href= href;
        }
      })
})

//dropify (image preview)
$(document).ready(function(){
  $('.dropify').dropify();
});
