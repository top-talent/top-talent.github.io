

let xhr = new XMLHttpRequest();
let data = [];

xhr.onload = function () {
  data = JSON.parse(xhr.responseText);
  console.log('Data was received');

  if(storageAvailable('localStorage'))
    window.localStorage.setItem('adsChartData', JSON.stringify(data));

  graphsInit();


  window.addEventListener('resize', () => {

    [pieChart, histogram].forEach((graph) =>{
      document.getElementById(graph.container.slice(1)).innerHTML = '';
    });

    graphsInit();
  });

};

if(storageAvailable('localStorage') && !localStorage.getItem('adsChartData') || !storageAvailable('localStorage')) {
  console.log('Getting data from server...');
  xhr.open('GET', 'data.json', true);
  xhr.send();
} else {
  data = JSON.parse(localStorage.getItem('adsChartData'));
  graphsInit();
}



function graphsInit() {
  [pieChart, histogram].forEach((graph) =>{

    graph.width = document.getElementById(graph.container.slice(1)).clientWidth * 0.9;
    graph.height = graph.width / graph.proportion;

    graph.svg = d3.select(graph.container)
      .append('svg')
      .attr('width', graph.width)
      .attr('height', graph.height)
  });

  pieChart.draw(data);
  histogram.drawSelectMessage();

  if (currentDay)
    histogram.draw(currentDay, data.hours[currentDay]);
}



function storageAvailable(type) {
  try {
    var storage = window[type],
      x = '__storage_test__';
    storage.setItem(x, x);
    storage.removeItem(x);
    return true;
  }
  catch(e) {
    return false;
  }
}