<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Data Berita | Berita All</title>
  <link href="{{ asset('css/data-berita-view.css') }}" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20,400,0,0" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
</head>
<body id="canvas">
  <section>
      @include('admin.adminSidebar')
  </section>
  
  {{-- Tabel Data Berita --}}
  <section id="newsTable">
      <div class="newsTable">
        {{-- <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="p-0 mx-3">
            <ol class="breadcrumb">
              <li class="breadcrumb-item" style="text-decoration:none; font-weight: 600; ">Data Berita</li>
              <li class="breadcrumb-item active" aria-current="page">Berita All</li>
            </ol>
          </nav> --}}
            @php
            if (!function_exists('limitChars')) {
                function limitChars($string, $char_limit) {
                    if (strlen($string) > $char_limit) {
                        return substr($string, 0, $char_limit) . '...';
                    }
                    return $string;
                }
            }
            @endphp
          <div class="d-flex justify-content-center">
              @include('admin.dataBerita.dataBeritaTable') 
          </div>
      </div>
  </section>
   
  {{-- Sweetalert2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('kategori').addEventListener('change', function() {
            var selectedValue = this.value;
            var currentUrl = window.location.href.split('?')[0];
            var newUrl = currentUrl + '?kategori=' + selectedValue;
            window.location.href = newUrl;
        });
    </script>
    <script>
        $(document).ready(function() {
            const successMessage = '{{ session("success") }}';
    
            if (successMessage) {
                Swal.fire({
                    icon: "success",
                    title: successMessage,
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        });
    </script>
  <script>
    $('.delete-confirm').on('click', function (event) {
        event.preventDefault();
        const form = $(this).closest('form');
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                confirmButton: "btn btn-success mx-2 py-2 px-3",
                cancelButton: "btn btn-danger mx-2 py-2 px-3"
            },
            buttonsStyling: false
        });
        swalWithBootstrapButtons.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Hapus!",
            cancelButtonText: "Batal!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            } else if (
                /* Read more about handling dismissals below */
                result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire({
                    title: "Dibatalkan",
                    text: "Batal Menghapus Data.",
                    icon: "error"
                });
            }
        });
    });
  </script>
</body>
</html>