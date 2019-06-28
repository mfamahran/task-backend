$.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$("#new-address-form").submit(function(ev){
   ev.preventDefault(); 
   var formData = $(this).serialize(); // 
   $.ajax({
    type: 'POST',
    url: url+'/address/save',
    data: formData, 
    success: function (data) {
        populateAddresses(data);
        $('#modal-form').modal('hide');
    },
    error: function(data){
       var errorPrompt = '';
       $.each(data.responseJSON.errors, function(key,value) {
        var span = $('#'+key+'-error-span');
        span.html('');
        errorPrompt = '<strong>'+value+'</strong>';
        span.append(errorPrompt);
        span.show();
    }); 
   }
});
   return false;
});


function populateAddresses(data){

    var addressContainer = $('#address-container');


    var newAddress = '<div class="col-xl-3 col-lg-6 mb-5" id="user-address-'+data.id+'" data-value="'+data.id+'">'+
    '                <div class="card card-stats mb-4 mb-xl-0">'+
    '                    <div class="card-body">'+
    '                        <div class="row">'+
    '                            <div class="col">'+
    '                                <h5 class="card-title text-uppercase text-muted mb-0">'+data.city+'</h5>'+
    '                                <h6 class="card-title text-muted mb-0">'+data.address_line+'</h6>'+
    '                            </div>'+
    '                        </div>'+
    '                    </div>'+
    '                </div>'+
    '            </div>';
    

    
    addressContainer.append(newAddress);


}