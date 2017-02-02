$(function() {

  var start = moment().subtract(29, 'days');
  var end = moment();

  var d1 = moment().subtract(6, 'days');  
  var d2 = moment().subtract(29, 'days');   
  var d3 = moment().startOf('month');  
  var d4 = moment().subtract(1, 'month').startOf('month');   
  var d5 = moment().subtract(6, 'month').startOf('month');  

  var date1 = d1.format('MMMM D, YYYY');
  var date2 = d2.format('MMMM D, YYYY');
  var date3 = d3.format('MMMM D, YYYY');
  var date4 = d4.format('MMMM D, YYYY');
  var date5 = d5.format('MMMM D, YYYY');
  
  var first = 0;

  function cb(start, end) {

    var newstart = start.format('MMMM D, YYYY');    
    var needd;
    //console.log(newstart);
    $('#reportrange span').html(newstart + ' - ' + end.format('MMMM D, YYYY'));
    if(first){
      if (date1 == newstart){
        needd = alldate[0][choose_dictionary];    
        timerange = 0;    
      } else if (date2 == newstart){
        needd = alldate[1][choose_dictionary];  
        timerange = 1;        
      } else if (date3 == newstart){
        needd = alldate[2][choose_dictionary];
        timerange = 2;          
      } else if (date4 == newstart){
        needd = alldate[3][choose_dictionary];
        timerange = 3;   
      } else if (date5 == newstart){
        needd = alldate[4][choose_dictionary]; 
        timerange = 4;          
      } else{
        needd = alldate[5][choose_dictionary]; 
        timerange = 5;          
      }
      refillfraph(needd);
    }
    first = 1;
  }

  $('#reportrange').daterangepicker({        
    startDate: start,
    endDate: end,
    linkedCalendars: false,
    showCustomRangeLabel: false,
    autoApply: true,
    ranges: {           
     'Последние 7 дней': [moment().subtract(6, 'days'), moment()],
     'Последние 30 дней': [moment().subtract(29, 'days'), moment()],
     'Этот месяц': [moment().startOf('month'), moment()],
     'Прошлый месяц': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
     'За пол года': [moment().subtract(6, 'month').startOf('month'), moment()],
     'За все время': [moment().subtract(1, 'years'), moment()]
   }
 },  cb);
  cb(start, end);    
});