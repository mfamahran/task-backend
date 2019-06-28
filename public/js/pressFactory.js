window.onload = init;


$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

$("#new-press-form").submit(function(ev){
 ev.preventDefault(); 
   var formData = $(this).serialize(); // 
   $.ajax({
    type: 'POST',
    url: url+'/press/save',
    data: formData, 
    success: function (data) {
      populatePresses(data);
      $('#modal-form').modal('hide');
      $('.tags-input').tagsinput('removeAll');
      $('.tags-input').tagsinput('refresh');
      $('#mini-press-container').html('');
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



$("#press-container").on('click', '.btn-destroy', function(ev){

 var press_id = $(this).data('value');

 $.ajax({
  type: 'POST',
  url: url+'/press/remove',
  data: {id: press_id }, 
  success: function (data) {
    $('#user-press-'+press_id).remove();
  },
  error: function(data){
    console.log(data);
  }
});
 return false;
});


function populateAddedPress(data)
{

  var PressesContainer = $('#mini-press-container');

  var newPress = '<div class="col-xl-8">'+
  '                     <div class="card card-stats mb-4 mb-xl-0">'+
  '                      <div class="card-body">'+
  '                        <div class="row">'+
  '                          <div class="col">'+
  '                            <h5 class="card-title text-muted mb-0">Model: '+data.model+'</h5>'+
  '                            <h5 class="card-title text-muted mb-0">Colors: '+data.number_of_colors+'</h5>'+
  '                            <h6 class="card-title text-muted mb-0">Year of Make: '+data.year_of_make+'</h6>'+
  '                          </div>'+
  '                        </div>'+
  '                      </div>'+
  '                    </div>'+
  '                  </div>';
  

  PressesContainer.append(newPress);

}


function populatePresses(data){

  var PressesContainer = $('#press-container');


  var newPress = '<div class="col-xl-3 col-lg-6 mb-5" id="user-press-'+data.id+'">'+
  '                <div class="card card-stats mb-4 mb-xl-0">'+
  '                    <div class="card-body">'+
  '                        <div class="row">'+
  '                            <div class="col">'+
  '                                <h5 class="card-title text-muted mb-0">Model: '+data.model+'</h5>'+
  '                                <h5 class="card-title text-muted mb-0">Colors: '+data.number_of_colors+'</h5>'+
  '                                <h6 class="card-title text-muted mb-0">Year of Make: '+data.year_of_make+'</h6>'+
  '                         <div class="row">'+
  '                            <div class="col" style="float: right;" align="right">'+
  '                                <div class="dropdown">'+
  '                                    <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">'+
  '                                        <i class="fas fa-ellipsis-v"></i>'+
  '                                    </a>'+
  '                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">'+
  '                                            <button type="submit" class="dropdown-item btn-destroy" data-value='+data.id+'>'+
  '                                               Delete'+
  '                                            </button>'+
  '                                    </div>'+
  '                                </div>'+
  '                            </div>'+
  '                        </div>'+
  '                            </div>'+
  '                        </div>'+
  '                    </div>'+
  '                </div>'+
  '            </div>';



  PressesContainer.append(newPress);

}

function init(){
  var models = new Bloodhound({
    datumTokenizer: Bloodhound.tokenizers.whitespace,
    queryTokenizer: Bloodhound.tokenizers.whitespace,
    remote: {
      url: url+'/get-presses?q=%QUERY%',
      wildcard: '%QUERY%'
    },

  });

  models.initialize();

  $('.tags-input').tagsinput({
    itemValue: 'id',
    itemText: 'model',
    maxTags: 1,
    typeaheadjs: (
    {
     hint: true,
     highlight: true,
     minLength: 2,
   },
   {           
     source: models.ttAdapter(),
     displayKey: 'model',
     limit: Infinity,
     templates: {
      empty: [
      '<div class="list-group"><div class="list-group-item">Nothing found.</div></div>'
      ],
      pending: [
      '<div class="list-group"><div class="list-group-item">Searching...</div></div>'
      ],
      header: [
      '<div class="list-group">'
      ],
      suggestion: function(data) {
        return '<div class="list-group-item">' + data.model + '</div></div>'
      }
    }
  })
  });

  $('.tags-input').on('itemAdded', function(event) {
   $.ajax({
    type: 'POST',
    url: url+'/get-press-info',
    data: {id: event.item.id}, 
    success: function (data) {
      populateAddedPress(data);
      console.log(data);
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
 });

  $('.tags-input').on('itemRemoved', function(event) {
    var PressesContainer = $('#mini-press-container');

    PressesContainer.html('');
  });


}