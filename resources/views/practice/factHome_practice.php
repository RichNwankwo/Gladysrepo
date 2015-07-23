<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Facts</title>
</head>
<body>

<h1>Fact Home Page</h1>

<?php

for($i=1; $i<100; $i++)
{?>
   <div>

    <?php echo '<p class="fact" data-fact="'.$i.'" onclick="getData('.$i.')"> '.$i.' </p><p class="factDescription" data-fact="'.$i.'" ></p>'; ?>

   </div><?php } ?>



</body>
<script>
    function alertNumber(data)
    {
        var val = document.getElementsByClassName("fact")[0].getAttribute('data-fact');
        alert(data);
    }

    function getData(data){
        var xmlhttp = new XMLHttpRequest(); // Creates a request object
        var url = "http://gladys.app/api/v1/fact/" + data // Create the url we are going to
        xmlhttp.onreadystatechange = function(){ // Once the request is at a certain state
            if(xmlhttp.readyState==4 && xmlhttp.status == 200){ // If we get the proper codes
                var myArr = JSON.parse(xmlhttp.responseText); // Parse my JSON
                showFact(myArr.data.fact, data); // Do actual front end work
            }
        }
        xmlhttp.open("GET", url, true);
        xmlhttp.send();

    }

    function showFact(fact, data){
        var facts = document.getElementsByClassName("factDescription");
        for(i = 0; i<facts.length; i++)
        {
            if(facts[i].getAttribute('data-fact') == data)
            {
                facts[i].innerHTML = fact;
            }
        }

    }

</script>
</html>