  var twitter = require('twitter'),
  common = require('./keys'),
  mongodb = require('mongoose'),
  globalStream = null,
  globalTrendingTopics = ["Barcelona"];


  var twit = new twitter({
    consumer_key: common.keys.consumer_key,
    consumer_secret: common.keys.consumer_secret,
    access_token_key: common.keys.access_token_key,
    access_token_secret: common.keys.access_token_secret
  });

  var MongoClient = mongodb.connect('mongodb://127.0.0.1:27017/TwitterStream?replicaSet=rs0').connection;

  var connectStream = function() {
    twit.stream('statuses/filter', {
      track: globalTrendingTopics.join(",")
    }, function(stream) {


      stream.on('error', function(a, b) {
        console.error(a);
        console.error(b);
      });

      stream.on('data', function(aTweet) {
        var myId = aTweet.id_str;
        var date = new Date().getTime();
        aTweet.created_at = date;
        MongoClient.collection('twitterstream').insert(aTweet);
      });

      globalStream = stream;

    });

  };

  var disconnectStream = function() {
    console.log("Disconnecting stream");
    globalStream.destroy();
  };

  setInterval(function() {

    if (globalTrendingTopics.count == 0) return;

    twit.get('trends/place.json', {
      id: 1
    }, function(err, data) {
      if (err) {
        console.error(err);
      } else {
        var tmpTrendingTopics = [];

        var myTrends = data[0].trends;

        for (var i = 0; i < myTrends.length; i++) {
          tmpTrendingTopics.push(myTrends[i].name);
        }

        var tmp = tmpTrendingTopics.sort().join(",");
        var global = globalTrendingTopics.sort().join(",");

        if (tmp != global) {
          globalTrendingTopics = tmpTrendingTopics;
          disconnectStream();
          setTimeout(connectStream, 5000);
        }
      }

    });
  }, 5 * 60 * 1000);

  connectStream();
