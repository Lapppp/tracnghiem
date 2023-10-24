@if(session()->has('success'))
   <script type="text/javascript">
       $( document ).ready(function() {
           swal("{{ session()->get('success') }}");
       });
   </script>
@endif
