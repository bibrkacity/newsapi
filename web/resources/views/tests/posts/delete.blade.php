<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Test of delete post</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

        function send_request()
        {

            let div_json = document.getElementById('json');
            div_json.innerHTML='';
            div_json.style.color='black';


            let div_curl = document.getElementById('curl');
            div_curl.innerHTML='';

            let fields = ['api_token','id'];

            let data_string = '';
            let data_obj= {};

            let first = '';

            for(let i=0; i<fields.length; i++)
            {
                let _value = $('#'+fields[i]).val();
                if(_value == '')
                    continue;
                data_string += first + fields[i]+'='+ _value;
                first='&amp;';

                data_obj[fields[i]] = _value;
            }

            let curl_url = '/api/v1/posts/'+$('#id').val();

            let curl_string = 'curl -X "DELETE" -d "'+data_string+'" '+document.location.protocol+'//'+document.location.host+curl_url;
            $('#curl').html(curl_string);

            let request = $.ajax({
                method: "DELETE",
                url: curl_url,
                data: data_obj,
                dataType: "json",
            });

            request.done(function( json ) {

                div_json.innerHTML = JSON.stringify(json);
            });

            request.fail(function( jqXHR, textStatus ) {
                div_json.innerHTML = "Request failed: " + textStatus + ' ' + jqXHR.responseJSON.message ;
                div_json.style.color='red';
            });

        }

    </script>
</head>
<body>

<p><a href="/">Contents</a></p>

<h1>Test of delete post</h1>

<table>

    <tr>
        <td>api_token</td>
        <td><input type="text" value="TopSecret" id="api_token" /></td>
    </tr>

    <tr>
        <td>id</td>
        <td><input type="number" value="" id="id" /></td>
    </tr>

    </tr>

    <tr>
        <td colspan="2"><input type="button" value="Send request" onclick="send_request()" /></td>
    </tr>

</table>

<hr />

<h3>Curl</h3>
<div id="curl"></div>

<h3>JSON</h3>
<div id="json"></div>


</body>
</html>
