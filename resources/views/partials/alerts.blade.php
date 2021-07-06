@if(session('success'))
<div class="modal fade-in show" tabindex="-1" role="dialog" aria-hidden="true" id="showModalOnLoad">
   <div class="modal-dialog" role="document">
      <div class="modal-content text-center p-3">
         <div class="modal-body d-flex justify-content-center">
            <div class="align-self-center"> <img src="/public/images/icon_success_confirm_popup.svg" alt="success"> </div>
             <div class="ml-2 align-self-center"> <h1>{{ session('success') }}</h1> </div>
         </div>
      </div>
   </div>
</div>
<script>
    var msg = '{{Session::get('success')}}';
    var exist = '{{Session::has('success')}}';
    if(exist){
        alert(msg);
    }
</script>
@endif
