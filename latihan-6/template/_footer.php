 </div>
 </div>

 <!-- dataTables js -->
 <script src="../assets/datatables/js/jquery-3.3.1.slim.min.js"></script>
 <script src="../assets/datatables/js/jquery.dataTables.min.js"></script>
 <script src="../assets/datatables/js/dataTables.bootstrap4.min.js"></script>

 <!-- Bootstrap js bundle with @popper -->
 <script src="../assets/js/bootstrap.bundle.min.js"></script>

 <!-- Select2 js -->
 <script src="../assets/select2/js/select2.min.js"></script>

 <!-- Custom js -->
 <script>
     // dataTables
     $(document).ready(function() {
         $('#example').DataTable();
     });

     //  Select2
     $(document).ready(function() {
         $('.select-search').select2();
     });

     // Example starter JavaScript for disabling form submissions if there are invalid fields
     (() => {
         'use strict'

         // Fetch all the forms we want to apply custom Bootstrap validation styles to
         const forms = document.querySelectorAll('.needs-validation')

         // Loop over them and prevent submission
         Array.from(forms).forEach(form => {
             form.addEventListener('submit', event => {
                 if (!form.checkValidity()) {
                     event.preventDefault()
                     event.stopPropagation()
                 }

                 form.classList.add('was-validated')
             }, false)
         })
     })()

     // Preview image
     function previewImage() {
         const inputImgeFile = document.querySelector('#foto');
         const imgPreview = document.querySelector('.img-preview');

         const inputFile = inputImgeFile;

         if (inputFile) {
             const fileReader = new FileReader();
             fileReader.readAsDataURL(inputFile.files[0]);

             fileReader.onload = function(e) {
                 imgPreview.src = e.target.result;
             }
         }
     }
 </script>
 </body>

 </html>