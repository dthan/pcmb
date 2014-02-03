 /*
   - sparks calls
   
   -->> --------------------------
  Table of Contents:
  1 - Sub Nav Sparklines
   -->> --------------------------- */

jQuery(function($) {

  /* ------- Sub Nav Sparklines ------- */        
  $(".spark_1").sparkline([2,4,3,6,7,5,8,9,4,2,6,8,8,9,10], { type: 'bar', width: '80px', barColor: '#ff9c42'});
  $(".spark_2").sparkline([2,4,7,5,8,5,3,6,5,4,6,7 ], 
    {
      type: 'line',
      width: '80px',
      height: '18px',
      lineColor: '#48bbe6',
      fillColor: '#75c7e5',
      spotColor: '#009ce5',
      minSpotColor: '#009ce5',
      maxSpotColor: '#009ce5'
    }
  );

  $(".spark_3").sparkline([10,12,12,9,7], 
    {
      type: 'bullet',
      targetColor: '#ff5656',
      performanceColor: '#ffaaaa',
      rangeColors: ['#bc3e3e','#ff3a3a','#ff5656']
    }
  );

  $(".spark_4").sparkline([1,2,4 ,2], 
    {
      type: 'pie',
      width: '18',
      height: '18',
      sliceColors: ['#ff3952','#ff694a','#ffd200']
    }
  );

  $(".spark_5").sparkline([1,-1,1,0,1,-1,-1,1,-1,1,0,-1,1 ], 
    {
    type: 'tristate',
    posBarColor: '#8ec63f',
    negBarColor: '#f26c4f'
    }
  );

  $(".spark_6").sparkline([4,6,7,7,4,3,2,1,4,4], 
    {
      type: 'discrete',
      width: '50',
      lineColor: '#41beea',
      lineHeight: 6,
      thresholdColor: '#0000ff'
    }
  );  

});

