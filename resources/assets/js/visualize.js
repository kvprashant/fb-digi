function httpGetAsync(theUrl, callback)
{
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.onreadystatechange = function() { 
  if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
    callback(xmlHttp.responseText);
  }
  xmlHttp.open("GET", theUrl, true); // true for asynchronous 
  xmlHttp.send(null);
}

function logn(position) {
  // position will be between 0 and 100
  var minp = 0;
  var maxp = 500;

  // The result should be between 100 an 500000
  var minv = Math.log10(100);
  var maxv = Math.log10(10000);

  // calculate adjustment factor
  var scale = (maxv-minv) / (maxp-minp);

  return Math.exp(minv + scale*(position-minp));
}

function getBaseUrl() {
    var re = new RegExp(/^.*\//);
    return re.exec(window.location.href)[0];
}

function loadMap(response) {
  console.log(response);
}

function getColor() {
  return '#' + Math.floor(Math.random()*16777215).toString(16);
}

var countries,
    likes,
    pageLikes = [];

//Loads countries ISO codes
httpGetAsync(getBaseUrl()+'countries.json', function(response){
  countries = JSON.parse(response);
});

// Getting the container's dimensions
var width = document.getElementById('container').offsetWidth;
var height = document.getElementById('container').offsetHeight;

//Data
httpGetAsync(getBaseUrl()+'/api/v1/page_insight?page=297779776717', function(response){
  likes = JSON.parse(response);
  // Datamap constructor, fill in the options from the docs
  var worldMap = new Datamap({
    element: document.getElementById('container'),
    geographyConfig: {
      highlightOnHover: false,
      popupOnHover: false
    },
    fills: {
      YES: '#666666',
      UNKNOWN: 'rgb(0,0,0)',       // These are
      defaultFill: '#CDCCCC'       // the colours
    },
    setProjection: function(element, options) {
      var projection, path;
      projection = d3.geo.mercator()                          // The d3 projection
                     .translate([(width/2.2), (height/2)])      // And some options
                     .scale( width / 2.2 / Math.PI)
                     .center([-15.652173913043478, 17.2734596919573]);
      path = d3.geo.path()
               .projection( projection );
      return {path: path, projection: projection};
    }
  });

  for (var alpha2 in likes) {
    // console.log([countries[alpha2].alpha3, likes[alpha2], Math.round(100*Math.log(likes[alpha2]))].join(' | '));
    if(!countries.hasOwnProperty(alpha2)) {
      continue;
    }
    pageLikes.push({
      name: countries[alpha2].country,
      radius: Math.round(2*Math.log(likes[alpha2])),
      likes: likes[alpha2],
      country: countries[alpha2].alpha3,
      fillKey: 'YES',
      centered: countries[alpha2].alpha3
    });
  }

  //draw bubbles for likes
  worldMap.bubbles(pageLikes, {
    popupTemplate: function (geo, data) {
      return ['<div class="hoverinfo">' +  data.name,
      '<br/>Likes: ' +  data.likes + '',
      '</div>'].join('');
    }
  });
});