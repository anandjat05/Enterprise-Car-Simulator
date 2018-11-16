$(function(){
   
        
        try{
            $.ajax({
                url: "https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22warrensburg%2C%20mo%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys",
                
                success: function(data){
                    
                    
                    var title = "<h6>"+data.query.results.channel.location.city+","+data.query.results.channel.location.region+"</h6>";
                    var weather = "<h4>"+data.query.results.channel.item.condition.temp+"° F</h4>";
                    
                    $("#showTitle").html(title);
                    $("#showWeather").html(weather);
                    
                },//end callback function for success
                error: function(xhr, textStatus, errorThrown){
                    alert("An error occured!"+ (errorThrown? errorThrown: xhr.status ));
                }//error
            });//ajax
            
        }catch(ex){
            alert(ex);
        }//end try catch
        
    
    
});//end ready

       