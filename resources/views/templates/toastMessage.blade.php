<script>
    @if(Session::has('success'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.success("{{ Session::get('success')}}");
      @endif
    
      @if(Session::has('error'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.error("{{ Session::get('error') }}");
      @endif
    
      @if(Session::has('info'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.info("{{ Session::get('info') }}");
      @endif
    
      @if(Session::has('warning'))
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
              toastr.warning("{{ Session::get('warning') }}");
      @endif
      
      @if ($errors->any())
      toastr.options =
      {
          "closeButton" : true,
          "progressBar" : true
      }
          toastr.error("Silakan periksa formulir di bawah ini untuk mengetahui kesalahan.");
      @endif
    </script>